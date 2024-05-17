<?php

declare(strict_types=1);

namespace App\Rates;

use App\Rates\DTO\ResponseDto;
use App\Rates\Entity\Currency;
use App\Rates\Entity\Rate;
use App\Rates\Repository\RateRepository;

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

        $rates = $this->rateRepository->findByParams($date, $currency, $baseCurrency);

        return new ResponseDto(
            $rates[0]->date ?? $date,
            array_map(static fn (Rate $rate) => $rate->toArray(), $rates)
        );
    }

    private function calculateCrossRate(\DateTimeImmutable $date, ?string $currency, string $baseCurrency): ResponseDto
    {
        $firstRate = $this->rateRepository->findByParams($date, $baseCurrency, Currency::CODE_RUR);
        $secondRates = $this->rateRepository->findByParams($date, $currency, Currency::CODE_RUR);

        //!!!!!!!!!!!
        $date = new \DateTimeImmutable();
        $response = new ResponseDto($date, []);

        foreach ($secondRates as $secondRate) {
            $response->addRate([
                'currency' => '',
                'base_currency' => '',
                'value' => '',
            ]);
        }

        return $response;
    }
}