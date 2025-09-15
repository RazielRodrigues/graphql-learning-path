<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\Command\CreateEmailCommand;
use App\Application\Command\FindEmailQuery;
use App\Domain\Bus\Command\CommandBus;
use App\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Messenger\RunCommandMessage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\Messenger\PingWebhookMessage;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class ApiController extends AbstractController {

    public function __construct(
        private QueryBus $queryBus,
        private CommandBus $commandBus,
        private MessageBusInterface $bus
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
        $envelope = $this->commandBus->dispatch($command);
        #$this->bus->dispatch(new RunCommandMessage('cache:clear'));

        // get the value that was returned by the last message handler
        $handledStamp = $envelope->last(HandledStamp::class);

        // or get info about all of handlers
        //$handledStamps = $envelope->all(HandledStamp::class);

        return new JsonResponse(['message' => print_r($handledStamp->getResult())]);
    }

    public function ping(): void
    {
        //// An HttpExceptionInterface is thrown on 3xx/4xx/5xx
        //$this->bus->dispatch(new PingWebhookMessage('GET', 'https://example.com/status'));
//
        //// Ping, but does not throw on 3xx/4xx/5xx
        //$this->bus->dispatch(new PingWebhookMessage('GET', 'https://example.com/status', throw: false));
//
        //// Any valid HttpClientInterface option can be used
        //$this->bus->dispatch(new PingWebhookMessage('POST', 'https://example.com/status', [
        //    'headers' => [
        //        'Authorization' => 'Bearer ...'
        //    ],
        //    'json' => [
        //        'data' => 'some-data',
        //    ],
        //]));
    }

}