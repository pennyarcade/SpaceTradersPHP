<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\ShipCrewRotation;
use JsonSerializable;

class ShipCrew implements JsonSerializable, Deserializable
{
    protected int $current;
    protected int $required;
    protected int $capacity;
    protected ShipCrewRotation $rotation;
    protected int $morale;
    protected int $wages;

    /**
     * @param int              $current
     * @param int              $required
     * @param int              $capacity
     * @param ShipCrewRotation $rotation
     * @param int              $morale
     * @param int              $wages
     */
    public function __construct(
        int $current,
        int $required,
        int $capacity,
        ShipCrewRotation $rotation,
        int $morale,
        int $wages
    ) {
        $this->current = $current;
        $this->required = $required;
        $this->capacity = $capacity;
        $this->rotation = $rotation;
        $this->morale = $morale;
        $this->wages = $wages;
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
     * @return ShipCrew
     */
    public function setCurrent(int $current): ShipCrew
    {
        $this->current = $current;
        return $this;
    }

    /**
     * @return int
     */
    public function getRequired(): int
    {
        return $this->required;
    }

    /**
     * @param  int $required
     * @return ShipCrew
     */
    public function setRequired(int $required): ShipCrew
    {
        $this->required = $required;
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
     * @return ShipCrew
     */
    public function setCapacity(int $capacity): ShipCrew
    {
        $this->capacity = $capacity;
        return $this;
    }

    /**
     * @return ShipCrewRotation
     */
    public function getRotation(): ShipCrewRotation
    {
        return $this->rotation;
    }

    /**
     * @param  ShipCrewRotation $rotation
     * @return ShipCrew
     */
    public function setRotation(ShipCrewRotation $rotation): ShipCrew
    {
        $this->rotation = $rotation;
        return $this;
    }

    /**
     * @return int
     */
    public function getMorale(): int
    {
        return $this->morale;
    }

    /**
     * @param  int $morale
     * @return ShipCrew
     */
    public function setMorale(int $morale): ShipCrew
    {
        $this->morale = $morale;
        return $this;
    }

    /**
     * @return int
     */
    public function getWages(): int
    {
        return $this->wages;
    }

    /**
     * @param  int $wages
     * @return ShipCrew
     */
    public function setWages(int $wages): ShipCrew
    {
        $this->wages = $wages;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            current: $data['current'],
            required: $data['required'],
            capacity: $data['capacity'],
            rotation: ShipCrewRotation::fromName($data['rotation']),
            morale: $data['morale'],
            wages: $data['wages']
        );
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
