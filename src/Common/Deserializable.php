<?php

namespace App\Common;

interface Deserializable
{
    public static function fromArray(array $data): self;
}
