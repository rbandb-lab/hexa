<?php

declare(strict_types=1);

namespace App\App\Handler;

use App\Entity\Stats;
use App\Entity\Status;
use Doctrine\Common\Collections\Collection;


class StatsCalculationHandler
{
    public function handle(Status $status, \DateTime $fromDate, \DateTime $toDate): Stats
    {
        $tasks = $status->getTasks();
        $stats = new Stats(
            status: $status->getName(),
            fromDate: $fromDate,
            toDate: $toDate
        );

        $stats->setCount($tasks->count());
        $time = 0;
        foreach ($tasks as $task){
            $time += $task->getTimer()->getValue();
        }
        $stats->setTime($time);
        $stats->setMeanTime( meanTime: $tasks->count() >0 ? (int)($time/$tasks->count()) : 0);

        return $stats;
    }
}