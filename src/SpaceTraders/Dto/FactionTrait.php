<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\FactionTraitType;
use JsonSerializable;

class FactionTrait implements JsonSerializable, Deserializable
{
    protected FactionTraitType $type;
    protected string $name;
    protected string $description;

    /**
     * @param FactionTraitType $type
     * @param string           $name
     * @param string           $description
     */
    public function __construct(FactionTraitType $type, string $name, string $description)
    {
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return FactionTraitType
     */
    public function getType(): FactionTraitType
    {
        return $this->type;
    }

    /**
     * @param  FactionTraitType $type
     * @return FactionTrait
     */
    public function setType(FactionTraitType $type): FactionTrait
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string $name
     * @return FactionTrait
     */
    public function setName(string $name): FactionTrait
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param  string $description
     * @return FactionTrait
     */
    public function setDescription(string $description): FactionTrait
    {
        $this->description = $description;
        return $this;
    }

    public function fromArray(array $data): static
    {
        // TODO: Implement fromArray() method.
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
