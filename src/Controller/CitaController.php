<?php

namespace App\Controller;

use DateTimeZone;
use App\Entity\Cita;
use App\Form\CitaType;
use App\Entity\Paciente;
use App\Repository\CitaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CitaController extends AbstractController
{
    #[Route('/citas', name: 'citas_index')]
    public function index(CitaRepository $citaRepository): Response
    {
        $citas = $citaRepository->findAll();

        $events = [];
        foreach ($citas as $cita) {
            if (!$cita->isEliminado()) {
                $events[] = [
                    'id' => $cita->getId(),
                    'title' => $cita->getPaciente()->getNombre(),
                    'dni' => $cita->getPaciente()->getDni(),
                    'start' => $cita->getFechaCita()->format('Y-m-d\TH:i'),
                    'end' => $cita->getFechaCita()->modify('+30 minutes')->format('Y-m-d\TH:i'), // modificado aquí para ajustar la duración a 30 minutos
                ];
            }
        }

        return $this->render('citas/calendar.html.twig', [
            'events' => json_encode($events),
            'ajax_add_url' => $this->generateUrl('citas_ajax_add'),
            'ajax_update_url' => $this->generateUrl('citas_ajax_update', ['id' => 'EVENT_ID']),
            'ajax_delete_url' => $this->generateUrl('citas_ajax_delete', ['id' => 'EVENT_ID']),
        ]);
    }

    #[Route('/citas/ajax/add', name: 'citas_ajax_add', methods: ['POST'])]
    public function ajaxAdd(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $paciente = $entityManager->getRepository(Paciente::class)->findOneBy(['dni' => $data['dni']]);
        if (!$paciente) {
            return new JsonResponse(['error' => 'Paciente no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $cita = new Cita();
        $cita->setPaciente($paciente);
        $cita->setFechaCita(new \DateTime($data['start'], new DateTimeZone('Europe/Madrid')));
        $cita->setCreadoPor($this->getUser());
        $cita->setFechaCreacion(new \DateTime('now', new DateTimeZone('Europe/Madrid')));

        $entityManager->persist($cita);
        $entityManager->flush();

        $event = [
            'id' => $cita->getId(),
            'title' => $cita->getPaciente()->getNombre(),
            'dni' => $cita->getPaciente()->getDni(),
            'start' => $cita->getFechaCita()->format('Y-m-d\TH:i'),
            'end' => $cita->getFechaCita()->modify('+30 minutes')->format('Y-m-d\TH:i'), // modificado aquí para ajustar la duración a 30 minutos
        ];

        return new JsonResponse($event, Response::HTTP_CREATED);
    }

    #[Route('/citas/ajax/update/{id}', name: 'citas_ajax_update', methods: ['POST'])]
    public function ajaxUpdate(Request $request, EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $cita = $entityManager->getRepository(Cita::class)->find($id);

        if (!$cita) {
            return new JsonResponse(['error' => 'Cita no encontrada'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $cita->setFechaCita(new \DateTime($data['start'], new DateTimeZone('Europe/Madrid')));
        $cita->setFechaEdicion(new \DateTime('now', new DateTimeZone('Europe/Madrid')));

        $entityManager->flush();

        $event = [
            'id' => $cita->getId(),
            'title' => $cita->getPaciente()->getNombre(),
            'dni' => $cita->getPaciente()->getDni(),
            'start' => $cita->getFechaCita()->format('Y-m-d\TH:i'),
            'end' => $cita->getFechaCita()->modify('+30 minutes')->format('Y-m-d\TH:i'), // modificado aquí para ajustar la duración a 30 minutos
        ];

        return new JsonResponse($event, Response::HTTP_OK);
    }

    #[Route('/citas/ajax/delete/{id}', name: 'citas_ajax_delete', methods: ['DELETE'])]
    public function ajaxDelete(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $cita = $entityManager->getRepository(Cita::class)->find($id);

        if (!$cita) {
            return new JsonResponse(['error' => 'Cita no encontrada'], Response::HTTP_NOT_FOUND);
        }

        $cita->setEliminado(true);
        $entityManager->flush();

        return new JsonResponse(['success' => 'Cita eliminada'], Response::HTTP_OK);
    }
}
