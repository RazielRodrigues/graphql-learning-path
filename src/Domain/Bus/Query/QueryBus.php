<?php

namespace App\Domain\Bus\Query;

interface QueryBus
{
    public function ask(Query $query) : Response|null;
}
