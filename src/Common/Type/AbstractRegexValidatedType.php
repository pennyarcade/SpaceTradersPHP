<?php

namespace App\Common\Type;

use InvalidArgumentException;

abstract class AbstractRegexValidatedType implements TypeInterface
{
    /** @var mixed $value */
    protected $value;

    /**
     * return static regex pattern string
     * @return string
     */
    abstract protected static function pattern(): string;

    /**
     * Base64String constructor.
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValidValue($value): bool
    {
        return (bool)preg_match($this->pattern(), $value);
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue($value): TypeInterface
    {
        if (!$this->isValidValue($value)) {
            throw new InvalidArgumentException(
                'Invalid value for ' . static::class
            );
        }
        $this->value = $value;
        return $this;
    }
}
