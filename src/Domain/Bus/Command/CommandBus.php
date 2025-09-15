<?php

namespace App\Domain\Bus\Command;

use Symfony\Component\Messenger\Envelope;

interface CommandBus
{
    public function dispatch(Command $command) : Envelope;
}