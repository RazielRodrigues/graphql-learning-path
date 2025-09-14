<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Command\CreateEmailCommand;
use App\Domain\Bus\Command\CommandHandler;
use App\Entity\Email;
use App\Service\EmailService;

class CreateEmailCommandHandler implements CommandHandler
{

    public function __construct(private EmailService $emailService) {
    }

    public function __invoke(CreateEmailCommand $command) : Email {
        // 1 - criar
        $email = $this->emailService->createEmail($command);
        // 2 - disparar um evento para fazer event storming
        return $email;
    }


}