<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\ShipNavFlightMode;
use App\SpaceTraders\Enum\ShipNavStatus;
use JsonSerializable;

class ShipNav implements JsonSerializable, Deserializable
{
    protected string $systemSymbol;
    protected string $waypointSymbol;
    protected ShipNavRoute $route;
    protected ShipNavStatus $status;
    protected ShipNavFlightMode $flightMode;

    /**
     * @param string            $systemSymbol
     * @param string            $waypointSymbol
     * @param ShipNavRoute      $route
     * @param ShipNavStatus     $status
     * @param ShipNavFlightMode $flightMode
     */
    public function __construct(
        string $systemSymbol,
        string $waypointSymbol,
        ShipNavRoute $route,
        ShipNavStatus $status,
        ShipNavFlightMode $flightMode
    ) {
        $this->systemSymbol = $systemSymbol;
        $this->waypointSymbol = $waypointSymbol;
        $this->route = $route;
        $this->status = $status;
        $this->flightMode = $flightMode;
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
