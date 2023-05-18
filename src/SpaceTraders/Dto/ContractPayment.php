<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class ContractPayment implements JsonSerializable, Deserializable
{
    protected int $onAccepted;
    protected int $onFulfilled;

    /**
     * @param int $onAccepted
     * @param int $onFulfilled
     */
    public function __construct(int $onAccepted, int $onFulfilled)
    {
        $this->onAccepted = $onAccepted;
        $this->onFulfilled = $onFulfilled;
    }

    /**
     * @return int
     */
    public function getOnAccepted(): int
    {
        return $this->onAccepted;
    }

    /**
     * @param  int $onAccepted
     * @return ContractPayment
     */
    public function setOnAccepted(int $onAccepted): ContractPayment
    {
        $this->onAccepted = $onAccepted;
        return $this;
    }

    /**
     * @return int
     */
    public function getOnFulfilled(): int
    {
        return $this->onFulfilled;
    }

    /**
     * @param  int $onFulfilled
     * @return ContractPayment
     */
    public function setOnFulfilled(int $onFulfilled): ContractPayment
    {
        $this->onFulfilled = $onFulfilled;
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
