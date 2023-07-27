<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class Market implements JsonSerializable, Deserializable
{
    protected string $symbol;
    /**
     * @var MarketTradeGood[] $exports
     */
    protected array $exports;
    /**
     * @var MarketTradeGood[] $imports
     */
    protected array $imports;
    /**
     * @var MarketTradeGood[] $exchange
     */
    protected array $exchange;
    /**
     * @var MarketTransaction[] $transactions
     */
    protected array $transactions;
    /**
     * @var MarketTradeGood[] $tradeGoods
     */
    protected array $tradeGoods;

    /**
     * @param string              $symbol
     * @param MarketTradeGood[]   $exports
     * @param MarketTradeGood[]   $imports
     * @param MarketTradeGood[]   $exchange
     * @param MarketTransaction[] $transactions
     * @param MarketTradeGood[]   $tradeGoods
     */
    public function __construct(
        string $symbol,
        array $exports,
        array $imports,
        array $exchange,
        array $transactions,
        array $tradeGoods
    ) {
        $this->symbol = $symbol;
        $this->exports = $exports;
        $this->imports = $imports;
        $this->exchange = $exchange;
        $this->transactions = $transactions;
        $this->tradeGoods = $tradeGoods;
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
     * @return Market
     */
    public function setSymbol(string $symbol): Market
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return array
     */
    public function getExports(): array
    {
        return $this->exports;
    }

    /**
     * @param  array $exports
     * @return Market
     */
    public function setExports(array $exports): Market
    {
        $this->exports = $exports;
        return $this;
    }

    /**
     * @return array
     */
    public function getImports(): array
    {
        return $this->imports;
    }

    /**
     * @param  array $imports
     * @return Market
     */
    public function setImports(array $imports): Market
    {
        $this->imports = $imports;
        return $this;
    }

    /**
     * @return array
     */
    public function getExchange(): array
    {
        return $this->exchange;
    }

    /**
     * @param  array $exchange
     * @return Market
     */
    public function setExchange(array $exchange): Market
    {
        $this->exchange = $exchange;
        return $this;
    }

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    /**
     * @param  array $transactions
     * @return Market
     */
    public function setTransactions(array $transactions): Market
    {
        $this->transactions = $transactions;
        return $this;
    }

    /**
     * @return array
     */
    public function getTradeGoods(): array
    {
        return $this->tradeGoods;
    }

    /**
     * @param  array $tradeGoods
     * @return Market
     */
    public function setTradeGoods(array $tradeGoods): Market
    {
        $this->tradeGoods = $tradeGoods;
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
