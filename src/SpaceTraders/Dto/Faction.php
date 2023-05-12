<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class Faction implements JsonSerializable, Deserializable
{
    protected string $symbol;
    protected string $name;
    protected string $description;
    protected string $headquarters;
    /** @var FactionTrait[] $traits */
    protected array $traits;

    /**
     * @param string $symbol
     * @param string $name
     * @param string $description
     * @param string $headquarters
     * @param FactionTrait[] $traits
     */
    public function __construct(string $symbol, string $name, string $description, string $headquarters, array $traits)
    {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->description = $description;
        $this->headquarters = $headquarters;
        $this->traits = $traits;
    }

    public function fromArray(array $data): static
    {
        // TODO: Implement fromArray() method.
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
     * @return Faction
     */
    public function setSymbol(string $symbol): Faction
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Faction
     */
    public function setName(string $name): Faction
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Faction
     */
    public function setDescription(string $description): Faction
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeadquarters(): string
    {
        return $this->headquarters;
    }

    /**
     * @param string $headquarters
     * @return Faction
     */
    public function setHeadquarters(string $headquarters): Faction
    {
        $this->headquarters = $headquarters;
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
     * @return Faction
     */
    public function setTraits(array $traits): Faction
    {
        $this->traits = $traits;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
