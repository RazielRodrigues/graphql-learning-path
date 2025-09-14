<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\Command\CreateEmailCommand;
use App\Application\Command\FindEmailQuery;
use App\Domain\Bus\Command\CommandBus;
use App\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController {

    public function __construct(
        private QueryBus $queryBus,
        private CommandBus $commandBus,
    ) {
    }

    #[Route(path: '/', name: 'app_api_home', methods: ['POST'])]
    public function home() : Response {
        return new JsonResponse(['status' => Response::HTTP_OK]);
    }

    #[Route(path: '/email', name: 'query', methods: ['GET'])]
    public function query() : Response {
        $findEmailResponse = $this->queryBus->ask(
            new FindEmailQuery(email: 'mail@mail.com')
        );

        $email = $findEmailResponse->email();

        return new JsonResponse(['message' => $email]);
    }

    #[Route(path: '/email/create', name: 'command', methods: ['GET'])]
    public function create() : Response {

        $this->commandBus->dispatch(
            new CreateEmailCommand(email: 'mail@mail.com', name: 'Raziel Rodrigues')
        );

        return new JsonResponse(['message' => 'ok']);
    }

}