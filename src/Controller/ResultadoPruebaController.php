<?php

namespace App\Controller;

use App\Entity\ResultadoPrueba;
use App\Entity\HistorialClinico;
use App\Form\ResultadoPruebaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResultadoPruebaController extends AbstractController
{
    #[Route('/resultados-pruebas/nuevo/{id}', name: 'resultados_pruebas_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $resultadoPrueba = new ResultadoPrueba();
        $resultadoPrueba->setHistorialClinico($historialClinico);

        $form = $this->createForm(ResultadoPruebaType::class, $resultadoPrueba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resultadoPrueba->setCreadoPor($this->getUser());
            $resultadoPrueba->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($resultadoPrueba);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('resultados_pruebas/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
