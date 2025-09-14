<?php

namespace App\Application\Command;

use App\Domain\Bus\Command\Command;

class CreateEmailCommand implements Command
{

    public function __construct(
        private string $email,
        private string $name
    ) {
    } 

    public function email(): string
    {
        return $this->email;
    }

    public function name(): string
    {
        return $this->name;
    }
}