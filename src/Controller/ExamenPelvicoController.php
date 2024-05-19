<?php

namespace App\Controller;

use App\Entity\ExamenPelvico;
use App\Form\ExamenPelvicoType;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExamenPelvicoController extends AbstractController
{
    #[Route('/examen-pelvico/nuevo/{id}', name: 'examen_pelvico_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $examenPelvico = new ExamenPelvico();
        $examenPelvico->setHistorialClinico($historialClinico);

        $form = $this->createForm(ExamenPelvicoType::class, $examenPelvico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examenPelvico->setCreadoPor($this->getUser());
            $examenPelvico->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($examenPelvico);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('examen_pelvico/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
