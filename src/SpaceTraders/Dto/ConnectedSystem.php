<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ConnectedSystem implements JsonSerializable, Deserializable
{
    protected string $symbol;
    protected string $sectorSymbol;
    protected SystemType $type;
    protected string $factionSymbol;
    protected int    $x;
    protected int    $y;
    protected int    $distance;

    /**
     * @param string $symbol
     * @param string $sectorSymbol
     * @param SystemType $type
     * @param string $factionSymbol
     * @param int $x
     * @param int $y
     * @param int $distance
     */
    public function __construct(
        string $symbol,
        string $sectorSymbol,
        SystemType $type,
        string $factionSymbol,
        int $x,
        int $y,
        int $distance
    ) {
        $this->symbol = $symbol;
        $this->sectorSymbol = $sectorSymbol;
        $this->type = $type;
        $this->factionSymbol = $factionSymbol;
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
     * @param string $symbol
     * @return ConnectedSystem
     */
    public function setSymbol(string $symbol): ConnectedSystem
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
     * @param string $sectorSymbol
     * @return ConnectedSystem
     */
    public function setSectorSymbol(string $sectorSymbol): ConnectedSystem
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
     * @param SystemType $type
     * @return ConnectedSystem
     */
    public function setType(SystemType $type): ConnectedSystem
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getFactionSymbol(): string
    {
        return $this->factionSymbol;
    }

    /**
     * @param string $factionSymbol
     * @return ConnectedSystem
     */
    public function setFactionSymbol(string $factionSymbol): ConnectedSystem
    {
        $this->factionSymbol = $factionSymbol;
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
     * @param int $x
     * @return ConnectedSystem
     */
    public function setX(int $x): ConnectedSystem
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
     * @param int $y
     * @return ConnectedSystem
     */
    public function setY(int $y): ConnectedSystem
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
     * @param int $distance
     * @return ConnectedSystem
     */
    public function setDistance(int $distance): ConnectedSystem
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
