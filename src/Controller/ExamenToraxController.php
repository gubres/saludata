<?php

namespace App\Controller;

use App\Entity\ExamenTorax;
use App\Form\ExamenToraxType;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExamenToraxController extends AbstractController
{
    #[Route('/examen-torax/nuevo/{id}', name: 'examen_torax_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $examenTorax = new ExamenTorax();
        $examenTorax->setHistorialClinico($historialClinico);

        $form = $this->createForm(ExamenToraxType::class, $examenTorax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examenTorax->setCreadoPor($this->getUser());
            $examenTorax->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($examenTorax);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('examen_torax/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
