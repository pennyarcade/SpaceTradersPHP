<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\ShipReactorSymbolType;
use JsonSerializable;

class ShipReactor implements JsonSerializable, Deserializable
{
    protected ShipReactorSymbolType $symbol;
    protected string            $name;
    protected string            $description;
    protected int               $condition;
    protected int               $powerOutput;
    protected ShipRequirements  $requirements;

    /**
     * @param ShipReactorSymbolType $symbol
     * @param string $name
     * @param string $description
     * @param int $condition
     * @param int $powerOutput
     * @param ShipRequirements $requirements
     */
    public function __construct(
        ShipReactorSymbolType $symbol,
        string                $name,
        string                $description,
        int                   $condition,
        int                   $powerOutput,
        ShipRequirements      $requirements
    ) {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->description = $description;
        $this->condition = $condition;
        $this->powerOutput = $powerOutput;
        $this->requirements = $requirements;
    }

    /**
     * @return ShipReactorSymbolType
     */
    public function getSymbol(): ShipReactorSymbolType
    {
        return $this->symbol;
    }

    /**
     * @param ShipReactorSymbolType $symbol
     * @return ShipReactor
     */
    public function setSymbol(ShipReactorSymbolType $symbol): ShipReactor
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
     * @return ShipReactor
     */
    public function setName(string $name): ShipReactor
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
     * @return ShipReactor
     */
    public function setDescription(string $description): ShipReactor
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
     * @return ShipReactor
     */
    public function setCondition(int $condition): ShipReactor
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return int
     */
    public function getPowerOutput(): int
    {
        return $this->powerOutput;
    }

    /**
     * @param int $powerOutput
     * @return ShipReactor
     */
    public function setPowerOutput(int $powerOutput): ShipReactor
    {
        $this->powerOutput = $powerOutput;
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
     * @return ShipReactor
     */
    public function setRequirements(ShipRequirements $requirements): ShipReactor
    {
        $this->requirements = $requirements;
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
