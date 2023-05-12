<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ShipNavRouteWaypoint implements JsonSerializable, Deserializable
{
    protected string $symbol;
    protected WaypointType $type;
    protected string $systemSymbol;
    protected int    $x;
    protected int    $y;

    /**
     * @param string $symbol
     * @param WaypointType $type
     * @param string $systemSymbol
     * @param int $x
     * @param int $y
     */
    public function __construct(string $symbol, WaypointType $type, string $systemSymbol, int $x, int $y)
    {
        $this->symbol = $symbol;
        $this->type = $type;
        $this->systemSymbol = $systemSymbol;
        $this->x = $x;
        $this->y = $y;
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
     * @return ShipNavRouteWaypoint
     */
    public function setSymbol(string $symbol): ShipNavRouteWaypoint
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
     * @return ShipNavRouteWaypoint
     */
    public function setType(WaypointType $type): ShipNavRouteWaypoint
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
     * @return ShipNavRouteWaypoint
     */
    public function setSystemSymbol(string $systemSymbol): ShipNavRouteWaypoint
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
     * @return ShipNavRouteWaypoint
     */
    public function setX(int $x): ShipNavRouteWaypoint
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
     * @return ShipNavRouteWaypoint
     */
    public function setY(int $y): ShipNavRouteWaypoint
    {
        $this->y = $y;
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
