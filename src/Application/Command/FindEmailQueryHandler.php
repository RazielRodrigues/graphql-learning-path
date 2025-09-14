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

    public function __invoke(FindEmailQuery $query) : Email
    {
         $email = $this->repository->findById($query->email());

        if ($email === null) {
            throw new InvalidArgumentException('Email not found');
        }

        return $email;
    }
}