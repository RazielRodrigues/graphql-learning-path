<?php

namespace App\GraphQL\Resolver;

use App\Repository\CharacterRepository;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;
use Overblog\GraphQLBundle\Resolver\ResolverMap;

class CharacterResolver extends ResolverMap
{
    public function __construct(public CharacterRepository $characterRepository) {}

    protected function map()
    {
        return [
            'Query' => [
                self::RESOLVE_FIELD => function ($value, ArgumentInterface $args, \ArrayObject $context, ResolveInfo $info) {
                    $id = (int) $args['id'];
                    if ($id) {
                        return $this->characterRepository->find($id);
                    }
                    return $this->characterRepository->findAll();
                },
            ],
        ];
    }
}
