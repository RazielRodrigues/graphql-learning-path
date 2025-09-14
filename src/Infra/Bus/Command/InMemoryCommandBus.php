<?php

namespace App\Infra\Bus\Command;

use App\Domain\Bus\Command\Command;
use App\Domain\Bus\Command\CommandBus;
use App\Infra\Bus\HandlerBuilder;
use Exception;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

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

}