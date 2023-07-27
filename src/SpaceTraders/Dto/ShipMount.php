<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\DepositType;
use App\SpaceTraders\Enum\ShipMountSymbolType;
use JsonSerializable;

class ShipMount implements JsonSerializable, Deserializable
{
    protected ShipMountSymbolType $symbol;
    protected string $name;
    protected string $description;
    protected int    $strength;
    /**
     * @var DepositType[] $deposits
     */
    protected array  $deposits;
    protected ShipRequirements $requirements;

    /**
     * @param ShipMountSymbolType $symbol
     * @param string              $name
     * @param string              $description
     * @param int                 $strength
     * @param DepositType[]       $deposits
     * @param ShipRequirements    $requirements
     */
    public function __construct(
        ShipMountSymbolType $symbol,
        string $name,
        string $description,
        int $strength,
        array $deposits,
        ShipRequirements $requirements
    ) {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->description = $description;
        $this->strength = $strength;
        $this->deposits = $deposits;
        $this->requirements = $requirements;
    }

    /**
     * @return ShipMountSymbolType
     */
    public function getSymbol(): ShipMountSymbolType
    {
        return $this->symbol;
    }

    /**
     * @param  ShipMountSymbolType $symbol
     * @return ShipMount
     */
    public function setSymbol(ShipMountSymbolType $symbol): ShipMount
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
     * @return ShipMount
     */
    public function setName(string $name): ShipMount
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
     * @return ShipMount
     */
    public function setDescription(string $description): ShipMount
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param  int $strength
     * @return ShipMount
     */
    public function setStrength(int $strength): ShipMount
    {
        $this->strength = $strength;
        return $this;
    }

    /**
     * @return array
     */
    public function getDeposits(): array
    {
        return $this->deposits;
    }

    /**
     * @param  array $deposits
     * @return ShipMount
     */
    public function setDeposits(array $deposits): ShipMount
    {
        $this->deposits = $deposits;
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
     * @return ShipMount
     */
    public function setRequirements(ShipRequirements $requirements): ShipMount
    {
        $this->requirements = $requirements;
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
