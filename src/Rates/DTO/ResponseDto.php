<?php

declare(strict_types=1);

namespace App\Rates\DTO;

use App\Rates\Currency;

class ResponseDto
{
    public function __construct(
        public array $rates
    ) {
    }
}