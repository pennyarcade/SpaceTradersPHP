<?php

namespace App\SpaceTraders\Dto;

use JsonSerializable;

class SurveyDeposit implements JsonSerializable
{
    private string $symbol;

    /**
     * @param string $symbol
     */
    public function __construct(string $symbol)
    {
        $this->symbol = $symbol;
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
     * @return SurveyDeposit
     */
    public function setSymbol(string $symbol): SurveyDeposit
    {
        $this->symbol = $symbol;
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'symbol' => $this->symbol
        ];
    }
}
