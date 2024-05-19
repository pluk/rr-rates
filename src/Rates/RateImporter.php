<?php

declare(strict_types=1);

namespace App\Rates;

use App\Infrastructure\CurrencyClient\ExternalCurrencyClient;
use App\Rates\Entity\Currency;
use App\Rates\Entity\Rate;
use App\Rates\Repository\RateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final readonly class RateImporter
{
    private RateRepository|EntityRepository $rateRepository;
    private EntityRepository $currencyRepository;

    public function __construct(
        private ExternalCurrencyClient $currencyClient,
        private EntityManagerInterface $entityManager
    ) {
        $this->rateRepository = $this->entityManager->getRepository(Rate::class);
        $this->currencyRepository = $this->entityManager->getRepository(Currency::class);
    }

    public function importRatesByDate(\DateTimeImmutable $date): void
    {
        $response = $this->currencyClient->getRatesByDate($date);
        foreach ($response->rates as $rateDto) {
            $rate = $this->rateRepository->findByParams($response->date, $rateDto->code);

            if ($rate !== []) {
                continue;
            }

            if (($currency = $this->currencyRepository->findOneBy(['code' => $rateDto->code])) === null) {
                $currency = new Currency($rateDto->id, $rateDto->code, $rateDto->name);
                $this->entityManager->persist($currency);
            }

            $rate = new Rate($response->date, $currency, $rateDto->value);

            $this->entityManager->persist($rate);
        }

        $this->entityManager->flush();
    }
}