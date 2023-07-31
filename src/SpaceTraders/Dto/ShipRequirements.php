<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ShipRequirements implements JsonSerializable, Deserializable
{
    protected ?int $power;
    protected ?int $crew;
    protected ?int $slots;

    /**
     * @param int|null $power
     * @param int|null $crew
     * @param int|null $slots
     */
    public function __construct(?int $power, ?int $crew, ?int $slots)
    {
        $this->power = $power;
        $this->crew = $crew;
        $this->slots = $slots;
    }

    /**
     * @return int|null
     */
    public function getPower(): ?int
    {
        return $this->power;
    }

    /**
     * @param int|null $power
     * @return ShipRequirements
     */
    public function setPower(?int $power): ShipRequirements
    {
        $this->power = $power;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCrew(): ?int
    {
        return $this->crew;
    }

    /**
     * @param int|null $crew
     * @return ShipRequirements
     */
    public function setCrew(?int $crew): ShipRequirements
    {
        $this->crew = $crew;
        return $this;
    }

    /**
     * @return int
     */
    public function getSlots(): ?int
    {
        return $this->slots;
    }

    /**
     * @param  int $slots
     * @return ShipRequirements
     */
    public function setSlots(?int $slots): ShipRequirements
    {
        $this->slots = $slots;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            power: array_key_exists('power', $data) ? $data['power'] : null,
            crew: array_key_exists('crew', $data) ? $data['crew'] : null,
            slots: array_key_exists('slots', $data) ? $data['slots'] : null
        );
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
