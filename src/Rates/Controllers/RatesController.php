<?php

namespace App\Rates\Controllers;

use App\Rates\DTO\RatesFindDto;
use App\Rates\RateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RatesController extends AbstractController
{
    public function __construct(private readonly RateService $rateService)
    {
    }

    #[Route('/rates', name: 'api_rates', methods: ['GET'])]
    public function find(Request $request): JsonResponse
    {
        $dto = new RatesFindDto($request->query->all());

        $ratesResponse = $this->rateService->find($dto->date, $dto->currency, $dto->baseCurrency);

        return $this->json([
            'rates' => $ratesResponse->getRates(),
            'date' => $ratesResponse->date,
        ]);
    }
}
