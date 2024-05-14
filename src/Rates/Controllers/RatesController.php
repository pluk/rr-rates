<?php

namespace App\Rates\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class RatesController extends AbstractController
{
    #[Route('/rates', name: 'app_rates')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RatesController.php',
        ]);
    }
}
