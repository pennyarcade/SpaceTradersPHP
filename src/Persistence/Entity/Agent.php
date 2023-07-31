<?php

namespace App\Persistence\Entity;

use App\Common\Deserializable;
use Doctrine\DBAL\Types\Types;
use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'agent')]
#[ORM\HasLifecycleCallbacks]
class Agent extends BasicEntity implements JsonSerializable, Deserializable
{
    #[ORM\Column(type: Types::STRING)]
    protected string $accountId;
    #[ORM\Column(type: Types::STRING)]
    protected string $symbol;
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected string $headquarters;
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected int    $credits;
    #[ORM\Column(type: Types::STRING)]
    private string $token;

    /**
     * @param string $accountId
     * @param string $symbol
     * @param string $headquarters
     * @param int $credits
     * @param string $token
     */
    public function __construct(string $accountId, string $symbol, string $headquarters, int $credits, string $token)
    {
        $this->accountId = $accountId;
        $this->symbol = $symbol;
        $this->headquarters = $headquarters;
        $this->credits = $credits;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param  string $token
     * @return Agent
     */
    public function setToken(string $token): Agent
    {
        $this->token = $token;
        return $this;
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
     * @param  string $symbol
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
     * @param  string $headquarters
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
     * @param  int $credits
     * @return Agent
     */
    public function setCredits(int $credits): Agent
    {
        $this->credits = $credits;
        return $this;
    }

    public function jsonSerialize(): array
    {
        // TODO: Implement jsonSerialize() method.
        return [];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['accountId'],
            $data['symbol'],
            $data['headquarters'],
            $data['credits'],
            $data['token']
        );
    }


}
