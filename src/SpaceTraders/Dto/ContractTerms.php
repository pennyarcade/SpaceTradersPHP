<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use DateTime;
use JsonSerializable;

class ContractTerms implements JsonSerializable, Deserializable
{
    protected DateTime $deadline;
    protected ContractPayment $payment;
    /**
     * @var ContractDeliverGood[] $deliver
     */
    protected array $deliver;

    /**
     * @param DateTime              $deadline
     * @param ContractPayment       $payment
     * @param ContractDeliverGood[] $deliver
     */
    public function __construct(DateTime $deadline, ContractPayment $payment, array $deliver)
    {
        $this->deadline = $deadline;
        $this->payment = $payment;
        $this->deliver = $deliver;
    }

    /**
     * @return DateTime
     */
    public function getDeadline(): DateTime
    {
        return $this->deadline;
    }

    /**
     * @param  DateTime $deadline
     * @return ContractTerms
     */
    public function setDeadline(DateTime $deadline): ContractTerms
    {
        $this->deadline = $deadline;
        return $this;
    }

    /**
     * @return ContractPayment
     */
    public function getPayment(): ContractPayment
    {
        return $this->payment;
    }

    /**
     * @param  ContractPayment $payment
     * @return ContractTerms
     */
    public function setPayment(ContractPayment $payment): ContractTerms
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @return array
     */
    public function getDeliver(): array
    {
        return $this->deliver;
    }

    /**
     * @param  array $deliver
     * @return ContractTerms
     */
    public function setDeliver(array $deliver): ContractTerms
    {
        $this->deliver = $deliver;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }

    public static function fromArray(array $data): static
    {
        $goods = [];
        foreach ($data['deliver'] as $good) {
            $goods[] = ContractDeliverGood::fromArray($good);
        }

        return new self(
            deadline: new DateTime($data['deadline']),
            payment: ContractPayment::fromArray($data['payment']),
            deliver: $goods
        );
    }
}
