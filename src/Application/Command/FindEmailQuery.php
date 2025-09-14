<?php

namespace App\Application\Command;

use App\Domain\Bus\Query\Query;

final class FindEmailQuery implements Query
{
    public function __construct(public readonly string $email)
    {
    }

    public function email() : string
    {
        return $this->email;
    }
}