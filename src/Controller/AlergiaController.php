<?php

namespace App\Controller;

use App\Entity\Alergia;
use App\Form\AlergiaType;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlergiaController extends AbstractController
{
    #[Route('/alergias/nuevo/{id}', name: 'alergias_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $alergia = new Alergia();
        $alergia->setHistorialClinico($historialClinico);

        $form = $this->createForm(AlergiaType::class, $alergia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $alergia->setCreadoPor($this->getUser());
            $alergia->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($alergia);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('alergia/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
