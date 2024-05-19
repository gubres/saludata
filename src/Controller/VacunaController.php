<?php

namespace App\Controller;

use App\Entity\Vacuna;
use App\Form\VacunaType;
use App\Entity\HistorialClinico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VacunaController extends AbstractController
{
    #[Route('/vacunas/nuevo/{id}', name: 'vacunas_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $vacuna = new Vacuna();
        $vacuna->setHistorialClinico($historialClinico);

        $form = $this->createForm(VacunaType::class, $vacuna);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vacuna->setCreadoPor($this->getUser());
            $vacuna->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($vacuna);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('vacuna/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
