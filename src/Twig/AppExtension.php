<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('age', [$this, 'calculateAge']),
        ];
    }

    public function calculateAge(\DateTimeInterface $birthdate): string
    {
        $today = new \DateTime();
        $interval = $today->diff($birthdate);

        $years = $interval->y;
        $months = $interval->m;

        return "$years años y $months meses";
    }
}
