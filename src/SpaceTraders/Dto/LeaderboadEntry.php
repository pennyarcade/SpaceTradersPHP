<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class LeaderboadEntry implements JsonSerializable, Deserializable
{
    protected string $agentSymbol;
    protected int $value;

    /**
     * @param string $agentSymbol
     * @param int    $value
     */
    public function __construct(string $agentSymbol, int $value)
    {
        $this->agentSymbol = $agentSymbol;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getAgentSymbol(): string
    {
        return $this->agentSymbol;
    }

    /**
     * @param  string $agentSymbol
     * @return LeaderboadEntry
     */
    public function setAgentSymbol(string $agentSymbol): LeaderboadEntry
    {
        $this->agentSymbol = $agentSymbol;
        return $this;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param  int $value
     * @return LeaderboadEntry
     */
    public function setValue(int $value): LeaderboadEntry
    {
        $this->value = $value;
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
