<?php

declare(strict_types=1);

namespace App\Rates;

use App\Rates\DTO\ResponseDto;

final class RateService
{
    public function __construct(private readonly RateRepository $rateRepository)
    {
    }

    public function find(\DateTimeImmutable $date, ?string $currency, string $baseCurrency): ResponseDto
    {
        if ($baseCurrency !== Currency::CODE_RUR) {
            return $this->calculateCrossRate($date, $currency, $currency);
        }

        $rates = $this->rateRepository->findByParams($date, $currency, $currency);

        return new ResponseDto([]);
    }

    private function calculateCrossRate(\DateTimeImmutable $date, ?string $currency, string $baseCurrency): ResponseDto
    {
        $firstRate = $this->rateRepository->findByParams($date, $baseCurrency, Currency::CODE_RUR);
        $secondRate = $this->rateRepository->findByParams($date, $currency, Currency::CODE_RUR);

        return new ResponseDto([]);
    }
}