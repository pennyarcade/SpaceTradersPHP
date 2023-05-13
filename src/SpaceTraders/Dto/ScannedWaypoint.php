<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\FactionName;
use App\SpaceTraders\Enum\WaypointType;
use JsonSerializable;

class ScannedWaypoint extends SystemWaypoint implements JsonSerializable, Deserializable
{
    protected string $systemSymbol;
    /** @var string[] */
    protected array $orbitals;
    protected string $faction;
    /** @var WaypointTrait[] */
    protected array $traits;
    protected ?Chart $chart;

    /**
     * @param string $symbol
     * @param WaypointType $type
     * @param string $systemSymbol
     * @param int $x
     * @param int $y
     * @param string[] $orbitals
     * @param string $faction
     * @param WaypointTrait[] $traits
     * @param Chart|null $chart
     */
    public function __construct(
        string $symbol,
        WaypointType $type,
        string $systemSymbol,
        int $x,
        int $y,
        array $orbitals,
        array $traits,
        ?string $faction = null,
        ?Chart $chart = null
    ) {
        $this->symbol = $symbol;
        $this->type = $type;
        $this->systemSymbol = $systemSymbol;
        $this->x = $x;
        $this->y = $y;
        $this->orbitals = $orbitals;
        $this->faction = $faction;
        $this->traits = $traits;
        $this->chart = $chart;
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
     * @return ScannedWaypoint
     */
    public function setSymbol(string $symbol): ScannedWaypoint
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return WaypointType
     */
    public function getType(): WaypointType
    {
        return $this->type;
    }

    /**
     * @param WaypointType $type
     * @return ScannedWaypoint
     */
    public function setType(WaypointType $type): ScannedWaypoint
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getSystemSymbol(): string
    {
        return $this->systemSymbol;
    }

    /**
     * @param string $systemSymbol
     * @return ScannedWaypoint
     */
    public function setSystemSymbol(string $systemSymbol): ScannedWaypoint
    {
        $this->systemSymbol = $systemSymbol;
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
     * @return ScannedWaypoint
     */
    public function setX(int $x): ScannedWaypoint
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
     * @return ScannedWaypoint
     */
    public function setY(int $y): ScannedWaypoint
    {
        $this->y = $y;
        return $this;
    }

    /**
     * @return array
     */
    public function getOrbitals(): array
    {
        return $this->orbitals;
    }

    /**
     * @param array $orbitals
     * @return ScannedWaypoint
     */
    public function setOrbitals(array $orbitals): ScannedWaypoint
    {
        $this->orbitals = $orbitals;
        return $this;
    }

    /**
     * @return string
     */
    public function getFaction(): string
    {
        return $this->faction;
    }

    /**
     * @param string $faction
     * @return ScannedWaypoint
     */
    public function setFaction(string $faction): ScannedWaypoint
    {
        $this->faction = $faction;
        return $this;
    }

    /**
     * @return array
     */
    public function getTraits(): array
    {
        return $this->traits;
    }

    /**
     * @param array $traits
     * @return ScannedWaypoint
     */
    public function setTraits(array $traits): ScannedWaypoint
    {
        $this->traits = $traits;
        return $this;
    }

    /**
     * @return Chart|null
     */
    public function getChart(): ?Chart
    {
        return $this->chart;
    }

    /**
     * @param Chart|null $chart
     * @return ScannedWaypoint
     */
    public function setChart(?Chart $chart): ScannedWaypoint
    {
        $this->chart = $chart;
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
