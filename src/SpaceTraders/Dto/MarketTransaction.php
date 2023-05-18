<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\MarketTransactionType;
use DateTime;
use JsonSerializable;

class MarketTransaction implements JsonSerializable, Deserializable
{
    protected string $waypointSymbol;
    protected string $shipSymbol;
    protected string $tradeSymbol;
    protected MarketTransactionType $type;
    protected int    $units;
    protected int    $pricePerUnit;
    protected int    $totalPrice;
    protected DateTime $timestamp;

    /**
     * @param string                $waypointSymbol
     * @param string                $shipSymbol
     * @param string                $tradeSymbol
     * @param MarketTransactionType $type
     * @param int                   $units
     * @param int                   $pricePerUnit
     * @param int                   $totalPrice
     * @param DateTime              $timestamp
     */
    public function __construct(
        string $waypointSymbol,
        string $shipSymbol,
        string $tradeSymbol,
        MarketTransactionType $type,
        int $units,
        int $pricePerUnit,
        int $totalPrice,
        DateTime $timestamp
    ) {
        $this->waypointSymbol = $waypointSymbol;
        $this->shipSymbol = $shipSymbol;
        $this->tradeSymbol = $tradeSymbol;
        $this->type = $type;
        $this->units = $units;
        $this->pricePerUnit = $pricePerUnit;
        $this->totalPrice = $totalPrice;
        $this->timestamp = $timestamp;
    }

    /**
     * @return string
     */
    public function getWaypointSymbol(): string
    {
        return $this->waypointSymbol;
    }

    /**
     * @param  string $waypointSymbol
     * @return MarketTransaction
     */
    public function setWaypointSymbol(string $waypointSymbol): MarketTransaction
    {
        $this->waypointSymbol = $waypointSymbol;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipSymbol(): string
    {
        return $this->shipSymbol;
    }

    /**
     * @param  string $shipSymbol
     * @return MarketTransaction
     */
    public function setShipSymbol(string $shipSymbol): MarketTransaction
    {
        $this->shipSymbol = $shipSymbol;
        return $this;
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
     * @return MarketTransaction
     */
    public function setTradeSymbol(string $tradeSymbol): MarketTransaction
    {
        $this->tradeSymbol = $tradeSymbol;
        return $this;
    }

    /**
     * @return MarketTransactionType
     */
    public function getType(): MarketTransactionType
    {
        return $this->type;
    }

    /**
     * @param  MarketTransactionType $type
     * @return MarketTransaction
     */
    public function setType(MarketTransactionType $type): MarketTransaction
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnits(): int
    {
        return $this->units;
    }

    /**
     * @param  int $units
     * @return MarketTransaction
     */
    public function setUnits(int $units): MarketTransaction
    {
        $this->units = $units;
        return $this;
    }

    /**
     * @return int
     */
    public function getPricePerUnit(): int
    {
        return $this->pricePerUnit;
    }

    /**
     * @param  int $pricePerUnit
     * @return MarketTransaction
     */
    public function setPricePerUnit(int $pricePerUnit): MarketTransaction
    {
        $this->pricePerUnit = $pricePerUnit;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    /**
     * @param  int $totalPrice
     * @return MarketTransaction
     */
    public function setTotalPrice(int $totalPrice): MarketTransaction
    {
        $this->totalPrice = $totalPrice;
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
     * @param  DateTime $timestamp
     * @return MarketTransaction
     */
    public function setTimestamp(DateTime $timestamp): MarketTransaction
    {
        $this->timestamp = $timestamp;
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
