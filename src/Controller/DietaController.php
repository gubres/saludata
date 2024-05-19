<?php

namespace App\Controller;

use App\Entity\Dieta;
use App\Form\DietaType;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DietaController extends AbstractController
{
    #[Route('/dietas/nuevo/{id}', name: 'dietas_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $dieta = new Dieta();
        $dieta->setHistorialClinico($historialClinico);

        $form = $this->createForm(DietaType::class, $dieta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dieta->setCreadoPor($this->getUser());
            $dieta->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($dieta);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('dieta/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
