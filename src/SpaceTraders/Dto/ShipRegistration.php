<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\ShipRole;
use JsonSerializable;

class ShipRegistration implements JsonSerializable, Deserializable
{
    protected string $name;
    protected string $factionSymbol;
    protected ShipRole $role;

    /**
     * @param string   $name
     * @param string   $factionSymbol
     * @param ShipRole $role
     */
    public function __construct(string $name, string $factionSymbol, ShipRole $role)
    {
        $this->name = $name;
        $this->factionSymbol = $factionSymbol;
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string $name
     * @return ShipRegistration
     */
    public function setName(string $name): ShipRegistration
    {
        $this->name = $name;
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
     * @return ShipRegistration
     */
    public function setFactionSymbol(string $factionSymbol): ShipRegistration
    {
        $this->factionSymbol = $factionSymbol;
        return $this;
    }

    /**
     * @return ShipRole
     */
    public function getRole(): ShipRole
    {
        return $this->role;
    }

    /**
     * @param  ShipRole $role
     * @return ShipRegistration
     */
    public function setRole(ShipRole $role): ShipRegistration
    {
        $this->role = $role;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            factionSymbol: $data['factionSymbol'],
            role: ShipRole::fromName($data['role'])
        );
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
