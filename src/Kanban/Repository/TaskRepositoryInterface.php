<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use Infrastructure\ORM\Entity\Task;

interface TaskRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null);

    public function save(Task $task): void;
}
