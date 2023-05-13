<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\ShipEngineSymbolType;
use App\SpaceTraders\Enum\ShipFrame;
use App\SpaceTraders\Enum\ShipMountSymbolType;
use App\SpaceTraders\Enum\ShipReactorSymbolType;
use JsonSerializable;

class ScannedShip implements JsonSerializable, Deserializable
{
    protected string $symbol;
    protected ShipRegistration $registration;
    protected ShipNav $nav;
    protected ?ShipFrame $frameSymbol;
    protected ?ShipReactorSymbolType $reactorSymbol;
    protected ShipEngineSymbolType $engineSymbol;
    /** @var ?ShipMountSymbolType[] $mounts */
    protected ?array $mounts;

    /**
     * @param string $symbol
     * @param ShipRegistration $registration
     * @param ShipNav $nav
     * @param ShipFrame|null $frameSymbol
     * @param ShipReactorSymbolType|null $reactorSymbol
     * @param ShipEngineSymbolType $engineSymbol
     * @param ShipMountSymbolType[]|null $mounts
     */
    public function __construct(
        string $symbol,
        ShipRegistration $registration,
        ShipNav $nav,
        ShipEngineSymbolType $engineSymbol,
        ?ShipFrame $frameSymbol = null,
        ?ShipReactorSymbolType $reactorSymbol = null,
        ?array $mounts = null
    ) {
        $this->symbol = $symbol;
        $this->registration = $registration;
        $this->nav = $nav;
        $this->frameSymbol = $frameSymbol;
        $this->reactorSymbol = $reactorSymbol;
        $this->engineSymbol = $engineSymbol;
        $this->mounts = $mounts;
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
     * @return ScannedShip
     */
    public function setSymbol(string $symbol): ScannedShip
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
     * @param ShipRegistration $registration
     * @return ScannedShip
     */
    public function setRegistration(ShipRegistration $registration): ScannedShip
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
     * @param ShipNav $nav
     * @return ScannedShip
     */
    public function setNav(ShipNav $nav): ScannedShip
    {
        $this->nav = $nav;
        return $this;
    }

    /**
     * @return ShipFrame|null
     */
    public function getFrameSymbol(): ?ShipFrame
    {
        return $this->frameSymbol;
    }

    /**
     * @param ShipFrame|null $frameSymbol
     * @return ScannedShip
     */
    public function setFrameSymbol(?ShipFrame $frameSymbol): ScannedShip
    {
        $this->frameSymbol = $frameSymbol;
        return $this;
    }

    /**
     * @return ShipReactorSymbolType|null
     */
    public function getReactorSymbol(): ?ShipReactorSymbolType
    {
        return $this->reactorSymbol;
    }

    /**
     * @param ShipReactorSymbolType|null $reactorSymbol
     * @return ScannedShip
     */
    public function setReactorSymbol(?ShipReactorSymbolType $reactorSymbol): ScannedShip
    {
        $this->reactorSymbol = $reactorSymbol;
        return $this;
    }

    /**
     * @return ShipEngineSymbolType
     */
    public function getEngineSymbol(): ShipEngineSymbolType
    {
        return $this->engineSymbol;
    }

    /**
     * @param ShipEngineSymbolType $engineSymbol
     * @return ScannedShip
     */
    public function setEngineSymbol(ShipEngineSymbolType $engineSymbol): ScannedShip
    {
        $this->engineSymbol = $engineSymbol;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getMounts(): ?array
    {
        return $this->mounts;
    }

    /**
     * @param array|null $mounts
     * @return ScannedShip
     */
    public function setMounts(?array $mounts): ScannedShip
    {
        $this->mounts = $mounts;
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
