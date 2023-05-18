<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class Extraction implements JsonSerializable, Deserializable
{
    protected string $shipSymbol;
    protected ExtractionYield $yield;

    /**
     * @param string          $shipSymbol
     * @param ExtractionYield $yield
     */
    public function __construct(string $shipSymbol, ExtractionYield $yield)
    {
        $this->shipSymbol = $shipSymbol;
        $this->yield = $yield;
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
     * @return Extraction
     */
    public function setShipSymbol(string $shipSymbol): Extraction
    {
        $this->shipSymbol = $shipSymbol;
        return $this;
    }

    /**
     * @return ExtractionYield
     */
    public function getYield(): ExtractionYield
    {
        return $this->yield;
    }

    /**
     * @param  ExtractionYield $yield
     * @return Extraction
     */
    public function setYield(ExtractionYield $yield): Extraction
    {
        $this->yield = $yield;
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
