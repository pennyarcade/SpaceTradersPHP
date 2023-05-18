<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use DateTime;
use JsonSerializable;

/**
 * @link:       https://github.com/SpaceTradersAPI/api-docs/blob/main/models/Chart.json
 * @description "The chart of a system or waypoint, which makes the location visible to other agents."
 */
class Chart implements JsonSerializable, Deserializable
{
    private ?string $waypointSymbol;
    private ?string $submittedBy;
    private ?DateTime $submittedOn;

    /**
     * @param string|null   $waypointSymbol
     * @param string|null   $submittedBy
     * @param DateTime|null $submittedOn
     */
    public function __construct(?string $waypointSymbol, ?string $submittedBy, ?DateTime $submittedOn)
    {
        $this->waypointSymbol = $waypointSymbol;
        $this->submittedBy = $submittedBy;
        $this->submittedOn = $submittedOn;
    }

    /**
     * @return string|null
     */
    public function getWaypointSymbol(): ?string
    {
        return $this->waypointSymbol;
    }

    /**
     * @param  string|null $waypointSymbol
     * @return Chart
     */
    public function setWaypointSymbol(?string $waypointSymbol): Chart
    {
        $this->waypointSymbol = $waypointSymbol;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubmittedBy(): ?string
    {
        return $this->submittedBy;
    }

    /**
     * @param  string|null $submittedBy
     * @return Chart
     */
    public function setSubmittedBy(?string $submittedBy): Chart
    {
        $this->submittedBy = $submittedBy;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getSubmittedOn(): ?DateTime
    {
        return $this->submittedOn;
    }

    /**
     * @param  DateTime|null $submittedOn
     * @return Chart
     */
    public function setSubmittedOn(?DateTime $submittedOn): Chart
    {
        $this->submittedOn = $submittedOn;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }

    public function fromArray(array $data): static
    {
        // TODO: Implement fromArray() method.
    }
}
