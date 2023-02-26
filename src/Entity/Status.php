<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Controller\StatsController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ApiResource(
    uriTemplate: '/status/{id}/task',
    uriVariables: [
        'id' => new Link(
            fromProperty: 'status',
            fromClass: Task::class
        )
    ]
)]
#[ORM\Entity]
class Status
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id;

    #[ORM\Column]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: Task::class)]
    private Collection $tasks;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: Stats::class)]
    private Collection $stats;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->stats = new ArrayCollection();
    }

    /**
     * @return Collection<Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    /**
     * @param Collection<Task> $tasks
     */
    public function setTasks(Collection $tasks): void
    {
        $this->tasks = $tasks;
    }

    public function addTask(Task $task): void
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
        }
    }

    public function removeTask(Task $task): void
    {
        if ($this->tasks->contains($task)) {
            $this->tasks->removeElement($task);
        }
    }

    /**
     * @return Collection<Stats>
     */
    public function getStats(): Collection
    {
        return $this->stats;
    }

    /**
     * @param Collection<Stats> $stats
     */
    public function setStats(Collection $stats): void
    {
        $this->stats = $stats;
    }

    public function addStats(Stats $stats): void
    {
        if(!$this->stats->contains($stats)){
            $this->stats->add($stats);
        }
    }

    public function removeStats(Stats $stats): void
    {
        if($this->stats->contains($stats)){
            $this->stats->removeElement($stats);
        }
    }













    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
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
}