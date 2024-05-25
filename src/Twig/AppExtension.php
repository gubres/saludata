<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    /**
     * @return TwigFilter[]
     */
    public function getFilters(): array
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

        $yearsText = $years === 1 ? "$years año" : "$years años";
        $monthsText = $months === 1 ? "$months mes" : "$months meses";

        if ($years === 0) {
            return $monthsText;
        }

        if ($months === 0) {
            return $yearsText;
        }

        return "$yearsText y $monthsText";
    }
}
