<?php

namespace App\Controller;

use DateTimeZone;
use App\Entity\Paciente;
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
        $paciente = $entityManager->getRepository(Paciente::class)->find($id);

        if (!$paciente) {
            throw $this->createNotFoundException('No se encontró el paciente con el ID ' . $id);
        }

        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->findOneBy(['paciente' => $paciente]);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico para el paciente con el ID ' . $id);
        }

        $examenMiembrosInferiores = new ExamenMiembrosInferiores();
        $examenMiembrosInferiores->setHistorialClinico($historialClinico);

        $form = $this->createForm(ExamenMiembrosInferioresType::class, $examenMiembrosInferiores);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examenMiembrosInferiores->setCreadoPor($this->getUser());
            $examenMiembrosInferiores->setCreadoEn(new \DateTime('now',  new DateTimeZone('Europe/Madrid')));

            //actualizar el paciente para que figure la nueva modifica y se sepa la fecha de la ultima visita
            $paciente->setUpdatedAt(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
            $entityManager->persist($paciente);

            $entityManager->persist($examenMiembrosInferiores);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('examen_miembros_inferiores/new.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente,
        ]);
    }
}
