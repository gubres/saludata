<?php

namespace App\Controller;

use App\Entity\SignosVitales;
use App\Form\SignosVitalesType;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SignosVitalesController extends AbstractController
{
    #[Route('/signos-vitales/nuevo/{id}', name: 'signos_vitales_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $signosVitales = new SignosVitales();
        $signosVitales->setHistorialClinico($historialClinico);

        $form = $this->createForm(SignosVitalesType::class, $signosVitales);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $signosVitales->setCreadoPor($this->getUser());
            $signosVitales->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($signosVitales);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('signos_vitales/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
