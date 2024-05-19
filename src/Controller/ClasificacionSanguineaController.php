<?php

namespace App\Controller;

use App\Entity\HistorialClinico;
use App\Entity\ClasificacionSanguinea;
use App\Form\ClasificacionSanguineaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasificacionSanguineaController extends AbstractController
{
    #[Route('/clasificacion-sanguinea/nuevo/{id}', name: 'clasificacion_sanguinea_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $historialClinico = $entityManager->getRepository(HistorialClinico::class)->find($id);

        if (!$historialClinico) {
            throw $this->createNotFoundException('No se encontró el historial clínico con el ID ' . $id);
        }

        $clasificacionSanguinea = new ClasificacionSanguinea();
        $clasificacionSanguinea->setHistorialClinico($historialClinico);

        $form = $this->createForm(ClasificacionSanguineaType::class, $clasificacionSanguinea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clasificacionSanguinea->setCreadoPor($this->getUser());
            $clasificacionSanguinea->setCreadoEn(new \DateTime('now'));

            $entityManager->persist($clasificacionSanguinea);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('clasificacion_sanguinea/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
