<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ExtractionYield implements JsonSerializable, Deserializable
{
    protected string $symbol;
    protected int    $units;

    /**
     * @param string $symbol
     * @param int $units
     */
    public function __construct(string $symbol, int $units)
    {
        $this->symbol = $symbol;
        $this->units = $units;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     * @return ExtractionYield
     */
    public function setSymbol(string $symbol): ExtractionYield
    {
        $this->symbol = $symbol;
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
     * @param int $units
     * @return ExtractionYield
     */
    public function setUnits(int $units): ExtractionYield
    {
        $this->units = $units;
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
