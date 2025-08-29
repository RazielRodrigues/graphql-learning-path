<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController {

    #[Route(path: '/', name: 'home', methods: ['GET'])]
    public function home() : Response {
        return new JsonResponse(['message' => 'ok']);
    }
}