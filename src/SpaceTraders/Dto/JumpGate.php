<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class JumpGate implements JsonSerializable, Deserializable
{
    protected float $jumpRange;
    protected string $factionSymbol;
    /**
     * @var ConnectedSystem[] $connectedSystems
     */
    protected array $connectedSystems;

    /**
     * @param float             $jumpRange
     * @param string            $factionSymbol
     * @param ConnectedSystem[] $connectedSystems
     */
    public function __construct(float $jumpRange, string $factionSymbol, array $connectedSystems)
    {
        $this->jumpRange = $jumpRange;
        $this->factionSymbol = $factionSymbol;
        $this->connectedSystems = $connectedSystems;
    }

    /**
     * @return float
     */
    public function getJumpRange(): float
    {
        return $this->jumpRange;
    }

    /**
     * @param  float $jumpRange
     * @return JumpGate
     */
    public function setJumpRange(float $jumpRange): JumpGate
    {
        $this->jumpRange = $jumpRange;
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
     * @param  string $factionSymbol
     * @return JumpGate
     */
    public function setFactionSymbol(string $factionSymbol): JumpGate
    {
        $this->factionSymbol = $factionSymbol;
        return $this;
    }

    /**
     * @return array
     */
    public function getConnectedSystems(): array
    {
        return $this->connectedSystems;
    }

    /**
     * @param  array $connectedSystems
     * @return JumpGate
     */
    public function setConnectedSystems(array $connectedSystems): JumpGate
    {
        $this->connectedSystems = $connectedSystems;
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
