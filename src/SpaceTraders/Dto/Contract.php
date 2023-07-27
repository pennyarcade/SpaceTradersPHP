<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\ContractType;
use DateTime;
use JsonSerializable;

class Contract implements JsonSerializable, Deserializable
{
    protected string $id;
    protected string $factionSymbol;
    protected ContractType $type;
    protected ContractTerms $terms;
    protected bool $accepted;
    protected bool $fulfilled;
    protected DateTime $expiration;
    protected DateTime $deadlineToAccept;

    /**
     * @param string $id
     * @param string $factionSymbol
     * @param ContractType $type
     * @param ContractTerms $terms
     * @param bool $accepted
     * @param bool $fulfilled
     * @param DateTime $expiration
     * @param DateTime $deadlineToAccept
     */
    public function __construct(
        string $id,
        string $factionSymbol,
        ContractType $type,
        ContractTerms $terms,
        bool $accepted,
        bool $fulfilled,
        DateTime $expiration,
        DateTime $deadlineToAccept
    ) {
        $this->id = $id;
        $this->factionSymbol = $factionSymbol;
        $this->type = $type;
        $this->terms = $terms;
        $this->accepted = $accepted;
        $this->fulfilled = $fulfilled;
        $this->expiration = $expiration;
        $this->deadlineToAccept = $deadlineToAccept;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param  string $id
     * @return Contract
     */
    public function setId(string $id): Contract
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFactionSymbol(): string
    {
        return $this->factionSymbol;
    }

    /**
     * @param  string $factionSymbol
     * @return Contract
     */
    public function setFactionSymbol(string $factionSymbol): Contract
    {
        $this->factionSymbol = $factionSymbol;
        return $this;
    }

    /**
     * @return ContractType
     */
    public function getType(): ContractType
    {
        return $this->type;
    }

    /**
     * @param  ContractType $type
     * @return Contract
     */
    public function setType(ContractType $type): Contract
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return ContractTerms
     */
    public function getTerms(): ContractTerms
    {
        return $this->terms;
    }

    /**
     * @param  ContractTerms $terms
     * @return Contract
     */
    public function setTerms(ContractTerms $terms): Contract
    {
        $this->terms = $terms;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAccepted(): bool
    {
        return $this->accepted;
    }

    /**
     * @param  bool $accepted
     * @return Contract
     */
    public function setAccepted(bool $accepted): Contract
    {
        $this->accepted = $accepted;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFulfilled(): bool
    {
        return $this->fulfilled;
    }

    /**
     * @param  bool $fulfilled
     * @return Contract
     */
    public function setFulfilled(bool $fulfilled): Contract
    {
        $this->fulfilled = $fulfilled;
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
     * @return Contract
     */
    public function setExpiration(DateTime $expiration): Contract
    {
        $this->expiration = $expiration;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDeadlineToAccept(): DateTime
    {
        return $this->deadlineToAccept;
    }

    /**
     * @param DateTime $deadlineToAccept
     * @return Contract
     */
    public function setDeadlineToAccept(DateTime $deadlineToAccept): Contract
    {
        $this->deadlineToAccept = $deadlineToAccept;
        return $this;
    }

    public function jsonSerialize(): string
    {
        // TODO: Implement jsonSerialize() method.
        return '';
    }

    public static function fromArray(array $data): static
    {
        return new self(
            id: $data['id'],
            factionSymbol: $data['factionSymbol'],
            type: ContractType::fromName($data['type']),
            terms: ContractTerms::fromArray($data['terms']),
            accepted: $data['accepted'],
            fulfilled: $data['fulfilled'],
            expiration: new DateTime($data['expiration']),
            deadlineToAccept: new DateTime($data['deadlineToAccept'])
        );
    }
}
