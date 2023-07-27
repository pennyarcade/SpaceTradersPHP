<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use DateTime;
use Exception;
use JsonSerializable;

class ShipNavRoute implements JsonSerializable, Deserializable
{
    protected ShipNavRouteWaypoint $destination;
    protected ShipNavRouteWaypoint $departure;
    protected DateTime             $departureTime;
    protected DateTime             $arrival;

    /**
     * @param ShipNavRouteWaypoint $destination
     * @param ShipNavRouteWaypoint $departure
     * @param DateTime             $departureTime
     * @param DateTime             $arrival
     */
    public function __construct(
        ShipNavRouteWaypoint $destination,
        ShipNavRouteWaypoint $departure,
        DateTime $departureTime,
        DateTime $arrival
    ) {
        $this->destination = $destination;
        $this->departure = $departure;
        $this->departureTime = $departureTime;
        $this->arrival = $arrival;
    }

    /**
     * @return ShipNavRouteWaypoint
     */
    public function getDestination(): ShipNavRouteWaypoint
    {
        return $this->destination;
    }

    /**
     * @param  ShipNavRouteWaypoint $destination
     * @return ShipNavRoute
     */
    public function setDestination(ShipNavRouteWaypoint $destination): ShipNavRoute
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @return ShipNavRouteWaypoint
     */
    public function getDeparture(): ShipNavRouteWaypoint
    {
        return $this->departure;
    }

    /**
     * @param  ShipNavRouteWaypoint $departure
     * @return ShipNavRoute
     */
    public function setDeparture(ShipNavRouteWaypoint $departure): ShipNavRoute
    {
        $this->departure = $departure;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDepartureTime(): DateTime
    {
        return $this->departureTime;
    }

    /**
     * @param  DateTime $departureTime
     * @return ShipNavRoute
     */
    public function setDepartureTime(DateTime $departureTime): ShipNavRoute
    {
        $this->departureTime = $departureTime;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getArrival(): DateTime
    {
        return $this->arrival;
    }

    /**
     * @param  DateTime $arrival
     * @return ShipNavRoute
     */
    public function setArrival(DateTime $arrival): ShipNavRoute
    {
        $this->arrival = $arrival;
        return $this;
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $data): self
    {
        return new self(
            destination: ShipNavRouteWaypoint::fromArray($data['destination']),
            departure: ShipNavRouteWaypoint::fromArray($data['departure']),
            departureTime: new DateTime($data['departureTime']),
            arrival: new DateTime($data['departureTime'])
        );
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
