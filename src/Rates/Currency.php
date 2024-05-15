<?php

declare(strict_types=1);

namespace App\Rates;

final class Currency
{
    final public const string CODE_RUR = 'RUR';

    private int $id;
    private string $code;
    private string $name;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
        ];
    }
}