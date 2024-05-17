<?php

declare(strict_types=1);

namespace App\Rates\DTO;

class ResponseDto
{
    /**
     * @param array<array{
     *     'currency': string,
     *     'base_currency': string,
     *     'value': string
     * }> $rates
     */
    public function __construct(
        public readonly \DateTimeImmutable $date,
        private array $rates,
    ) {
    }

    /**
     * @param array{
     *     'currency': string,
     *     'base_currency': string,
     *     'value': string
     * } $rate
     */
    public function addRate(array $rate): void
    {
        $this->rates[] = $rate;
    }

    public function getRates(): array
    {
        return $this->rates;
    }
}