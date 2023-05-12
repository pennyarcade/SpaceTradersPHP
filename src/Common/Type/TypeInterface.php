<?php

namespace App\Common\Type;

use InvalidArgumentException;

interface TypeInterface
{
    /**
     * Type constructor.
     * @param mixed $value
     * @throws InvalidArgumentException
     */
    public function __construct($value);

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValidValue($value): bool;

    /**
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * @param mixed $value
     * @return self
     * @throws InvalidArgumentException
     */
    public function setValue($value): self;
}
