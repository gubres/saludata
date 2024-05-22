<?php

namespace App\Controller;

use DateTimeZone;
use App\Entity\Paciente;
use App\Entity\ResultadoPrueba;
use App\Entity\HistorialClinico;
use App\Form\ResultadoPruebaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResultadoPruebaController extends AbstractController
{
    #[Route('/resultados-pruebas/nuevo/{id}', name: 'resultados_pruebas_new')]
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

        $resultadoPrueba = new ResultadoPrueba();
        $resultadoPrueba->setHistorialClinico($historialClinico);

        $form = $this->createForm(ResultadoPruebaType::class, $resultadoPrueba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resultadoPrueba->setCreadoPor($this->getUser());
            $resultadoPrueba->setCreadoEn(new \DateTime('now',  new DateTimeZone('Europe/Madrid')));

            // Handle file upload
            /** @var UploadedFile $file */
            $file = $form->get('archivo')->getData();
            if ($file) {
                $resultadoPrueba->setArchivo(file_get_contents($file->getPathname()));
            }

            // Actualizar el paciente para que figure la nueva modifica y se sepa la fecha de la ultima visita
            $paciente->setUpdatedAt(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
            $entityManager->persist($paciente);

            $entityManager->persist($resultadoPrueba);
            $entityManager->flush();

            return $this->redirectToRoute('paciente_ver', ['id' => $historialClinico->getPaciente()->getId()]);
        }

        return $this->render('resultados_pruebas/new.html.twig', [
            'form' => $form->createView(),
            'paciente' => $paciente,
        ]);
    }

    #[Route('/archivo/{id}', name: 'ver_archivo')]
    public function verArchivo(int $id, EntityManagerInterface $entityManager): Response
    {
        $prueba = $entityManager->getRepository(ResultadoPrueba::class)->find($id);

        if (!$prueba || !$prueba->getArchivo()) {
            throw $this->createNotFoundException('Archivo no encontrado');
        }

        $contenidoArchivo = stream_get_contents($prueba->getArchivo());
        if ($contenidoArchivo === false) {
            throw new \Exception('No se pudo leer el archivo');
        }

        $response = new Response($contenidoArchivo);
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'inline; filename="resultado_prueba.pdf"');

        return $response;
    }
}
