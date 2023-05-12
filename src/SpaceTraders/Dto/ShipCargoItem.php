<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ShipCargoItem implements JsonSerializable, Deserializable
{
    protected string $symbol;
    protected string $name;
    protected string $description;
    protected int    $units;

    /**
     * @param string $symbol
     * @param string $name
     * @param string $description
     * @param int $units
     */
    public function __construct(string $symbol, string $name, string $description, int $units)
    {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->description = $description;
        $this->units = $units;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     * @return ShipCargoItem
     */
    public function setSymbol(string $symbol): ShipCargoItem
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
     * @return ShipCargoItem
     */
    public function setName(string $name): ShipCargoItem
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
     * @return ShipCargoItem
     */
    public function setDescription(string $description): ShipCargoItem
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnits(): int
    {
        return $this->units;
    }

    /**
     * @param int $units
     * @return ShipCargoItem
     */
    public function setUnits(int $units): ShipCargoItem
    {
        $this->units = $units;
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
