<?php

namespace App\Infrastructure\CurrencyClient;

interface ExternalCurrencyClient
{
    public function getRatesByDate(\DateTimeImmutable $date): RatesResponse;
}