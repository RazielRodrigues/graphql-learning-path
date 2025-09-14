<?php

use App\Domain\Bus\Command\Command;
use App\Entity\Email;
use Doctrine\ORM\EntityManagerInterface;

class EmailService {

    public function __construct(private EntityManagerInterface $entityManager) {
    }


    public function createEmail(Command $command)
    {

        $email = new Email();
        $email->setEmail($command->email);
        $email->setName($command->name);

        $this->entityManager->persist($email);
        $this->entityManager->flush();
        
        return $email;
    }


}