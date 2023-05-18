<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ContractDeliverGood implements JsonSerializable, Deserializable
{
    protected string $tradeSymbol;
    protected string $destinationSymbol;
    protected int    $unitsRequired;
    protected int    $unitsFulfilled;

    /**
     * @param string $tradeSymbol
     * @param string $destinationSymbol
     * @param int    $unitsRequired
     * @param int    $unitsFulfilled
     */
    public function __construct(string $tradeSymbol, string $destinationSymbol, int $unitsRequired, int $unitsFulfilled)
    {
        $this->tradeSymbol = $tradeSymbol;
        $this->destinationSymbol = $destinationSymbol;
        $this->unitsRequired = $unitsRequired;
        $this->unitsFulfilled = $unitsFulfilled;
    }

    /**
     * @return string
     */
    public function getTradeSymbol(): string
    {
        return $this->tradeSymbol;
    }

    /**
     * @param  string $tradeSymbol
     * @return ContractDeliverGood
     */
    public function setTradeSymbol(string $tradeSymbol): ContractDeliverGood
    {
        $this->tradeSymbol = $tradeSymbol;
        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationSymbol(): string
    {
        return $this->destinationSymbol;
    }

    /**
     * @param  string $destinationSymbol
     * @return ContractDeliverGood
     */
    public function setDestinationSymbol(string $destinationSymbol): ContractDeliverGood
    {
        $this->destinationSymbol = $destinationSymbol;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnitsRequired(): int
    {
        return $this->unitsRequired;
    }

    /**
     * @param  int $unitsRequired
     * @return ContractDeliverGood
     */
    public function setUnitsRequired(int $unitsRequired): ContractDeliverGood
    {
        $this->unitsRequired = $unitsRequired;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnitsFulfilled(): int
    {
        return $this->unitsFulfilled;
    }

    /**
     * @param  int $unitsFulfilled
     * @return ContractDeliverGood
     */
    public function setUnitsFulfilled(int $unitsFulfilled): ContractDeliverGood
    {
        $this->unitsFulfilled = $unitsFulfilled;
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
