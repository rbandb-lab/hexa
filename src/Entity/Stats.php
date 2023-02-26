<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Controller\StatsController;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Link;

#[ORM\Entity]
#[ApiResource(operations: [
    new Post(
        controller: StatsController::class,
        read: false,
        name: 'stats'
    )
])]
class Stats
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $fromDate;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $toDate;

    #[ORM\ManyToOne(targetEntity: Status::class, inversedBy: 'stats')]
    #[ORM\JoinColumn(name: 'status_id', referencedColumnName: 'id', nullable: true)]
    private ?Status $status = null;

    #[ORM\Column(type: 'integer')]
    private int $count = 0;

    #[ORM\Column(type: 'integer')]
    private int $time  = 0;

    #[ORM\Column(type: 'integer')]
    private int $meanTime  = 0;

    public function __construct(Status $status, \DateTime $fromDate, \DateTime $toDate)
    {
        $this->status = $status;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'fromDate' => $this->fromDate->format('Y-m-d-H-i-s'),
            'toDate' => $this->toDate->format('Y-m-d-H-i-s'),
            'count' => $this->count,
            'time' => $this->time,
            'mean_per_task' => $this->meanTime
        ];
    }
    
    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }
    public function getTime(): int
    {
        return $this->time;
    }

    public function setTime(int $time): void
    {
        $this->time = $time;
    }

    public function getMeanTime(): int
    {
        return $this->meanTime;
    }

    public function setMeanTime(int $meanTime): void
    {
        $this->meanTime = $meanTime;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public function getFromDate(): \DateTime
    {
        return $this->fromDate;
    }

    public function setFromDate(\DateTime $fromDate): void
    {
        $this->fromDate = $fromDate;
    }

    public function getToDate(): \DateTime
    {
        return $this->toDate;
    }

    public function setToDate(\DateTime $toDate): void
    {
        $this->toDate = $toDate;
    }
}