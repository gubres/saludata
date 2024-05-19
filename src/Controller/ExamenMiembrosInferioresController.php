<?php

namespace App\Controller;

use App\Entity\HistorialClinico;
use App\Entity\ExamenMiembrosInferiores;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ExamenMiembrosInferioresType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExamenMiembrosInferioresController extends AbstractController
{
    #[Route('/examen-miembros-inferiores/nuevo/{id}', name: 'examen_miembros_inferiores_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $examenMiembrosInferiores = new ExamenMiembrosInferiores();
        $examenMiembrosInferiores->setHistorialClinico($historialClinico);

        $form = $this->createForm(ExamenMiembrosInferioresType::class, $examenMiembrosInferiores);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examenMiembrosInferiores->setCreadoPor($this->getUser());
            $examenMiembrosInferiores->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($examenMiembrosInferiores);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('examen_miembros_inferiores/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
