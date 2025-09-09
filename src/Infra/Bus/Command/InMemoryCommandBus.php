<?php

namespace App\Infra\Bus\Command;

use App\Domain\Bus\Command\Command;
use App\Domain\Bus\Command\CommandBus;
use App\Domain\Bus\HandlerBuilder;
use App\Domain\Bus\Query\Query;
use App\Domain\Bus\Query\Response;
use Exception;
use InvalidArgumentException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class InMemoryCommandBus implements CommandBus
{
    private MessageBus $messageBus;

    public function __construct(iterable $commandHandlers) {
        $this->messageBus = new MessageBus([
            new HandleMessageMiddleware(
                new HandlersLocator(
                   HandlerBuilder::fromCallables($commandHandlers)
                )
            )
        ]);
    }

    public function dispatch(Command $command) : void
    {
        try {
            $this->messageBus->dispatch($command);
        } catch (NoHandlerForMessageException|Exception $th) {
            throw $th;
        }
    }

    public function ask(Query $query): Response|null
    {
        try {
            /** @var HandledStamp $stamp */
            $stamp = $this->messageBus->dispatch($query)->last(HandledStamp::class);

            return $stamp->getResult();
        } catch (NoHandlerForMessageException $e) {
            throw new InvalidArgumentException(sprintf('The query has not a valid handler: %s', $query::class));
        }
    }

}