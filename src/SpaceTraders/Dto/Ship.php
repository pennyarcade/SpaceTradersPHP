<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\ShipFrame;
use JsonSerializable;

class Ship implements JsonSerializable, Deserializable
{
    protected string $symbol;
    protected ShipRegistration $registration;
    protected ShipNav $nav;
    protected ShipCrew $crew;
    protected ShipFrame $frame;
    protected ShipReactor $reactor;
    protected ShipEngine $engine;
    /**
     * @var ShipModule[] $modules
     */
    protected array $modules;
    /**
     * @var ShipMount[] $mounts
     */
    protected array $mounts;
    protected ShipCargo $cargo;
    protected ShipFuel $fuel;

    /**
     * @param string           $symbol
     * @param ShipRegistration $registration
     * @param ShipNav          $nav
     * @param ShipCrew         $crew
     * @param ShipFrame        $frame
     * @param ShipReactor      $reactor
     * @param ShipEngine       $engine
     * @param ShipModule[]     $modules
     * @param ShipMount[]      $mounts
     * @param ShipCargo        $cargo
     * @param ShipFuel         $fuel
     */
    public function __construct(
        string $symbol,
        ShipRegistration $registration,
        ShipNav $nav,
        ShipCrew $crew,
        ShipFrame $frame,
        ShipReactor $reactor,
        ShipEngine $engine,
        array $modules,
        array $mounts,
        ShipCargo $cargo,
        ShipFuel $fuel
    ) {
        $this->symbol = $symbol;
        $this->registration = $registration;
        $this->nav = $nav;
        $this->crew = $crew;
        $this->frame = $frame;
        $this->reactor = $reactor;
        $this->engine = $engine;
        $this->modules = $modules;
        $this->mounts = $mounts;
        $this->cargo = $cargo;
        $this->fuel = $fuel;
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
     * @return Ship
     */
    public function setSymbol(string $symbol): Ship
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return ShipRegistration
     */
    public function getRegistration(): ShipRegistration
    {
        return $this->registration;
    }

    /**
     * @param  ShipRegistration $registration
     * @return Ship
     */
    public function setRegistration(ShipRegistration $registration): Ship
    {
        $this->registration = $registration;
        return $this;
    }

    /**
     * @return ShipNav
     */
    public function getNav(): ShipNav
    {
        return $this->nav;
    }

    /**
     * @param  ShipNav $nav
     * @return Ship
     */
    public function setNav(ShipNav $nav): Ship
    {
        $this->nav = $nav;
        return $this;
    }

    /**
     * @return ShipCrew
     */
    public function getCrew(): ShipCrew
    {
        return $this->crew;
    }

    /**
     * @param  ShipCrew $crew
     * @return Ship
     */
    public function setCrew(ShipCrew $crew): Ship
    {
        $this->crew = $crew;
        return $this;
    }

    /**
     * @return ShipFrame
     */
    public function getFrame(): ShipFrame
    {
        return $this->frame;
    }

    /**
     * @param  ShipFrame $frame
     * @return Ship
     */
    public function setFrame(ShipFrame $frame): Ship
    {
        $this->frame = $frame;
        return $this;
    }

    /**
     * @return ShipReactor
     */
    public function getReactor(): ShipReactor
    {
        return $this->reactor;
    }

    /**
     * @param  ShipReactor $reactor
     * @return Ship
     */
    public function setReactor(ShipReactor $reactor): Ship
    {
        $this->reactor = $reactor;
        return $this;
    }

    /**
     * @return ShipEngine
     */
    public function getEngine(): ShipEngine
    {
        return $this->engine;
    }

    /**
     * @param  ShipEngine $engine
     * @return Ship
     */
    public function setEngine(ShipEngine $engine): Ship
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * @return array
     */
    public function getModules(): array
    {
        return $this->modules;
    }

    /**
     * @param  array $modules
     * @return Ship
     */
    public function setModules(array $modules): Ship
    {
        $this->modules = $modules;
        return $this;
    }

    /**
     * @return array
     */
    public function getMounts(): array
    {
        return $this->mounts;
    }

    /**
     * @param  array $mounts
     * @return Ship
     */
    public function setMounts(array $mounts): Ship
    {
        $this->mounts = $mounts;
        return $this;
    }

    /**
     * @return ShipCargo
     */
    public function getCargo(): ShipCargo
    {
        return $this->cargo;
    }

    /**
     * @param  ShipCargo $cargo
     * @return Ship
     */
    public function setCargo(ShipCargo $cargo): Ship
    {
        $this->cargo = $cargo;
        return $this;
    }

    /**
     * @return ShipFuel
     */
    public function getFuel(): ShipFuel
    {
        return $this->fuel;
    }

    /**
     * @param  ShipFuel $fuel
     * @return Ship
     */
    public function setFuel(ShipFuel $fuel): Ship
    {
        $this->fuel = $fuel;
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
