<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Bus\Query\QueryHandler;
use App\Entity\Email;
use App\Repository\EmailRepository;
use InvalidArgumentException;

final class FindEmailQueryHandler implements QueryHandler
{

    public function __construct(private EmailRepository $repository)
    {
    }

    public function __invoke(FindEmailQuery $query) : array
    {
         $email = $this->repository->findAll();

        if ($email === null) {
            throw new InvalidArgumentException('Email not found');
        }

        return $email;
    }
}