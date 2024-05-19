<?php

namespace App\Controller;

use App\Entity\QuejaActual;
use App\Form\QuejaActualType;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuejaActualController extends AbstractController
{
    #[Route('/queja-actual/nuevo/{id}', name: 'queja_actual_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $quejaActual = new QuejaActual();
        $quejaActual->setHistorialClinico($historialClinico);

        $form = $this->createForm(QuejaActualType::class, $quejaActual);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quejaActual->setCreadoPor($this->getUser());
            $quejaActual->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($quejaActual);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('queja_actual/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
