<?php
namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class WorldStats implements JsonSerializable, Deserializable
{
    protected int $agents;
    protected int $ships;
    protected int $systems;
    protected int $waypoints;

    /**
     * @param int $agents
     * @param int $ships
     * @param int $systems
     * @param int $waypoints
     */
    public function __construct(int $agents, int $ships, int $systems, int $waypoints)
    {
        $this->agents = $agents;
        $this->ships = $ships;
        $this->systems = $systems;
        $this->waypoints = $waypoints;
    }

    /**
     * @return int
     */
    public function getAgents(): int
    {
        return $this->agents;
    }

    /**
     * @param int $agents
     * @return WorldStats
     */
    public function setAgents(int $agents): WorldStats
    {
        $this->agents = $agents;
        return $this;
    }

    /**
     * @return int
     */
    public function getShips(): int
    {
        return $this->ships;
    }

    /**
     * @param int $ships
     * @return WorldStats
     */
    public function setShips(int $ships): WorldStats
    {
        $this->ships = $ships;
        return $this;
    }

    /**
     * @return int
     */
    public function getSystems(): int
    {
        return $this->systems;
    }

    /**
     * @param int $systems
     * @return WorldStats
     */
    public function setSystems(int $systems): WorldStats
    {
        $this->systems = $systems;
        return $this;
    }

    /**
     * @return int
     */
    public function getWaypoints(): int
    {
        return $this->waypoints;
    }

    /**
     * @param int $waypoints
     * @return WorldStats
     */
    public function setWaypoints(int $waypoints): WorldStats
    {
        $this->waypoints = $waypoints;
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
