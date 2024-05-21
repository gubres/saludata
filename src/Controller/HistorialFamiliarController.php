<?php

namespace App\Controller;

use DateTimeZone;
use App\Entity\Paciente;
use App\Entity\HistorialClinico;
use App\Entity\HistorialFamiliar;
use App\Form\HistorialFamiliarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;

class HistorialFamiliarController extends AbstractController
{
    #[Route('/historial-familiar/nuevo/{id}', name: 'historial_familiar_new')]
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

        $historialFamiliarExistente = $entityManager->getRepository(HistorialFamiliar::class)->findOneBy(['historialClinico' => $historialClinico]);

        if ($historialFamiliarExistente) {
            return $this->redirectToRoute('historial_familiar_edit', ['id' => $historialFamiliarExistente->getId()]);
        }

        $historialFamiliar = new HistorialFamiliar();
        $historialFamiliar->setHistorialClinico($historialClinico);

        $form = $this->createForm(HistorialFamiliarType::class, $historialFamiliar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            if ($user) {
                $historialFamiliar->setCreadoPor($user->getId());
                $historialFamiliar->setCreadoEn(new \DateTime('now', new DateTimeZone('Europe/Madrid')));

                $paciente->setUpdatedAt(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
                $entityManager->persist($paciente);
                $entityManager->persist($historialFamiliar);
                $entityManager->flush();

                return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
            } else {
                throw $this->createAccessDeniedException('El usuario no está autenticado.');
            }
        }

        return $this->render('historial_familiar/new.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente,
        ]);
    }

    #[Route('/historial-familiar/editar/{id}', name: 'historial_familiar_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialFamiliar = $entityManager->getRepository(HistorialFamiliar::class)->find($id);

        if (!$historialFamiliar) {
            throw $this->createNotFoundException('No se encontró el historial familiar con el ID ' . $id);
        }

        $paciente = $historialFamiliar->getHistorialClinico()->getPaciente();

        $form = $this->createForm(HistorialFamiliarType::class, $historialFamiliar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historialFamiliar->setActualizadoPor($this->getUser());
            $historialFamiliar->setActualizadoEn(new \DateTime('now', new DateTimeZone('Europe/Madrid')));

            $entityManager->persist($historialFamiliar);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $paciente->getId()]);
        }

        return $this->render('historial_familiar/edit.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente,
        ]);
    }
}
