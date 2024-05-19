<?php

namespace App\Controller;

use App\Entity\HistorialClinico;
use App\Entity\ExamenMiembrosSuperiores;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ExamenMiembrosSuperioresType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExamenMiembrosSuperioresController extends AbstractController
{
    #[Route('/examen-miembros-superiores/nuevo/{id}', name: 'examen_miembros_superiores_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $examenMiembrosSuperiores = new ExamenMiembrosSuperiores();
        $examenMiembrosSuperiores->setHistorialClinico($historialClinico);

        $form = $this->createForm(ExamenMiembrosSuperioresType::class, $examenMiembrosSuperiores);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examenMiembrosSuperiores->setCreadoPor($this->getUser());
            $examenMiembrosSuperiores->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($examenMiembrosSuperiores);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('examen_miembros_superiores/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
