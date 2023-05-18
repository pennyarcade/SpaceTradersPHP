<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\SystemType;
use JsonSerializable;

class ScannedSystem implements JsonSerializable, Deserializable
{
    protected string $symbol;
    protected string $sectorSymbol;
    protected SystemType $type;
    protected int $x;
    protected int $y;
    protected int $distance;

    /**
     * @param string     $symbol
     * @param string     $sectorSymbol
     * @param SystemType $type
     * @param int        $x
     * @param int        $y
     * @param int        $distance
     */
    public function __construct(string $symbol, string $sectorSymbol, SystemType $type, int $x, int $y, int $distance)
    {
        $this->symbol = $symbol;
        $this->sectorSymbol = $sectorSymbol;
        $this->type = $type;
        $this->x = $x;
        $this->y = $y;
        $this->distance = $distance;
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
     * @return ScannedSystem
     */
    public function setSymbol(string $symbol): ScannedSystem
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return string
     */
    public function getSectorSymbol(): string
    {
        return $this->sectorSymbol;
    }

    /**
     * @param  string $sectorSymbol
     * @return ScannedSystem
     */
    public function setSectorSymbol(string $sectorSymbol): ScannedSystem
    {
        $this->sectorSymbol = $sectorSymbol;
        return $this;
    }

    /**
     * @return SystemType
     */
    public function getType(): SystemType
    {
        return $this->type;
    }

    /**
     * @param  SystemType $type
     * @return ScannedSystem
     */
    public function setType(SystemType $type): ScannedSystem
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param  int $x
     * @return ScannedSystem
     */
    public function setX(int $x): ScannedSystem
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param  int $y
     * @return ScannedSystem
     */
    public function setY(int $y): ScannedSystem
    {
        $this->y = $y;
        return $this;
    }

    /**
     * @return int
     */
    public function getDistance(): int
    {
        return $this->distance;
    }

    /**
     * @param  int $distance
     * @return ScannedSystem
     */
    public function setDistance(int $distance): ScannedSystem
    {
        $this->distance = $distance;
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
