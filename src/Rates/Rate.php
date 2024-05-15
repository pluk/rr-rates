<?php

declare(strict_types=1);

namespace App\Rates;

final readonly class Rate
{
    private int $id;
    private Currency $currency;
    private string $value;
    private Currency $baseCurrency;

    public function toArray(): array
    {
        return [
            'currency' => $this->currency->toArray(),
            'base_currency' => $this->baseCurrency->toArray(),
            'value' => $this->value,
        ];
    }
}
