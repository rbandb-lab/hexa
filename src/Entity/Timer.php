<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity]
class Timer
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $startedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $endedAt = null;

    #[ORM\OneToOne(mappedBy: 'timer', targetEntity: Task::class)]
    private Task $task;

    public function __construct(Task $task)
    {
        $this->startedAt = new \DateTime();
        $this->task = $task;
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    public function getEndedAt(): ?\DateTime
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTime $endedAt): void
    {
        $this->endedAt = $endedAt;
    }
}
