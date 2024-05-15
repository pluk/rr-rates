<?php

declare(strict_types=1);

namespace App\Rates;

class RateRepository
{
    /**
     * @return array<Rate>
     */
    public function findByParams(\DateTimeImmutable $date, ?string $currency, string $baseCurrency): array
    {
        return [];
    }
}