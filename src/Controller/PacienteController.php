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
use App\Repository\PacienteRepository;


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

    #[Route('nuevo_paciente', name: 'app_registar_paciente', methods: ["GET", "POST"])]
    public function registrarPaciente(Request $request, PacienteRepository $pacienteRepository): Response
    {
        if ($request->isMethod('POST')) {
            $dni = $request->request->get('dni', '');
            $nombre = $request->request->get('nombre', '');

            // Verifica si el DNI ya existe
            $existingPaciente = $pacienteRepository->findOneBy(['DNI' => $dni]);
            if ($existingPaciente) {
                $this->addFlash('error', 'El número de DNI ya existe');
                return $this->redirectToRoute('app_perfil');
            }

            $paciente = new Paciente();

            $paciente->setNombre($nombre);
            $paciente->setApellido($request->request->get('apellidos'));
            $paciente->setDni($dni);
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
            $paciente->setUpdatedAt(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
            $paciente->setUpdatedBy($user);

            // Carga y manejo de la imagen
            $imagenFile = $request->files->get('imagen');
            if ($imagenFile) {
                if ($imagenFile->getError() == UPLOAD_ERR_OK) {
                    $blob = fopen($imagenFile->getRealPath(), 'rb');  // Abre el archivo en modo binario
                    $paciente->setImagen(stream_get_contents($blob));  // Guarda los datos binarios en la entidad
                } else {
                    $this->addFlash('error', 'Error al cargar el archivo: ' . $imagenFile->getErrorMessage());
                }
            } else {
                $this->addFlash('error', 'No se proporcionó archivo de imagen.');
            }


            $this->entityManager->persist($paciente);
            $this->entityManager->flush();

            $this->addFlash('success', 'Paciente registrado con éxito');
            return $this->redirectToRoute('app_perfil');
        }
        // Renderizar el formulario si no es POST
        return $this->render('perfil/nuevo_paciente.html.twig');
    }

    #[Route('/paciente/ver/{id}', name: 'paciente_ver')]
    public function verPaciente(int $id, EntityManagerInterface $em): Response
    {
        $paciente = $em->getRepository(Paciente::class)->find($id);

        if (!$paciente) {
            throw $this->createNotFoundException('No se encontró el paciente con el ID ' . $id);
        }

        $imagenData = $paciente->getImagen();
        $base64Image = null;
        if ($imagenData) {
            // Asegúrate de reiniciar el puntero de los datos del blob antes de leer
            rewind($imagenData);
            $base64Image = 'data:image/png;base64,' . base64_encode(stream_get_contents($imagenData));
        }

        return $this->render('paciente/ver.html.twig', [
            'paciente' => $paciente,
            'imagen' => $base64Image
        ]);
    }
}
