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
    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param int $id
     * @return Response
     */
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

        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $historialFamiliar = new HistorialFamiliar();
        $historialFamiliar->setHistorialClinico($historialClinico);

        $form = $this->createForm(HistorialFamiliarType::class, $historialFamiliar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            if ($user) {
                $historialFamiliar->setCreadoPor($user->getId()); // Obtén la ID del usuario
                $historialFamiliar->setCreadoEn(new \DateTime('now', new DateTimeZone('Europe/Madrid')));

                // Actualizar el paciente para que figure la nueva modifica y se sepa la fecha de la última visita
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
        ]);
    }
}
