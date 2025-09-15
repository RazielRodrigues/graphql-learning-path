<?php

namespace App\Infra\Bus\Command;

use App\Domain\Bus\Command\Command;
use App\Domain\Bus\Command\CommandBus;
use App\Infra\Bus\HandlerBuilder;
use Exception;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

final class MessengerCommandBus implements CommandBus
{

    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function dispatch(Command $command): Envelope
    {
        return $this->commandBus->dispatch($command);
    }

}