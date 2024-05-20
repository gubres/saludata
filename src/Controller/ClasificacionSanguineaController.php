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
use App\Entity\Paciente;
use DateTimeZone;

class ClasificacionSanguineaController extends AbstractController
{
    #[Route('/clasificacion-sanguinea/nuevo/{id}', name: 'clasificacion_sanguinea_new')]
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

        $clasificacionSanguinea = new ClasificacionSanguinea();
        $clasificacionSanguinea->setHistorialClinico($historialClinico);

        $form = $this->createForm(ClasificacionSanguineaType::class, $clasificacionSanguinea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clasificacionSanguinea->setCreadoPor($this->getUser());
            $clasificacionSanguinea->setCreadoEn(new \DateTime('now',  new DateTimeZone('Europe/Madrid')));

            //actualizar el paciente para que figure la nueva modifica y se sepa la fecha de la ultima visita
            $paciente->setUpdatedAt(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
            $entityManager->persist($paciente);
            $entityManager->persist($clasificacionSanguinea);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $paciente->getId()]);
        }

        return $this->render('clasificacion_sanguinea/new.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente,
        ]);
    }
}
