<?php

namespace App\Service;

use setasign\Fpdi\Fpdi;

class ExtendedFpdi extends Fpdi
{
    public function setSourceFileFromString($pdfContent)
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'fpdi');
        file_put_contents($tempFile, $pdfContent);
        return $this->setSourceFile($tempFile);
    }
}
