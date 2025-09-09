<?php

namespace App\GraphQL\Resolver;

use App\Repository\CharacterRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class CharacterResolver implements QueryInterface, AliasedInterface
{
    public function __construct(public CharacterRepository $characterRepository) {}

    public function get(?string $name)
    {
        return $name ? $this->characterRepository->findBy(['name' => $name]) : $this->characterRepository->findAll();
    }

      public static function getAliases(): array
    {
        return ['get' => 'get'];
    }
}
