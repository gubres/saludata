<?php

namespace App\Controller;

use App\Entity\HistorialFamiliar;
use App\Entity\HistorialClinico;
use App\Form\HistorialFamiliarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class HistorialFamiliarController extends AbstractController
{
    private $entityManager;
    private $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('/historial-familiar/nuevo/{id}', name: 'historial_familiar_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $historialFamiliar = new HistorialFamiliar();
        $historialFamiliar->setHistorialClinico($historialClinico);

        $form = $this->createForm(HistorialFamiliarType::class, $historialFamiliar);
        $form->handleRequest($request);

        // Asignar el ID del sanitario (usuario logueado)
        $token = $this->tokenStorage->getToken();
        $user = null;
        if ($token) {
            $user = $token->getUser();
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $historialFamiliar->setCreadoPor($user);
            $historialFamiliar->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($historialFamiliar);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('historial_familiar/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
