<?php

namespace App\Application\Command;

use App\Domain\Bus\Query\Query;

final class FindEmailQuery implements Query
{
    public function __construct(private readonly string $email)
    {
    }

    public function email() : int
    {
        return $this->email;
    }
}