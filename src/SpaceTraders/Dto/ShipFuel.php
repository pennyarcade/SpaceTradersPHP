<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ShipFuel implements JsonSerializable, Deserializable
{
    protected int $current;
    protected int $capacity;
    protected ShipFuelConsumed $consumed;

    /**
     * @param int                   $current
     * @param int                   $capacity
     * @param ShipFuelConsumed|null $consumed
     */
    public function __construct(
        int $current,
        int $capacity,
        ?ShipFuelConsumed $consumed = null
    ) {
        $this->current = $current;
        $this->capacity = $capacity;
        $this->consumed = $consumed;
    }

    /**
     * @return int
     */
    public function getCurrent(): int
    {
        return $this->current;
    }

    /**
     * @param  int $current
     * @return ShipFuel
     */
    public function setCurrent(int $current): ShipFuel
    {
        $this->current = $current;
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
     * @return ShipFuel
     */
    public function setCapacity(int $capacity): ShipFuel
    {
        $this->capacity = $capacity;
        return $this;
    }

    /**
     * @return ShipFuelConsumed
     */
    public function getConsumed(): ShipFuelConsumed
    {
        return $this->consumed;
    }

    /**
     * @param  ShipFuelConsumed $consumed
     * @return ShipFuel
     */
    public function setConsumed(ShipFuelConsumed $consumed): ShipFuel
    {
        $this->consumed = $consumed;
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
