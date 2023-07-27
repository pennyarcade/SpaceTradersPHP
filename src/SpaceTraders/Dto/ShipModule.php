<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\ShipModuleSymbolType;
use JsonSerializable;

class ShipModule implements JsonSerializable, Deserializable
{
    protected ShipModuleSymbolType $symbol;
    protected int $capacity;
    protected int $range;
    protected string $name;
    protected string $description;
    protected ShipRequirements $requirements;

    /**
     * @param ShipModuleSymbolType $symbol
     * @param int                  $capacity
     * @param int                  $range
     * @param string               $name
     * @param string               $description
     * @param ShipRequirements     $requirements
     */
    public function __construct(
        ShipModuleSymbolType $symbol,
        int $capacity,
        int $range,
        string $name,
        string $description,
        ShipRequirements $requirements
    ) {
        $this->symbol = $symbol;
        $this->capacity = $capacity;
        $this->range = $range;
        $this->name = $name;
        $this->description = $description;
        $this->requirements = $requirements;
    }

    /**
     * @return ShipModuleSymbolType
     */
    public function getSymbol(): ShipModuleSymbolType
    {
        return $this->symbol;
    }

    /**
     * @param  ShipModuleSymbolType $symbol
     * @return ShipModule
     */
    public function setSymbol(ShipModuleSymbolType $symbol): ShipModule
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * @param  int $capacity
     * @return ShipModule
     */
    public function setCapacity(int $capacity): ShipModule
    {
        $this->capacity = $capacity;
        return $this;
    }

    /**
     * @return int
     */
    public function getRange(): int
    {
        return $this->range;
    }

    /**
     * @param  int $range
     * @return ShipModule
     */
    public function setRange(int $range): ShipModule
    {
        $this->range = $range;
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
     * @return ShipModule
     */
    public function setName(string $name): ShipModule
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
     * @return ShipModule
     */
    public function setDescription(string $description): ShipModule
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ShipRequirements
     */
    public function getRequirements(): ShipRequirements
    {
        return $this->requirements;
    }

    /**
     * @param  ShipRequirements $requirements
     * @return ShipModule
     */
    public function setRequirements(ShipRequirements $requirements): ShipModule
    {
        $this->requirements = $requirements;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            symbol: ShipModuleSymbolType::fromName($data('symbol')),
            capacity: $data('capacity'),
            range: $data('range'),
            name: $data('name'),
            description: $data('description'),
            requirements: ShipRequirements::fromArray($data('requirents'))
        );
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
