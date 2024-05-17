<?php

namespace App\Infrastructure\CurrencyClient;

interface ExternalCurrencyClient
{
    public function getRateByDate(\DateTimeImmutable $date): RatesResponse;
}