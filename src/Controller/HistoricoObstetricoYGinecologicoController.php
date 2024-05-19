<?php

namespace App\Controller;

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
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $historicoObstetricoYGinecologico = new HistoricoObstetricoYGinecologico();
        $historicoObstetricoYGinecologico->setHistorialClinico($historialClinico);

        $form = $this->createForm(HistoricoObstetricoYGinecologicoType::class, $historicoObstetricoYGinecologico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historicoObstetricoYGinecologico->setCreadoPor($this->getUser());
            $historicoObstetricoYGinecologico->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($historicoObstetricoYGinecologico);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('historial_obstetrico_y_ginecologico/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
