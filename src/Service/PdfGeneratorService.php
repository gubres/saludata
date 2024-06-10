<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Service\ExtendedFpdi;

class PdfGeneratorService
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function generatePdf($template, $data, $filename, array $extraPdfPaths = []): Response
    {
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true); // Habilitar recursos remotos
        $dompdf = new Dompdf($options);

        $html = $this->twig->render($template, $data);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Obtener el contenido del PDF generado por Dompdf
        $output = $dompdf->output();

        if (!empty($extraPdfPaths)) {
            // Crear un nuevo documento ExtendedFpdi
            $pdf = new ExtendedFpdi();

            // Añadir el contenido del PDF generado por Dompdf
            $pageCount = $pdf->setSourceFileFromString($output);
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $pdf->AddPage();
                $tplIdx = $pdf->importPage($pageNo);
                $pdf->useTemplate($tplIdx, 10, 10, 200);
            }

            // Añadir cada uno de los PDFs adicionales
            foreach ($extraPdfPaths as $extraPdfPath) {
                $pageCount = $pdf->setSourceFile($extraPdfPath);
                for ($i = 1; $i <= $pageCount; $i++) {
                    $pdf->AddPage();
                    $tplIdx = $pdf->importPage($i);
                    $pdf->useTemplate($tplIdx, 10, 10, 200);
                }
            }

            $output = $pdf->Output('S');
        }


        // Crear la respuesta de Symfony
        $response = new Response($output);
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename . '"');

        return $response;
    }
}
