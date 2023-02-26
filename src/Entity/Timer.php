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

<<<<<<< HEAD
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
=======
    #[ORM\Column(type: 'datetime')]
    private \DateTime $endedAt;

    public function __construct()
    {
        $this->startedAt = new \DateTime();
>>>>>>> 5ef35d9 (add Timer ApiResource)
    }

    public function getId(): ?int
    {
        return $this->id;
    }

<<<<<<< HEAD
=======
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

>>>>>>> 5ef35d9 (add Timer ApiResource)
    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

<<<<<<< HEAD
    public function getEndedAt(): ?\DateTime
=======
    public function setStartedAt(\DateTime $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getEndedAt(): \DateTime
>>>>>>> 5ef35d9 (add Timer ApiResource)
    {
        return $this->endedAt;
    }

<<<<<<< HEAD
    public function setEndedAt(?\DateTime $endedAt): void
    {
        $this->endedAt = $endedAt;
    }
}
=======
    public function setEndedAt(\DateTime $endedAt): void
    {
        $this->endedAt = $endedAt;
    }
}
>>>>>>> 5ef35d9 (add Timer ApiResource)
