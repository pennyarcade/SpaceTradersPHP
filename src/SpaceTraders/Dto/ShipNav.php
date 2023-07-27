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


    public static function fromArray(array $data): self
    {
        return new self(
            systemSymbol: $data['systemSymbol'],
            waypointSymbol: $data['waypointSymbol'],
            route: ShipNavRoute::fromArray($data['route']),
            status: ShipNavStatus::fromName($data['status']),
            flightMode: ShipNavFlightMode::fromName($data['flightMode'])
        );
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
