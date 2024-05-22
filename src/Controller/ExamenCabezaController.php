<?php

namespace App\Controller;

use DateTimeZone;
use App\Entity\Paciente;
use App\Entity\ExamenCabeza;
use App\Form\ExamenCabezaType;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExamenCabezaController extends AbstractController
{
    #[Route('/examen-cabeza/nuevo/{id}', name: 'examen_cabeza_new')]
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

        $examenCabeza = new ExamenCabeza();
        $examenCabeza->setHistorialClinico($historialClinico);

        $form = $this->createForm(ExamenCabezaType::class, $examenCabeza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examenCabeza->setCreadoPor($this->getUser());
            $examenCabeza->setCreadoEn(new \DateTime('now',  new DateTimeZone('Europe/Madrid')));

            //actualizar el paciente para que figure la nueva modifica y se sepa la fecha de la ultima visita
            $paciente->setUpdatedAt(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
            $entityManager->persist($paciente);

            $entityManager->persist($examenCabeza);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('examen_cabeza/new.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente,
        ]);
    }
}
