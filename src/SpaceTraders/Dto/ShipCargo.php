<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ShipCargo implements JsonSerializable, Deserializable
{
    protected int $capacity;
    protected int $units;
    /**
     * @var ShipCargoItem[]
     */
    protected array $inventory;

    /**
     * @param int             $capacity
     * @param int             $units
     * @param ShipCargoItem[] $inventory
     */
    public function __construct(int $capacity, int $units, array $inventory)
    {
        $this->capacity = $capacity;
        $this->units = $units;
        $this->inventory = $inventory;
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
     * @return ShipCargo
     */
    public function setCapacity(int $capacity): ShipCargo
    {
        $this->capacity = $capacity;
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
     * @param  int $units
     * @return ShipCargo
     */
    public function setUnits(int $units): ShipCargo
    {
        $this->units = $units;
        return $this;
    }

    /**
     * @return array
     */
    public function getInventory(): array
    {
        return $this->inventory;
    }

    /**
     * @param  array $inventory
     * @return ShipCargo
     */
    public function setInventory(array $inventory): ShipCargo
    {
        $this->inventory = $inventory;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        // TODO: Implement fromArray() method.
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
