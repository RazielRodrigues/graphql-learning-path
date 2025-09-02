<?php

namespace App\GraphQL\Resolver;

use App\Repository\CharacterRepository;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;
use Overblog\GraphQLBundle\Resolver\ResolverMap;

class CharacterResolver implements QueryInterface, AliasedInterface
{
    public function __construct(public CharacterRepository $characterRepository) {}

    public function get(?string $name)
    {
        return $this->characterRepository->findBy(['name' => $name]);
    }

      public static function getAliases(): array
    {
        return ['get' => 'get'];
    }
}
