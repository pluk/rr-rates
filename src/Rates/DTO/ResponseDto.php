<?php

declare(strict_types=1);

namespace App\Rates\DTO;

class ResponseDto
{
    /**
     * @param array<array{
     *     'currency': array,
     *     'base_currency': array,
     *     'value': string
     * }> $rates
     */
    public function __construct(
        public readonly \DateTimeInterface $date,
        private array $rates,
    ) {
    }

    /**
     * @param array{
     *     'currency': array,
     *     'base_currency': array,
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