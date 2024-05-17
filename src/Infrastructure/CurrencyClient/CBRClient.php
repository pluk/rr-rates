<?php

declare(strict_types=1);

namespace App\Infrastructure\CurrencyClient;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

final readonly class CBRClient implements ExternalCurrencyClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://www.cbr.ru/',
            RequestOptions::HTTP_ERRORS => false
        ]);
    }

    public function getRateByDate(\DateTimeImmutable $date): RatesResponse
    {
        $response = $this->client->get('scripts/XML_daily.asp', [
            RequestOptions::QUERY => [
                'date_req' => $date->format('d/m/Y'),
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new Exception(
                sprintf('Не удалось получить курсы валют. Код ответа: %d', $response->getStatusCode())
            );
        }

        $xml = simplexml_load_string($response->getBody()->getContents());

        if ($xml === false) {
            throw new Exception('Неверный формат ответа');
        }

        return $this->parseXml($xml);
    }

    private function parseXml(\SimpleXMLElement $xml): RatesResponse
    {
        $rates = [];
        try {
            $date = new \DateTimeImmutable((string) $xml['Date']);

            foreach ($xml->Valute as $valute) {
                $rates[] = new RateDto(
                    (string) $valute->CharCode,
                    (string) $valute->Name,
                    (string) $valute->Value
                );
            }
        } catch (\Throwable $e) {
            throw new Exception(sprintf('Неверный формат ответа. Причина: %s', $e->getMessage()));
        }

        return new RatesResponse($date, $rates);
    }
}