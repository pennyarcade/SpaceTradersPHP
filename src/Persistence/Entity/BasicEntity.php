<?php

namespace App\Persistence\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

class BasicEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    protected int $id;

    #[ORM\Column(name: 'created_date', type: Types::DATETIME_MUTABLE, updatable: false)]
    protected \DateTime $created;
    #[ORM\Column(name: 'changed_date', type: Types::DATETIME_MUTABLE)]
    protected \DateTime $changed;
    #[ORM\Column(name: 'expires_date', type: Types::DATETIME_MUTABLE, nullable: true)]
    protected ?\DateTime $expires;

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
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return BasicEntity
     */
    public function setCreated(\DateTime $created): BasicEntity
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getChanged(): \DateTime
    {
        return $this->changed;
    }

    /**
     * @param \DateTime $changed
     * @return BasicEntity
     */
    public function setChanged(\DateTime $changed): BasicEntity
    {
        $this->changed = $changed;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getExpires(): ?\DateTime
    {
        return $this->expires;
    }

    /**
     * @param \DateTime|null $expires
     * @return BasicEntity
     */
    public function setExpires(?\DateTime $expires): BasicEntity
    {
        $this->expires = $expires;
        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updatedTimestamps(): void
    {
        $this->setChanged(new \DateTime('now'));
        if ($this->getCreated() === null) {
            $this->setCreated(new \DateTime('now'));
        }
    }
}
