<?php

namespace App\Persistence\Entity;

use App\SpaceTraders\Dto\Agent as AgentDto;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'agent')]
#[ORM\HasLifecycleCallbacks]
class Agent extends AgentDto
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    protected int $id;
    #[ORM\Column(name: 'created_date', type: Types::DATETIME_MUTABLE, updatable: false)]
    protected DateTime $created;
    #[ORM\Column(name: 'changed_date', type: Types::DATETIME_MUTABLE)]
    protected DateTime $changed;
    #[ORM\Column(name: 'expires_date', type: Types::DATETIME_MUTABLE, nullable: true)]
    protected ?DateTime $expires;

    #[ORM\Column(type: 'string')]
    protected string $accountId;
    #[ORM\Column(type: 'string')]
    protected string $symbol;
    #[ORM\Column(type: 'string')]
    protected string $headquarters;
    #[ORM\Column(type: 'string')]
    protected int    $credits;
    #[ORM\Column(type: 'string')]
    private string $token;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Agent
     */
    public function setToken(string $token): Agent
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Agent
     */
    public function setId(int $id): Agent
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     * @return Agent
     */
    public function setCreated(DateTime $created): Agent
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getChanged(): DateTime
    {
        return $this->changed;
    }

    /**
     * @param DateTime $changed
     * @return Agent
     */
    public function setChanged(DateTime $changed): Agent
    {
        $this->changed = $changed;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getExpires(): ?DateTime
    {
        return $this->expires;
    }

    /**
     * @param DateTime|null $expires
     * @return Agent
     */
    public function setExpires(?DateTime $expires): Agent
    {
        $this->expires = $expires;
        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updatedTimestamps(): void
    {
        $this->setChanged(new DateTime('now'));
        if ($this->getCreated() === null) {
            $this->setCreated(new DateTime('now'));
        }
    }

}
