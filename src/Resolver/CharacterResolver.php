<?php

// src/Resolver/MyResolverMap.php
namespace App\Resolver;

use Overblog\GraphQLBundle\Resolver\ResolverMap;

class CharacterResolver extends ResolverMap
{
    protected function map()
    {
        return [
            'Query' => [
                'characters' => function () {
                    return [
                        [
                            'name' => 'Raziel',
                            'appearsIn' => ['EMPIRE']
                        ]
                    ];
                }
            ]
        ];
    }

}
