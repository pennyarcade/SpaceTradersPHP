<?php

namespace App\Common;

interface Deserializable
{
    public function fromArray(array $data): static;
}
