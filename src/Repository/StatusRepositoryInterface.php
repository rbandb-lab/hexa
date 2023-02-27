<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Status;

interface StatusRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null);

    public function save(Status $status): void;
}