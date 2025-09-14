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

    #[Route(path: '/', name: 'home', methods: ['GET'])]
    public function home() : Response {
        return new JsonResponse(['message' => 'ok']);
    }

    #[Route(path: '/email/{email}', name: 'query', methods: ['GET'])]
    public function query(string $email) : Response {
        $findEmailResponse = $this->queryBus->ask(
            new FindEmailQuery(email: 'mail@mail.com')
        );

        $email = $findEmailResponse->email();

        return new JsonResponse(['message' => $email]);
    }

    #[Route(path: '/email/create/{email}', name: 'query', methods: ['GET'])]
    public function create(string $email) : Response {

        $this->commandBus->dispatch(
            new CreateEmailCommand(email: 'mail@mail.com', name: 'Raziel Rodrigues')
        );

        return new JsonResponse(['message' => 'ok']);
    }

}