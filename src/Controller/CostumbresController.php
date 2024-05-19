<?php

namespace App\Controller;

use App\Entity\Costumbres;
use App\Form\CostumbresType;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CostumbresController extends AbstractController
{
    #[Route('/costumbres/nuevo/{id}', name: 'costumbres_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $costumbres = new Costumbres();
        $costumbres->setHistorialClinico($historialClinico);

        $form = $this->createForm(CostumbresType::class, $costumbres);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $costumbres->setCreadoPor($this->getUser());
            $costumbres->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($costumbres);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('costumbres/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
