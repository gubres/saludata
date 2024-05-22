<?php

namespace App\Controller;

use DateTimeZone;
use App\Entity\Alergia;
use App\Entity\Paciente;
use App\Form\AlergiaType;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlergiaController extends AbstractController
{
    #[Route('/alergias/nuevo/{id}', name: 'alergias_new')]
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

        $alergia = new Alergia();
        $alergia->setHistorialClinico($historialClinico);

        $form = $this->createForm(AlergiaType::class, $alergia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $alergia->setCreadoPor($this->getUser());
            $alergia->setCreadoEn(new \DateTime('now', new DateTimeZone('Europe/Madrid')));

            $entityManager->persist($alergia);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        //actualizar el paciente para que figure la nueva modifica y se sepa la fecha de la ultima visita
        $paciente->setUpdatedAt(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
        $entityManager->persist($paciente);
        $entityManager->flush();

        return $this->render('alergia/new.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente,
        ]);
    }
}
