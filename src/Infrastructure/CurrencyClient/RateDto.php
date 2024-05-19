<?php

declare(strict_types=1);

namespace App\Infrastructure\CurrencyClient;

final readonly class RateDto
{
    public function __construct(
        public string $id,
        public string $code,
        public string $name,
        public string $value,
    ) {
    }
}