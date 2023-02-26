<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/** A book. */
#[ApiResource]
#[ORM\Entity]
class Task
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id;

    #[ORM\Column]
    private string $name;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: Status::class, inversedBy: 'tasks')]
    #[ORM\JoinColumn(name: 'status_id', referencedColumnName: 'id', nullable: true)]
    private ?Status $status = null;

    #[ORM\OneToOne(inversedBy: 'task', targetEntity: Timer::class, cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'timer_id', referencedColumnName: 'id', nullable: true)]
    private ?Timer $timer = null;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): void
    {
        $this->status = $status;
    }

    public function getTimer(): ?Timer
    {
        return $this->timer;
    }

    public function setTimer(?Timer $timer): void
    {
        $this->timer = $timer;
    }
}
