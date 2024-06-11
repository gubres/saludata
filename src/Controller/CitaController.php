<?php

namespace App\Controller;

use DateTimeZone;
use App\Entity\Cita;
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
        $this->denyAccessUnlessGranted('ROLE_USER');
        $citas = $citaRepository->findAll();

        $events = [];
        foreach ($citas as $cita) {
            if (!$cita->isEliminado()) {
                $events[] = [
                    'id' => $cita->getId(),
                    'title' => $cita->getPaciente()->getNombre(),
                    'dni' => $cita->getPaciente()->getDni(),
                    'start' => $cita->getFechaCita()->format('Y-m-d\TH:i'),
                    'end' => $cita->getFechaCita()->modify('+20 minutes')->format('Y-m-d\TH:i'), // modificado aquí para ajustar la duración a 30 minutos
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
    public function ajaxAdd(Request $request, EntityManagerInterface $entityManager, CitaRepository $citaRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $paciente = $entityManager->getRepository(Paciente::class)->findOneBy(['dni' => $data['dni']]);
        if (!$paciente) {
            return new JsonResponse(['error' => 'Paciente no encontrado'], Response::HTTP_NOT_FOUND);
        }

        // Verificar si ya existe una cita para el mismo horario
        $fechaCita = new \DateTime($data['start'], new DateTimeZone('Europe/Madrid'));
        $citaExistente = $citaRepository->findOneBy(['paciente' => $paciente, 'fechaCita' => $fechaCita]);

        if ($citaExistente) {
            return new JsonResponse(['error' => 'El horario seleccionado no está disponible'], Response::HTTP_CONFLICT);
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
            'end' => $cita->getFechaCita()->modify('+20 minutes')->format('Y-m-d\TH:i'), // modificado aquí para ajustar la duración a 30 minutos
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

        // Crea un nuevo objeto DateTime con la fecha de inicio proporcionada
        $fechaCita = new \DateTime($data['start']);

        // Añade dos horas a la fecha de la cita
        $fechaCita->modify('+2 hours');

        // Establece la fecha de la cita con el nuevo horario
        $cita->setFechaCita($fechaCita);
        $cita->setFechaEdicion(new \DateTime('now', new DateTimeZone('Europe/Madrid')));

        $entityManager->flush();

        $event = [
            'id' => $cita->getId(),
            'title' => $cita->getPaciente()->getNombre(),
            'dni' => $cita->getPaciente()->getDni(),
            'start' => $cita->getFechaCita()->format('Y-m-d\TH:i'),
            'end' => $cita->getFechaCita()->modify('+20 minutes')->format('Y-m-d\TH:i'), // modificado aquí para ajustar la duración a 30 minutos
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

    #[Route('/citas/historial', name: 'citas_historial', methods: ['GET'])]
    public function historial(CitaRepository $citaRepository, Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            $citas = $citaRepository->findAll();
            $data = [];

            foreach ($citas as $cita) {
                $data[] = [
                    'id' => $cita->getId(),
                    'paciente' => [
                        'nombre' => $cita->getPaciente()->getNombre(),
                        'dni' => $cita->getPaciente()->getDni(),
                    ],
                    'fechaCita' => $cita->getFechaCita()->format('Y-m-d H:i'),
                    'creadoPor' => [
                        'email' => $cita->getCreadoPor() ? $cita->getCreadoPor()->getEmail() : 'Desconocido',
                    ],
                    'fechaCreacion' => $cita->getFechaCreacion()->format('Y-m-d H:i'),
                    'eliminado' => $cita->isEliminado() ? 'Sí' : 'No',
                ];
            }

            return new JsonResponse(['data' => $data]);
        }

        return $this->render('citas/historial.html.twig');
    }

    #[Route('/citas/graficos', name: 'citas_graficos')]
    public function graficos(CitaRepository $citaRepository): Response
    {
        $citas = $citaRepository->findBy(['eliminado' => false]);
        $citasPorFecha = [];
        $citasPorUsuario = [];

        foreach ($citas as $cita) {
            $fecha = $cita->getFechaCita()->format('Y-m');
            $usuario = $cita->getCreadoPor() ? $cita->getCreadoPor()->getNombre() : 'Desconocido';

            if (!isset($citasPorFecha[$fecha])) {
                $citasPorFecha[$fecha] = 0;
            }
            $citasPorFecha[$fecha]++;

            if (!isset($citasPorUsuario[$usuario])) {
                $citasPorUsuario[$usuario] = 0;
            }
            $citasPorUsuario[$usuario]++;
        }

        // Convertir los datos a arreglos de claves y valores para la plantilla
        $fechas = array_keys($citasPorFecha);
        $cantidadCitasPorFecha = array_values($citasPorFecha);
        $usuarios = array_keys($citasPorUsuario);
        $cantidadCitasPorUsuario = array_values($citasPorUsuario);

        return $this->render('citas/graficos.html.twig', [
            'fechas' => $fechas,
            'cantidadCitasPorFecha' => $cantidadCitasPorFecha,
            'usuarios' => $usuarios,
            'cantidadCitasPorUsuario' => $cantidadCitasPorUsuario,
        ]);
    }
}
