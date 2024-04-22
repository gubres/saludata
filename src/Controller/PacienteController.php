<?php

namespace App\Controller;

use DateTime;
use DateTimeZone;
use App\Entity\Paciente;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class PacienteController extends AbstractController
{
    private $entityManager;
    private $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }


    #[Route('/paciente', name: 'app_paciente')]
    public function index(): Response
    {
        return $this->render('paciente/index.html.twig', [
            'controller_name' => 'PacienteController',
        ]);
    }

    #[Route('/registar_paciente', name: 'app_registar_paciente')]
    public function registrarPaciente(Request $request): Response
    {
        $paciente = new Paciente();

        $paciente->setNombre($request->request->get('nombre'));
        $paciente->setApellido($request->request->get('apellidos'));
        $paciente->setDni($request->request->get('dni'));
        $paciente->setFechaNacimiento(new \DateTime($request->request->get('fecha_nacimiento')));
        $paciente->setProfesion($request->request->get('profesion'));
        $paciente->setDireccion($request->request->get('direccion'));
        $paciente->setGenero($request->request->get('genero'));
        $paciente->setEstadoCivil($request->request->get('estado_civil'));
        $paciente->setTelefono($request->request->get('telefono'));
        $paciente->setEmail($request->request->get('email'));

        // Asignar el ID del sanitario (usuario logueado)
        $token = $this->tokenStorage->getToken();
        $user = null;
        if ($token) {
            $user = $token->getUser();
        }
        $paciente->setSanitarioAsignado($user);

        // Datos adicionales de control
        $paciente->setEliminado(false);
        $paciente->setCreatedAt(new \DateTimeImmutable('now', new DateTimeZone('Europe/Madrid')));
        $paciente->setUpdatedAt(new DateTime('now', new DateTimeZone('Europe/Madrid')));
        $paciente->setUpdatedBy($user);

        $this->entityManager->persist($paciente);
        $this->entityManager->flush();

        $this->addFlash('success', 'Paciente registrado con éxito');

        return $this->redirectToRoute('app_perfil');
    }
    #[Route('/paciente/ver/{id}', name: 'paciente_ver')]
    public function verPaciente(int $id, EntityManagerInterface $em): Response
    {
        $paciente = $em->getRepository(Paciente::class)->find($id);

        if (!$paciente) {
            throw $this->createNotFoundException('No se encontró el paciente con el ID ' . $id);
        }

        return $this->render('paciente/ver.html.twig', [
            'paciente' => $paciente
        ]);
    }
}
