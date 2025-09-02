<?php

namespace App\GraphQL\Mutation;

use App\Entity\Character;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class CharacterMutation implements MutationInterface, AliasedInterface
{

    public function __construct(private EntityManagerInterface $entityManagerInterface) {
     }

    public function addCharacter(string $name) : void
    {
        $character = new Character();
        $character->setName($name);
        $this->entityManagerInterface->persist($character);
        $this->entityManagerInterface->flush();
     }

    
     public static function getAliases(): array
     {
        return [
            'addCharacter' => 'add_character'
        ];
     }


}