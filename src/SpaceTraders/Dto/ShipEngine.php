<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\ShipEngineSymbolType;
use JsonSerializable;

class ShipEngine implements JsonSerializable, Deserializable
{
    protected ShipEngineSymbolType $symbol;
    protected string $name;
    protected string $description;
    protected int $condition;
    protected float $speed;
    protected ShipRequirements $requirements;

    /**
     * @param ShipEngineSymbolType $symbol
     * @param string               $name
     * @param string               $description
     * @param int                  $condition
     * @param float                $speed
     * @param ShipRequirements     $requirements
     */
    public function __construct(
        ShipEngineSymbolType $symbol,
        string $name,
        string $description,
        int $condition,
        float $speed,
        ShipRequirements $requirements
    ) {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->description = $description;
        $this->condition = $condition;
        $this->speed = $speed;
        $this->requirements = $requirements;
    }

    /**
     * @return ShipEngineSymbolType
     */
    public function getSymbol(): ShipEngineSymbolType
    {
        return $this->symbol;
    }

    /**
     * @param  ShipEngineSymbolType $symbol
     * @return ShipEngine
     */
    public function setSymbol(ShipEngineSymbolType $symbol): ShipEngine
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
     * @param  string $name
     * @return ShipEngine
     */
    public function setName(string $name): ShipEngine
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
     * @return ShipEngine
     */
    public function setDescription(string $description): ShipEngine
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
     * @param  int $condition
     * @return ShipEngine
     */
    public function setCondition(int $condition): ShipEngine
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * @param  float $speed
     * @return ShipEngine
     */
    public function setSpeed(float $speed): ShipEngine
    {
        $this->speed = $speed;
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
     * @return ShipEngine
     */
    public function setRequirements(ShipRequirements $requirements): ShipEngine
    {
        $this->requirements = $requirements;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            symbol: ShipEngineSymbolType::fromName($data['symbol']),
            name: $data['name'],
            description: $data['description'],
            condition: $data['condition'],
            speed: $data['speed'],
            requirements: ShipRequirements::fromArray($data['requirements'])
        );
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
