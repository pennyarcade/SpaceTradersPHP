<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ServerStatus implements JsonSerializable, Deserializable
{
    protected string $status;
    protected WorldStats $stats;
    /** @var LeaderboadEntry[] $mostCreditsLeaderboard */
    protected array $mostCreditsLeaderboard;
    /** @var LeaderboadEntry[] $mostSubmittedChartsLeaderboard */
    protected array $mostSubmittedChartsLeaderboard;

    /**
     * @param string $status
     * @param WorldStats $stats
     * @param LeaderboadEntry[] $mostCreditsLeaderboard
     * @param LeaderboadEntry[] $mostSubmittedChartsLeaderboard
     */
    public function __construct(string $status, WorldStats $stats, array $mostCreditsLeaderboard, array $mostSubmittedChartsLeaderboard)
    {
        $this->status = $status;
        $this->stats = $stats;
        $this->mostCreditsLeaderboard = $mostCreditsLeaderboard;
        $this->mostSubmittedChartsLeaderboard = $mostSubmittedChartsLeaderboard;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return ServerStatus
     */
    public function setStatus(string $status): ServerStatus
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return WorldStats
     */
    public function getStats(): WorldStats
    {
        return $this->stats;
    }

    /**
     * @param WorldStats $stats
     * @return ServerStatus
     */
    public function setStats(WorldStats $stats): ServerStatus
    {
        $this->stats = $stats;
        return $this;
    }

    /**
     * @return array
     */
    public function getMostCreditsLeaderboard(): array
    {
        return $this->mostCreditsLeaderboard;
    }

    /**
     * @param array $mostCreditsLeaderboard
     * @return ServerStatus
     */
    public function setMostCreditsLeaderboard(array $mostCreditsLeaderboard): ServerStatus
    {
        $this->mostCreditsLeaderboard = $mostCreditsLeaderboard;
        return $this;
    }

    /**
     * @return array
     */
    public function getMostSubmittedChartsLeaderboard(): array
    {
        return $this->mostSubmittedChartsLeaderboard;
    }

    /**
     * @param array $mostSubmittedChartsLeaderboard
     * @return ServerStatus
     */
    public function setMostSubmittedChartsLeaderboard(array $mostSubmittedChartsLeaderboard): ServerStatus
    {
        $this->mostSubmittedChartsLeaderboard = $mostSubmittedChartsLeaderboard;
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
