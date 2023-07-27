<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ShipFuelConsumed implements JsonSerializable, Deserializable
{
    protected int $amount;
    protected int $timestamp;

    /**
     * @param int $amount
     * @param int $timestamp
     */
    public function __construct(int $amount, int $timestamp)
    {
        $this->amount = $amount;
        $this->timestamp = $timestamp;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param  int $amount
     * @return ShipFuelConsumed
     */
    public function setAmount(int $amount): ShipFuelConsumed
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @param  int $timestamp
     * @return ShipFuelConsumed
     */
    public function setTimestamp(int $timestamp): ShipFuelConsumed
    {
        $this->timestamp = $timestamp;
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
