<?php

namespace App\Persistence\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

abstract class BasicEntity
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected int $id;

    #[ORM\Column(name: 'created_date', type: Types::DATETIME_MUTABLE, updatable: false)]
    protected ?DateTime $created;
    #[ORM\Column(name: 'changed_date', type: Types::DATETIME_MUTABLE)]
    protected ?DateTime $changed;
    #[ORM\Column(name: 'expires_date', type: Types::DATETIME_MUTABLE, nullable: true)]
    protected ?DateTime $expires;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param  int $id
     * @return static
     */
    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreated(): ?DateTime
    {
        return $this->created;
    }

    /**
     * @param  DateTime|null $created
     * @return static
     */
    public function setCreated(?DateTime $created): static
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getChanged(): ?DateTime
    {
        return $this->changed;
    }

    /**
     * @param  DateTime|null $changed
     * @return static
     */
    public function setChanged(?DateTime $changed): static
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
     * @param  DateTime|null $expires
     * @return static
     */
    public function setExpires(?DateTime $expires): static
    {
        $this->expires = $expires;
        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        $this->setChanged(new DateTime('now'));
        if ($this->getCreated() === null) {
            $this->setCreated(new DateTime('now'));
        }
    }
}
