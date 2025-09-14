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
        $findEmailResponse = $this->queryBus->handle(
            new FindEmailQuery(email: 'mail@mail.com')
        );

        $emails = $findEmailResponse;

        # fix
        return new JsonResponse(['message' => $emails[3]->getEmail()]);
    }

    #[Route(path: '/email/create', name: 'command', methods: ['GET'])]
    public function create() : Response {

        $command = new CreateEmailCommand(email: 'mail@mail.com' . microtime(), name: 'Raziel Rodrigues');
        $this->commandBus->dispatch($command);

        return new JsonResponse(['message' => $command->email() . ' created']);
    }

}