<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\WaypointType;
use JsonSerializable;

class SystemWaypoint implements JsonSerializable, Deserializable
{
    protected string $symbol;
    protected WaypointType $type;
    protected int $x;
    protected int $y;

    /**
     * @param string       $symbol
     * @param WaypointType $type
     * @param int          $x
     * @param int          $y
     */
    public function __construct(string $symbol, WaypointType $type, int $x, int $y)
    {
        $this->symbol = $symbol;
        $this->type = $type;
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
     * @param  string $symbol
     * @return SystemWaypoint
     */
    public function setSymbol(string $symbol): SystemWaypoint
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
     * @param  WaypointType $type
     * @return SystemWaypoint
     */
    public function setType(WaypointType $type): SystemWaypoint
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
     * @return SystemWaypoint
     */
    public function setX(int $x): SystemWaypoint
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
     * @return SystemWaypoint
     */
    public function setY(int $y): SystemWaypoint
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
