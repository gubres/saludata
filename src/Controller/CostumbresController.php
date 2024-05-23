<?php

namespace App\Controller;

use DateTimeZone;
use App\Entity\Paciente;
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
        $paciente = $entityManager->getRepository(Paciente::class)->find($id);

        if (!$paciente) {
            throw $this->createNotFoundException('No se encontró el paciente con el ID ' . $id);
        }

        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->findOneBy(['paciente' => $paciente]);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico para el paciente con el ID ' . $id);
        }

        $costumbres = new Costumbres();
        $costumbres->setHistorialClinico($historialClinico);

        $form = $this->createForm(CostumbresType::class, $costumbres);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $costumbres->setCreadoPor($this->getUser());
            $costumbres->setCreadoEn(new \DateTime('now',  new DateTimeZone('Europe/Madrid')));

            //actualizar el paciente para que figure la nueva modifica y se sepa la fecha de la ultima visita
            $paciente->setUpdatedAt(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
            $entityManager->persist($paciente);

            $entityManager->persist($costumbres);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('costumbres/new.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente,
        ]);
    }
    #[Route('/costumbres/editar/{id}', name: 'costumbres_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $Costumbres = $entityManager->getRepository(Costumbres::class)->find($id);

        if (!$Costumbres) {
            throw $this->createNotFoundException('No se encontró la clasificación sanguínea con el ID ' . $id);
        }

        $paciente = $Costumbres->getHistorialClinico()->getPaciente();

        $form = $this->createForm(CostumbresType::class, $Costumbres);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Costumbres->setActualizadoPor($this->getUser());
            $Costumbres->setActualizadoEn(new \DateTime('now', new DateTimeZone('Europe/Madrid')));

            $entityManager->persist($Costumbres);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $paciente->getId()]);
        }

        return $this->render('costumbres/edit.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente,
        ]);
    }
}
