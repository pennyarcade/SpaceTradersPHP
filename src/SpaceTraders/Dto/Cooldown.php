<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use DateTime;
use JsonSerializable;

class Cooldown implements JsonSerializable, Deserializable
{
    protected string    $shipSymbol;
    protected int       $totalSeconds;
    protected int       $remainingSeconds;
    protected DateTime  $expiration;

    /**
     * @param string   $shipSymbol
     * @param int      $totalSeconds
     * @param int      $remainingSeconds
     * @param DateTime $expiration
     */
    public function __construct(string $shipSymbol, int $totalSeconds, int $remainingSeconds, DateTime $expiration)
    {
        $this->shipSymbol = $shipSymbol;
        $this->totalSeconds = $totalSeconds;
        $this->remainingSeconds = $remainingSeconds;
        $this->expiration = $expiration;
    }

    /**
     * @return string
     */
    public function getShipSymbol(): string
    {
        return $this->shipSymbol;
    }

    /**
     * @param  string $shipSymbol
     * @return Cooldown
     */
    public function setShipSymbol(string $shipSymbol): Cooldown
    {
        $this->shipSymbol = $shipSymbol;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalSeconds(): int
    {
        return $this->totalSeconds;
    }

    /**
     * @param  int $totalSeconds
     * @return Cooldown
     */
    public function setTotalSeconds(int $totalSeconds): Cooldown
    {
        $this->totalSeconds = $totalSeconds;
        return $this;
    }

    /**
     * @return int
     */
    public function getRemainingSeconds(): int
    {
        return $this->remainingSeconds;
    }

    /**
     * @param  int $remainingSeconds
     * @return Cooldown
     */
    public function setRemainingSeconds(int $remainingSeconds): Cooldown
    {
        $this->remainingSeconds = $remainingSeconds;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExpiration(): DateTime
    {
        return $this->expiration;
    }

    /**
     * @param  DateTime $expiration
     * @return Cooldown
     */
    public function setExpiration(DateTime $expiration): Cooldown
    {
        $this->expiration = $expiration;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        // TODO: Implement fromArray() method.
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
