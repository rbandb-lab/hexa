<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Task;

interface TaskRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null);

    public function save(Task $task): void;
}
