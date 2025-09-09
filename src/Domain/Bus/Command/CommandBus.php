<?php

namespace App\Domain\Bus\Command;

interface CommandBus
{
    public function dispatch(Command $command) : void;
}