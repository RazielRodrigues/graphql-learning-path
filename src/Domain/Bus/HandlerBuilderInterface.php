<?php

namespace App\Domain\Bus;

interface HandlerBuilderInterface
{
    public static function fromCallables(iterable $callables): array;
    public static function extractFirstParameter(object|string $class): ?string;
}