<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class Waypoint extends SystemWaypoint implements JsonSerializable, Deserializable
{
    protected string $systemSymbol;
    /**
     * @var string[]
     */
    protected array $orbitals;
    protected string $faction;
    /**
     * @var WaypointTrait[]
     */
    protected array $traits;
    protected ?Chart $chart;

    /**
     * @param string          $systemSymbol
     * @param string[]        $orbitals
     * @param string          $faction
     * @param WaypointTrait[] $traits
     * @param Chart|null      $chart
     */
    public function __construct(
        string $systemSymbol,
        array $orbitals,
        string $faction,
        array $traits,
        ?Chart $chart = null
    ) {
        $this->systemSymbol = $systemSymbol;
        $this->orbitals = $orbitals;
        $this->faction = $faction;
        $this->traits = $traits;
        $this->chart = $chart;
    }

    /**
     * @return string
     */
    public function getSystemSymbol(): string
    {
        return $this->systemSymbol;
    }

    /**
     * @param  string $systemSymbol
     * @return Waypoint
     */
    public function setSystemSymbol(string $systemSymbol): Waypoint
    {
        $this->systemSymbol = $systemSymbol;
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
     * @param  array $orbitals
     * @return Waypoint
     */
    public function setOrbitals(array $orbitals): Waypoint
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
     * @param  string $faction
     * @return Waypoint
     */
    public function setFaction(string $faction): Waypoint
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
     * @param  array $traits
     * @return Waypoint
     */
    public function setTraits(array $traits): Waypoint
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
     * @param  Chart|null $chart
     * @return Waypoint
     */
    public function setChart(?Chart $chart): Waypoint
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
