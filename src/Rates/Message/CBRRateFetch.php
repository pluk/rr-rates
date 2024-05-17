<?php

declare(strict_types=1);

namespace App\Rates\Message;

final readonly class CBRRateFetch
{
     public function __construct(
         public string $date,
     ) {
     }
}
