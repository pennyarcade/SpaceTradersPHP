<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use App\SpaceTraders\Enum\FactionTraitType;
use JsonSerializable;

class FactionTrait implements JsonSerializable, Deserializable
{
    protected FactionTraitType $symbol;
    protected string $name;
    protected string $description;

    /**
     * @param FactionTraitType $symbol
     * @param string           $name
     * @param string           $description
     */
    public function __construct(FactionTraitType $symbol, string $name, string $description)
    {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return FactionTraitType
     */
    public function getSymbol(): FactionTraitType
    {
        return $this->symbol;
    }

    /**
     * @param  FactionTraitType $symbol
     * @return FactionTrait
     */
    public function setSymbol(FactionTraitType $symbol): FactionTrait
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string $name
     * @return FactionTrait
     */
    public function setName(string $name): FactionTrait
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param  string $description
     * @return FactionTrait
     */
    public function setDescription(string $description): FactionTrait
    {
        $this->description = $description;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            symbol: FactionTraitType::fromName($data['symbol']),
            name: $data['name'],
            description: $data['description']
        );
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
