<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\WaypointTraitSymbolType;
use JsonSerializable;

class WaypointTrait implements JsonSerializable, Deserializable
{
    protected WaypointTraitSymbolType $symbol;
    protected string $name;
    protected string $description;

    /**
     * @param WaypointTraitSymbolType $symbol
     * @param string $name
     * @param string $description
     */
    public function __construct(WaypointTraitSymbolType $symbol, string $name, string $description)
    {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return WaypointTraitSymbolType
     */
    public function getSymbol(): WaypointTraitSymbolType
    {
        return $this->symbol;
    }

    /**
     * @param WaypointTraitSymbolType $symbol
     * @return WaypointTrait
     */
    public function setSymbol(WaypointTraitSymbolType $symbol): WaypointTrait
    {
        $this->symbol = $symbol;
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
     * @param string $name
     * @return WaypointTrait
     */
    public function setName(string $name): WaypointTrait
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
     * @param string $description
     * @return WaypointTrait
     */
    public function setDescription(string $description): WaypointTrait
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
