<?php

namespace App\Controller;

use DateTime;
use DateTimeZone;
use App\Entity\Dieta;
use App\Entity\Vacuna;
use App\Entity\Alergia;
use App\Entity\Paciente;
use App\Entity\Costumbres;
use App\Entity\ExamenTorax;
use App\Entity\Medicamento;
use App\Entity\QuejaActual;
use App\Entity\ExamenCabeza;
use App\Entity\ExamenAbdomen;
use App\Entity\ExamenPelvico;
use App\Entity\SignosVitales;
use App\Entity\ResultadoPrueba;
use App\Entity\HistorialClinico;
use App\Entity\HistorialFamiliar;
use App\Entity\ClasificacionSanguinea;
use App\Repository\PacienteRepository;
use App\Entity\ExamenMiembrosInferiores;
use App\Entity\ExamenMiembrosSuperiores;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\HistoricoObstetricoYGinecologico;
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

    #[Route('nuevo_paciente', name: 'app_registar_paciente', methods: ["GET", "POST"])]
    public function registrarPaciente(Request $request, PacienteRepository $pacienteRepository): Response
    {
        if ($request->isXmlHttpRequest()) {
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
            $paciente->setCiudad($request->request->get('ciudad'));
            $paciente->setComunidadAutonoma($request->request->get('comunidad_autonoma'));
            $paciente->setPais($request->request->get('pais'));
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
            return $this->json(['status' => 'success', 'message' => 'Paciente registrado con éxito'], Response::HTTP_OK);
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
            rewind($imagenData);
            $base64Image = 'data:image/png;base64,' . base64_encode(stream_get_contents($imagenData));
        }

        $historialClinico = $em->getRepository(HistorialClinico::class)->findOneBy(['paciente' => $paciente]);

        if (!$historialClinico) {
            $historialClinico = new HistorialClinico();
            $historialClinico->setPaciente($paciente);
            $historialClinico->setCreadoEn(new \DateTime('now'));
            $historialClinico->setCreadoPor($this->getUser());
            $historialClinico->setActualizadoEn(new \DateTime('now'));
            $historialClinico->setActualizadoPor($this->getUser());
            $em->persist($historialClinico);
            $em->flush();
        }

        $data = [
            'queja_actual' => $em->getRepository(QuejaActual::class)->findBy(['historialClinico' => $historialClinico]),
            'alergias' => $em->getRepository(Alergia::class)->findBy(['historialClinico' => $historialClinico]),
            'signos_vitales' => $em->getRepository(SignosVitales::class)->findBy(['historialClinico' => $historialClinico]),
            'vacunas' => $em->getRepository(Vacuna::class)->findBy(['historialClinico' => $historialClinico]),
            'clasificacion_sanguinea' => $em->getRepository(ClasificacionSanguinea::class)->findOneBy(['historialClinico' => $historialClinico]),
            'costumbres' => $em->getRepository(Costumbres::class)->findOneBy(['historialClinico' => $historialClinico]),
            'dietas' => $em->getRepository(Dieta::class)->findBy(['historialClinico' => $historialClinico]),
            'medicamentos' => $em->getRepository(Medicamento::class)->findBy(['historialClinico' => $historialClinico]),
            'historial_familiar' => $em->getRepository(HistorialFamiliar::class)->findOneBy(['historialClinico' => $historialClinico]),
            'historial_obstetrico_y_ginecologico' => $em->getRepository(HistoricoObstetricoYGinecologico::class)->findOneBy(['historialClinico' => $historialClinico]),
            'resultados_pruebas' => $em->getRepository(ResultadoPrueba::class)->findBy(['historialClinico' => $historialClinico]),
            'examen_cabeza' => $em->getRepository(ExamenCabeza::class)->findBy(['historialClinico' => $historialClinico]),
            'examen_torax' => $em->getRepository(ExamenTorax::class)->findBy(['historialClinico' => $historialClinico]),
            'examen_abdomen' => $em->getRepository(ExamenAbdomen::class)->findBy(['historialClinico' => $historialClinico]),
            'examen_pelvico' => $em->getRepository(ExamenPelvico::class)->findBy(['historialClinico' => $historialClinico]),
            'examen_miembros_superiores' => $em->getRepository(ExamenMiembrosSuperiores::class)->findBy(['historialClinico' => $historialClinico]),
            'examen_miembros_inferiores' => $em->getRepository(ExamenMiembrosInferiores::class)->findBy(['historialClinico' => $historialClinico]),
        ];

        return $this->render('paciente/ver.html.twig', [
            'paciente' => $paciente,
            'imagen' => $base64Image,
            'data' => $data
        ]);
    }


    #[Route('/paciente/editar/{id}', name: 'paciente_editar')]
    public function editarPaciente(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $paciente = $em->getRepository(Paciente::class)->find($id);

        if (!$paciente) {
            throw $this->createNotFoundException('No se encontró el paciente con el ID ' . $id);
        }

        if ($request->isMethod('POST')) {
            $dni = $request->request->get('dni', '');
            $nombre = $request->request->get('nombre', '');

            // Actualizar los datos del paciente
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

            // Datos adicionales de control
            $paciente->setUpdatedAt(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
            $paciente->setUpdatedBy($this->getUser());

            // Carga y manejo de la imagen
            $imagenFile = $request->files->get('imagen');
            if ($imagenFile) {
                if ($imagenFile->getError() == UPLOAD_ERR_OK) {
                    $blob = fopen($imagenFile->getRealPath(), 'rb');  // Abre el archivo en modo binario
                    $paciente->setImagen(stream_get_contents($blob));  // Guarda los datos binarios en la entidad
                } else {
                    $this->addFlash('error', 'Error al cargar el archivo: ' . $imagenFile->getErrorMessage());
                }
            }

            $this->entityManager->flush();

            $this->addFlash('success', 'Paciente actualizado con éxito');
            return $this->redirectToRoute('paciente_ver', ['id' => $id]);
        }

        $imagenData = $paciente->getImagen();
        $base64Image = null;
        if ($imagenData !== null) {
            // Aquí se obtiene la imagen en Base64 correctamente
            $base64Image = 'data:image/png;base64,' . base64_encode(stream_get_contents($imagenData));
        }

        return $this->render('paciente/editar.html.twig', [
            'paciente' => $paciente,
            'imagen' => $base64Image,
        ]);
    }
}
