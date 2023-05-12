<?php

namespace App\Common\Trait;

use InvalidArgumentException;

trait Enum
{
    public static function fromName(string $name): static
    {
        $cases = static::casesWithName($name);
        if (empty($cases)) {
            throw new InvalidArgumentException("Invalid case " . $name . " for enum " . array_reverse(explode('\\', static::class))[0]);
        }
         return array_values($cases)[0];
    }

    public static function tryFromName(string $name): ?static
    {
        return array_values(static::casesWithName($name))[0] ?? null;
    }

    /**
     * @return static[]
     */
    protected static function casesWithName(string $name): array
    {
        return array_filter(static::cases(), function (self $item) use ($name) {
            return $item->name == $name;
        });
    }
}
