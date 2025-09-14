<?php

namespace App\Infra\Bus;

use ReflectionClass;
use App\Domain\HandlerBuilderInterface;

class HandlerBuilder implements HandlerBuilderInterface {

    public static function fromCallables(iterable $callables) : array
    {
        $callablesHandlers = [];

        foreach($callables as $callable) {
            $envelope = self::extractFirstParameter($callable);

            if (! array_key_exists($envelope, $callablesHandlers)) {
                $callablesHandlers[self::extractFirstParameter($callable)] = [];
            }

            $callablesHandlers[self::extractFirstParameter($callable)][] = $callable;
        }

        return $callablesHandlers;
    }

    public static function extractFirstParameter(object|string $class) : ?string
    {
        $reflection = new ReflectionClass($class);
        $method = $reflection->getMethod('__invoke');

        if ($method->getNumberOfParameters() === 1) {
            return $method->getParameters()[0]->getClass()?->getName();
        }

        return null;
    }

}