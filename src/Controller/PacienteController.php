<?php

namespace App\Controller;

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
use App\Service\PdfGeneratorService;
use App\Entity\ClasificacionSanguinea;
use App\Repository\PacienteRepository;
use App\Entity\ExamenMiembrosInferiores;
use App\Entity\ExamenMiembrosSuperiores;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\HistoricoObstetricoYGinecologico;
use Symfony\Component\HttpFoundation\JsonResponse;
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
            $existingPaciente = $pacienteRepository->findOneBy(['dni' => $dni]);
            if ($existingPaciente) {
                return new JsonResponse(['status' => 'error', 'message' => 'El número de DNI ya existe'], Response::HTTP_BAD_REQUEST);
            }

            $paciente = new Paciente();
            $paciente->setNombre($nombre);
            $paciente->setApellido($request->request->get('apellido'));
            $paciente->setDni($dni);
            $paciente->setFechaNacimiento(new \DateTime($request->request->get('fecha_nacimiento')));
            $paciente->setProfesion($request->request->get('profesion'));
            $paciente->setDireccion($request->request->get('direccion'));
            $paciente->setCiudad($request->request->get('ciudad'));
            $paciente->setComunidadAutonoma($request->request->get('comunidadAutonoma', ''));
            $paciente->setPais($request->request->get('pais', ''));
            $paciente->setGenero($request->request->get('genero'));
            $paciente->setEstadoCivil($request->request->get('estado_civil'));
            $paciente->setTelefono($request->request->get('telefono'));
            $paciente->setEmail($request->request->get('email'));

            // Asignar el ID del sanitario (usuario logueado)
            $user = $this->tokenStorage->getToken()->getUser();
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
            // Iniciar la transacción
            $this->entityManager->beginTransaction();
            try {
                // Guardar el paciente
                $this->entityManager->persist($paciente);
                $this->entityManager->flush();

                // Crear y asociar el historial clínico al paciente
                $historialClinico = new HistorialClinico();
                $historialClinico->setPaciente($paciente);
                $historialClinico->setCreadoEn(new \DateTime('now'));
                $historialClinico->setCreadoPor($user);
                $historialClinico->setActualizadoEn(new \DateTime('now'));
                $historialClinico->setActualizadoPor($user);

                $this->entityManager->persist($historialClinico);
                $this->entityManager->flush();

                // Confirmar la transacción
                $this->entityManager->commit();

                return new JsonResponse(['status' => 'success', 'message' => 'Paciente registrado con éxito'], Response::HTTP_OK);
            } catch (\Exception $e) {
                $this->entityManager->rollback();
                return new JsonResponse(['status' => 'error', 'message' => 'Error al registrar el paciente: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

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
            'queja_actual' => $em->getRepository(QuejaActual::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'alergias' => $em->getRepository(Alergia::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'signos_vitales' => $em->getRepository(SignosVitales::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'vacunas' => $em->getRepository(Vacuna::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'clasificacion_sanguinea' => $em->getRepository(ClasificacionSanguinea::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'costumbres' => $em->getRepository(Costumbres::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'dietas' => $em->getRepository(Dieta::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'medicamentos' => $em->getRepository(Medicamento::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'historial_familiar' => $em->getRepository(HistorialFamiliar::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'historial_obstetrico_y_ginecologico' => $em->getRepository(HistoricoObstetricoYGinecologico::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'resultados_pruebas' => $em->getRepository(ResultadoPrueba::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_cabeza' => $em->getRepository(ExamenCabeza::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_torax' => $em->getRepository(ExamenTorax::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_abdomen' => $em->getRepository(ExamenAbdomen::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_pelvico' => $em->getRepository(ExamenPelvico::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_miembros_superiores' => $em->getRepository(ExamenMiembrosSuperiores::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_miembros_inferiores' => $em->getRepository(ExamenMiembrosInferiores::class)->findAllOrderedByCreadoEnDesc($historialClinico),
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
            $paciente->setCiudad($request->request->get('ciudad', ''));
            $paciente->setComunidadAutonoma($request->request->get('comunidadAutonoma', ''));
            $paciente->setPais($request->request->get('pais', ''));
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
    #[Route('/paciente/{id}/pdf', name: 'paciente_pdf')]
    public function generatePdf(PdfGeneratorService $pdfGenerator, EntityManagerInterface $em, int $id): Response
    {
        $paciente = $em->getRepository(Paciente::class)->find($id);

        if (!$paciente) {
            throw $this->createNotFoundException('Paciente no encontrado');
        }

        $user = $this->getUser();

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

        // Obtener el PDF adicional de resultados de pruebas
        $resultadoPrueba = $em->getRepository(ResultadoPrueba::class)->findOneBy(['historialClinico' => $historialClinico]);
        $extraPdfPath = null;

        if ($resultadoPrueba && $resultadoPrueba->getArchivo()) {
            $extraPdfPath = tempnam(sys_get_temp_dir(), 'resultado_prueba_') . '.pdf';
            file_put_contents($extraPdfPath, stream_get_contents($resultadoPrueba->getArchivo()));
        }

        $data = [
            'queja_actual' => $em->getRepository(QuejaActual::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'alergias' => $em->getRepository(Alergia::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'signos_vitales' => $em->getRepository(SignosVitales::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'vacunas' => $em->getRepository(Vacuna::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'clasificacion_sanguinea' => $em->getRepository(ClasificacionSanguinea::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'costumbres' => $em->getRepository(Costumbres::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'dietas' => $em->getRepository(Dieta::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'medicamentos' => $em->getRepository(Medicamento::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'historial_familiar' => $em->getRepository(HistorialFamiliar::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'historial_obstetrico_y_ginecologico' => $em->getRepository(HistoricoObstetricoYGinecologico::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'resultados_pruebas' => $em->getRepository(ResultadoPrueba::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_cabeza' => $em->getRepository(ExamenCabeza::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_torax' => $em->getRepository(ExamenTorax::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_abdomen' => $em->getRepository(ExamenAbdomen::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_pelvico' => $em->getRepository(ExamenPelvico::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_miembros_superiores' => $em->getRepository(ExamenMiembrosSuperiores::class)->findAllOrderedByCreadoEnDesc($historialClinico),
            'examen_miembros_inferiores' => $em->getRepository(ExamenMiembrosInferiores::class)->findAllOrderedByCreadoEnDesc($historialClinico),
        ];

        $data = [
            'paciente' => $paciente,
            'user' => $user,
            'date' => new \DateTime('now', new DateTimeZone('Europe/Madrid')),
            'data' => $data,
        ];

        return $pdfGenerator->generatePdf('pdf/paciente.html.twig', $data, 'informe_paciente.pdf', $extraPdfPath);
    }
}
