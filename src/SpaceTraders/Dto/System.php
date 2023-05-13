<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\SystemType;
use JsonSerializable;

class System implements JsonSerializable, Deserializable
{
    protected string $symbol;
    protected string $sectorSymbol;
    protected SystemType $type;
    protected int $x;
    protected int $y;
    /** @var SystemWaypoint[] $waypoints */
    protected array $waypoints;
    /** @var string[] $factions */
    protected array $factions;

    /**
     * @param string $symbol
     * @param string $sectorSymbol
     * @param SystemType $type
     * @param int $x
     * @param int $y
     * @param SystemWaypoint[] $waypoints
     * @param string[] $factions
     */
    public function __construct(
        string $symbol,
        string $sectorSymbol,
        SystemType $type,
        int $x,
        int $y,
        array $waypoints,
        array $factions
    ) {
        $this->symbol = $symbol;
        $this->sectorSymbol = $sectorSymbol;
        $this->type = $type;
        $this->x = $x;
        $this->y = $y;
        $this->waypoints = $waypoints;
        $this->factions = $factions;
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
     * @return System
     */
    public function setSymbol(string $symbol): System
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
     * @return System
     */
    public function setSectorSymbol(string $sectorSymbol): System
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
     * @return System
     */
    public function setType(SystemType $type): System
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
     * @param int $x
     * @return System
     */
    public function setX(int $x): System
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
     * @return System
     */
    public function setY(int $y): System
    {
        $this->y = $y;
        return $this;
    }

    /**
     * @return array
     */
    public function getWaypoints(): array
    {
        return $this->waypoints;
    }

    /**
     * @param array $waypoints
     * @return System
     */
    public function setWaypoints(array $waypoints): System
    {
        $this->waypoints = $waypoints;
        return $this;
    }

    /**
     * @return array
     */
    public function getFactions(): array
    {
        return $this->factions;
    }

    /**
     * @param array $factions
     * @return System
     */
    public function setFactions(array $factions): System
    {
        $this->factions = $factions;
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
