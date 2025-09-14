<?php

namespace App\Domain;

interface HandlerBuilderInterface
{
    public static function fromCallables(iterable $callables): array;
    public static function extractFirstParameter(object|string $class): ?string;
}