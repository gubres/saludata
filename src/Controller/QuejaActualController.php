<?php

namespace App\Controller;

use DateTimeZone;
use App\Entity\Paciente;
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
        $paciente = $entityManager->getRepository(Paciente::class)->find($id);

        if (!$paciente) {
            throw $this->createNotFoundException('No se encontró el paciente con el ID ' . $id);
        }

        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->findOneBy(['paciente' => $paciente]);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico para el paciente con el ID ' . $id);
        }

        $quejaActual = new QuejaActual();
        $quejaActual->setHistorialClinico($historialClinico);

        $form = $this->createForm(QuejaActualType::class, $quejaActual);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quejaActual->setCreadoPor($this->getUser());
            $quejaActual->setCreadoEn(new \DateTime('now',  new DateTimeZone('Europe/Madrid')));

            //actualizar el paciente para que figure la nueva modifica y se sepa la fecha de la ultima visita
            $paciente->setUpdatedAt(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
            $entityManager->persist($paciente);
            $entityManager->persist($quejaActual);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $paciente->getId()]);
        }

        return $this->render('queja_actual/new.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente,
        ]);
    }
}
