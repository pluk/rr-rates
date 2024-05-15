<?php

declare(strict_types=1);

namespace App\Rates\DTO;

final readonly class RatesFindDto
{
    public \DateTimeImmutable $date;
    public string|null $currency;
    public string $baseCurrency;

    public function __construct(array $queryParams) {
        $this->date = isset($queryParams['date']) ?
            new \DateTimeImmutable($queryParams['date']) :
            new \DateTimeImmutable();
        $this->baseCurrency = isset($queryParams['base_currency']) ?? 'RUR';
        $this->currency = isset($queryParams['currency']) ?? null;
    }
}