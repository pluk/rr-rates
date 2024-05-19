<?php

declare(strict_types=1);

namespace App\Rates;

use App\Rates\DTO\ResponseDto;
use App\Rates\Entity\Currency;
use App\Rates\Entity\Rate;
use App\Rates\Repository\RateRepository;

final readonly class RateService
{
    public function __construct(private RateRepository $rateRepository)
    {
    }

    public function find(\DateTimeImmutable $date, ?string $currency, string $baseCurrency): ResponseDto
    {
        if ($baseCurrency !== Currency::CODE_RUR) {
            return $this->calculateCrossRate($date, $currency, $baseCurrency);
        }

        $rates = $this->rateRepository->findLatestByParams($date, $currency);

        return new ResponseDto(
            $rates[0]->date ?? $date,
            array_map(static fn (Rate $rate) => $rate->toArray(), $rates)
        );
    }

    private function calculateCrossRate(\DateTimeImmutable $date, ?string $currency, string $baseCurrency): ResponseDto
    {
        $firstRate = $this->rateRepository->findLatestByParams($date, $baseCurrency);

        if ($firstRate === []) {
            return new ResponseDto($date, []);
        }

        $secondRates = $this->rateRepository->findLatestByParams($date, $currency);

        $response = new ResponseDto($firstRate[0]->date, []);

        foreach ($secondRates as $secondRate) {
            $response->addRate([
                'currency' => $secondRate->getCurrency()->toArray(),
                'value' => \bcdiv($secondRate->value, $firstRate[0]->value, 4),
            ]);
        }

        return $response;
    }
}