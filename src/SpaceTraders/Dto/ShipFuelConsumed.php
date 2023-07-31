<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use DateTime;
use JsonSerializable;

class ShipFuelConsumed implements JsonSerializable, Deserializable
{
    protected int $amount;
    protected DateTime $timestamp;

    /**
     * @param int $amount
     * @param DateTime $timestamp
     */
    public function __construct(int $amount, DateTime $timestamp)
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
     * @return DateTime
     */
    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param DateTime $timestamp
     * @return ShipFuelConsumed
     */
    public function setTimestamp(DateTime $timestamp): ShipFuelConsumed
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            amount: $data['amount'],
            timestamp: new DateTime($data['timestamp'])
        );
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
