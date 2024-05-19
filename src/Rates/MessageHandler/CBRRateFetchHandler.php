<?php

declare(strict_types=1);

namespace App\Rates\MessageHandler;

use App\Rates\Message\CBRRateFetch;
use App\Rates\RateImporter;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class CBRRateFetchHandler
{
    public function __construct(
        private readonly RateImporter $rateImporter
    ) {
    }

    public function __invoke(CBRRateFetch $message)
    {
        try {
            $date = new \DateTimeImmutable($message->date);
            $this->rateImporter->importRatesByDate($date);
        } catch (\Throwable $exception) {
            error_log(sprintf(
                'Exception %s: "%s" at %s line %s. Stack Trace: %s',
                $exception::class,
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine(),
                $exception->getTraceAsString()
            ));
            return;
        }

    }
}
