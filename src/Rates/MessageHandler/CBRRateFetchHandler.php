<?php

declare(strict_types=1);

namespace App\Rates\MessageHandler;

use App\Rates\Message\CBRRateFetch;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class CBRRateFetchHandler
{
    public function __construct(
    ) {
    }

    public function __invoke(CBRRateFetch $message)
    {

        // do something with your message
    }
}
