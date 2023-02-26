<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Stats;

interface StatsRepositoryInterface
{
    public function save(Stats $stats);
}