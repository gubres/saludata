<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\PacienteRepository;

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
                'acciones' => '<a href="/paciente/ver/' . $paciente->getId() . '" class="btn btn-success" title="Ver paciente" >' .
                    '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">' .
                    '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 1 1.66-2.043C4.12 4.7 5.841 3.5 8 3.5c2.159 0 3.88 1.2 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.193.288-.42.62-1.03 1.319-1.923 2.025C11.118 11.331 9.651 12 8 12c-1.65 0-3.118-.669-4.71-1.687-.895-.706-1.505-1.405-1.925-2.025A13.433 13.433 0 0 1 1.172 8z"/>' .
                    '<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm0 1a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3z"/>' .
                    '</svg>' .
                    '</a>',
            ];
        }, $pacientes);

        return $this->json(['data' => $data]);
    }
}
