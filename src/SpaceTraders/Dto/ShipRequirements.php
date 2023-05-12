<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ShipRequirements implements JsonSerializable, Deserializable
{
    protected int $power;
    protected int $crew;
    protected int $slots;

    /**
     * @param int $power
     * @param int $crew
     * @param int $slots
     */
    public function __construct(int $power, int $crew, int $slots)
    {
        $this->power = $power;
        $this->crew = $crew;
        $this->slots = $slots;
    }

    /**
     * @return int
     */
    public function getPower(): int
    {
        return $this->power;
    }

    /**
     * @param int $power
     * @return ShipRequirements
     */
    public function setPower(int $power): ShipRequirements
    {
        $this->power = $power;
        return $this;
    }

    /**
     * @return int
     */
    public function getCrew(): int
    {
        return $this->crew;
    }

    /**
     * @param int $crew
     * @return ShipRequirements
     */
    public function setCrew(int $crew): ShipRequirements
    {
        $this->crew = $crew;
        return $this;
    }

    /**
     * @return int
     */
    public function getSlots(): int
    {
        return $this->slots;
    }

    /**
     * @param int $slots
     * @return ShipRequirements
     */
    public function setSlots(int $slots): ShipRequirements
    {
        $this->slots = $slots;
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
