<?php

namespace App\Controller;

use DateTimeZone;
use App\Entity\Paciente;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\HistoricoObstetricoYGinecologico;
use App\Form\HistoricoObstetricoYGinecologicoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HistoricoObstetricoYGinecologicoController extends AbstractController
{
    #[Route('/historial-obstetrico-y-ginecologico/nuevo/{id}', name: 'historico_obstetrico_y_ginecologico_new')]
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

        $historicoObstetricoYGinecologico = new HistoricoObstetricoYGinecologico();
        $historicoObstetricoYGinecologico->setHistorialClinico($historialClinico);

        $form = $this->createForm(HistoricoObstetricoYGinecologicoType::class, $historicoObstetricoYGinecologico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historicoObstetricoYGinecologico->setCreadoPor($this->getUser());
            $historicoObstetricoYGinecologico->setCreadoEn(new \DateTime('now', new DateTimeZone('Europe/Madrid')));

            $paciente->setUpdatedAt(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
            $entityManager->persist($paciente);
            $entityManager->persist($historicoObstetricoYGinecologico);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('historial_obstetrico_y_ginecologico/new.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente
        ]);
    }
    #[Route('/historial-obstetrico-y-ginecologico/editar/{id}', name: 'historial_og_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historicoObstetricoYGinecologico = $entityManager->getRepository(HistoricoObstetricoYGinecologico::class)->find($id);

        if (!$historicoObstetricoYGinecologico) {
            throw $this->createNotFoundException('No se encontró el historial obstetrico y ginecologico con el ID ' . $id);
        }

        $paciente = $historicoObstetricoYGinecologico->getHistorialClinico()->getPaciente();

        $form = $this->createForm(HistoricoObstetricoYGinecologicoType::class, $historicoObstetricoYGinecologico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historicoObstetricoYGinecologico->setActualizadoPor($this->getUser());
            $historicoObstetricoYGinecologico->setActualizadoEn(new \DateTime('now', new DateTimeZone('Europe/Madrid')));

            $entityManager->persist($historicoObstetricoYGinecologico);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $paciente->getId()]);
        }

        return $this->render('historial-obstetrico-y-ginecologico/edit.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente,
        ]);
    }
}
