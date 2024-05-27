<?php

namespace App\Controller;

use App\Repository\PacienteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PerfilController extends AbstractController
{
    private $pacienteRepository;

    public function __construct(PacienteRepository $pacienteRepository)
    {
        $this->pacienteRepository = $pacienteRepository;
    }

    #[Route('/perfil', name: 'app_perfil')]
    public function index(): Response
    {
        return $this->render('perfil/index.html.twig', [
            'controller_name' => 'PerfilController',
        ]);
    }

    #[Route('/perfil/data', name: 'perfil_data', methods: ['GET'])]
    public function pacienteData(): JsonResponse
    {
        $pacientes = $this->pacienteRepository->findNotDeleted();
        $data = array_map(function ($paciente) {

            return [
                'id' => $paciente->getId(),
                'dni' => $paciente->getDni(),
                'nombre' => $paciente->getNombre(),
                'apellidos' => $paciente->getApellido(),
                'acciones' => '<a href="/paciente/ver/' . $paciente->getId() . '" class="btn btn-light bi bi-eye" title="Ver paciente" ></a>',
            ];
        }, $pacientes);

        return $this->json(['data' => $data]);
    }
}
