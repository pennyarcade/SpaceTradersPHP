<?php
namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

/**
 * @link: https://github.com/SpaceTradersAPI/api-docs/blob/main/models/Agent.json
 */
class Agent implements JsonSerializable, Deserializable
{
    protected string $accountId;
    protected string $symbol;
    protected string $headquarters;
    protected int    $credits;

    /**
     * @param string $accountId
     * @param string $symbol
     * @param string $headquarters
     * @param int $credits
     */
    public function __construct(string $accountId, string $symbol, string $headquarters, int $credits)
    {
        $this->accountId = $accountId;
        $this->symbol = $symbol;
        $this->headquarters = $headquarters;
        $this->credits = $credits;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     * @return Agent
     */
    public function setAccountId(string $accountId): Agent
    {
        $this->accountId = $accountId;
        return $this;
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
     * @return Agent
     */
    public function setSymbol(string $symbol): Agent
    {
        $this->symbol = $symbol;
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
     * @return Agent
     */
    public function setHeadquarters(string $headquarters): Agent
    {
        $this->headquarters = $headquarters;
        return $this;
    }

    /**
     * @return int
     */
    public function getCredits(): int
    {
        return $this->credits;
    }

    /**
     * @param int $credits
     * @return Agent
     */
    public function setCredits(int $credits): Agent
    {
        $this->credits = $credits;
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
