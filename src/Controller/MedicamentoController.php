<?php

namespace App\Controller;

use App\Entity\Medicamento;
use App\Form\MedicamentoType;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MedicamentoController extends AbstractController
{
    #[Route('/medicamentos/nuevo/{id}', name: 'medicamentos_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $medicamento = new Medicamento();
        $medicamento->setHistorialClinico($historialClinico);

        $form = $this->createForm(MedicamentoType::class, $medicamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicamento->setCreadoPor($this->getUser());
            $medicamento->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($medicamento);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('medicamento/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
