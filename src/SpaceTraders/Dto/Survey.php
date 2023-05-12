<?php

namespace App\SpaceTraders\Dto;

use App\SpaceTraders\Enum\SurveyDepositSize;
use DateTime;
use JsonSerializable;

/**
 * @link: https://github.com/SpaceTradersAPI/api-docs/blob/main/models/Chart.json
 * @description "A resource survey of a waypoint, detailing a specific extraction location and the types
 *              of resources that can be found there."
 */
class Survey implements JsonSerializable
{
    private string $signature;
    private string $symbol;
    /** @var SurveyDeposit[]  */
    private array $deposits;
    private DateTime $expiration;
    private SurveyDepositSize $size;

    /**
     * @param string $signature
     * @param string $symbol
     * @param SurveyDeposit[] $deposits
     * @param DateTime $expiration
     * @param SurveyDepositSize $size
     */
    public function __construct(
        string $signature,
        string $symbol,
        array $deposits,
        DateTime $expiration,
        SurveyDepositSize $size
    ) {
        $this->signature = $signature;
        $this->symbol = $symbol;
        $this->deposits = $deposits;
        $this->expiration = $expiration;
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @param string $signature
     * @return Survey
     */
    public function setSignature(string $signature): Survey
    {
        $this->signature = $signature;
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
     * @return Survey
     */
    public function setSymbol(string $symbol): Survey
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return array
     */
    public function getDeposits(): array
    {
        return $this->deposits;
    }

    /**
     * @param array $deposits
     * @return Survey
     */
    public function setDeposits(array $deposits): Survey
    {
        $this->deposits = $deposits;
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
     * @param DateTime $expiration
     * @return Survey
     */
    public function setExpiration(DateTime $expiration): Survey
    {
        $this->expiration = $expiration;
        return $this;
    }

    /**
     * @return SurveyDepositSize
     */
    public function getSize(): SurveyDepositSize
    {
        return $this->size;
    }

    /**
     * @param SurveyDepositSize $size
     * @return Survey
     */
    public function setSize(SurveyDepositSize $size): Survey
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
