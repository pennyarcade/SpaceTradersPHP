<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\SupplyType;
use JsonSerializable;

class MarketTradeGood implements JsonSerializable, Deserializable
{
    protected string $symbol;
    protected int    $tradeVolume;
    protected SupplyType $supply;
    protected int    $purchasePrice;
    protected int    $sellPrice;

    /**
     * @param string     $symbol
     * @param int        $tradeVolume
     * @param SupplyType $supply
     * @param int        $purchasePrice
     * @param int        $sellPrice
     */
    public function __construct(
        string $symbol,
        int $tradeVolume,
        SupplyType $supply,
        int $purchasePrice,
        int $sellPrice
    ) {
        $this->symbol = $symbol;
        $this->tradeVolume = $tradeVolume;
        $this->supply = $supply;
        $this->purchasePrice = $purchasePrice;
        $this->sellPrice = $sellPrice;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param  string $symbol
     * @return MarketTradeGood
     */
    public function setSymbol(string $symbol): MarketTradeGood
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return int
     */
    public function getTradeVolume(): int
    {
        return $this->tradeVolume;
    }

    /**
     * @param  int $tradeVolume
     * @return MarketTradeGood
     */
    public function setTradeVolume(int $tradeVolume): MarketTradeGood
    {
        $this->tradeVolume = $tradeVolume;
        return $this;
    }

    /**
     * @return SupplyType
     */
    public function getSupply(): SupplyType
    {
        return $this->supply;
    }

    /**
     * @param  SupplyType $supply
     * @return MarketTradeGood
     */
    public function setSupply(SupplyType $supply): MarketTradeGood
    {
        $this->supply = $supply;
        return $this;
    }

    /**
     * @return int
     */
    public function getPurchasePrice(): int
    {
        return $this->purchasePrice;
    }

    /**
     * @param  int $purchasePrice
     * @return MarketTradeGood
     */
    public function setPurchasePrice(int $purchasePrice): MarketTradeGood
    {
        $this->purchasePrice = $purchasePrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getSellPrice(): int
    {
        return $this->sellPrice;
    }

    /**
     * @param  int $sellPrice
     * @return MarketTradeGood
     */
    public function setSellPrice(int $sellPrice): MarketTradeGood
    {
        $this->sellPrice = $sellPrice;
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
