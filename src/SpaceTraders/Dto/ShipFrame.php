<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\ShipFrameType;

class ShipFrame implements \JsonSerializable, Deserializable
{
    protected ShipFrameType $symbol;
    protected string $name;
    protected string $description;
    protected int $condition;
    protected int $moduleSlots;
    protected int $mountingPoints;
    protected int $fuelCapacity;
    protected ShipRequirements $requirements;

    public function __construct(
        ShipFrameType    $symbol,
        string           $name,
        string           $description,
        int              $condition,
        int              $moduleSlots,
        int              $mountingPoints,
        int              $fuelCapacity,
        ShipRequirements $requirements,
    ) {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->description = $description;
        $this->condition = $condition;
        $this->moduleSlots = $moduleSlots;
        $this->mountingPoints = $mountingPoints;
        $this->fuelCapacity = $fuelCapacity;
        $this->requirements = $requirements;
    }

    /**
     * @return ShipFrameType
     */
    public function getSymbol(): ShipFrameType
    {
        return $this->symbol;
    }

    /**
     * @param ShipFrameType $symbol
     * @return ShipFrame
     */
    public function setSymbol(ShipFrameType $symbol): ShipFrame
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
     * @return ShipFrame
     */
    public function setName(string $name): ShipFrame
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
     * @return ShipFrame
     */
    public function setDescription(string $description): ShipFrame
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getCondition(): int
    {
        return $this->condition;
    }

    /**
     * @param int $condition
     * @return ShipFrame
     */
    public function setCondition(int $condition): ShipFrame
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return int
     */
    public function getModuleSlots(): int
    {
        return $this->moduleSlots;
    }

    /**
     * @param int $moduleSlots
     * @return ShipFrame
     */
    public function setModuleSlots(int $moduleSlots): ShipFrame
    {
        $this->moduleSlots = $moduleSlots;
        return $this;
    }

    /**
     * @return int
     */
    public function getMountingPoints(): int
    {
        return $this->mountingPoints;
    }

    /**
     * @param int $mountingPoints
     * @return ShipFrame
     */
    public function setMountingPoints(int $mountingPoints): ShipFrame
    {
        $this->mountingPoints = $mountingPoints;
        return $this;
    }

    /**
     * @return int
     */
    public function getFuelCapacity(): int
    {
        return $this->fuelCapacity;
    }

    /**
     * @param int $fuelCapacity
     * @return ShipFrame
     */
    public function setFuelCapacity(int $fuelCapacity): ShipFrame
    {
        $this->fuelCapacity = $fuelCapacity;
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
     * @param ShipRequirements $requirements
     * @return ShipFrame
     */
    public function setRequirements(ShipRequirements $requirements): ShipFrame
    {
        $this->requirements = $requirements;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            ShipFrameType::fromName($data['symbol']),
            $data['name'],
            $data['description'],
            $data['condition'],
            $data['moduleSlots'],
            $data['mountingPoints'],
            $data['fuelCapacity'],
            ShipRequirements::fromArray($data['requirements'])
        );
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
