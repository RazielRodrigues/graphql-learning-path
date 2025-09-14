<?php

namespace App\Domain\Bus\Query;

interface QueryBus
{
    public function handle(Query $query) : mixed;
}
