<?php

declare(strict_types=1);

namespace App\Infrastructure\CurrencyClient;

final readonly class RatesResponse
{
    /**
     * @param array<RateDto> $rates
     */
    public function __construct(
        public \DateTimeImmutable $date,
        public array $rates
    ) {
    }
}