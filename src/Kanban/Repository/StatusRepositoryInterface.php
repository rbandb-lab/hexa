<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use Infrastructure\ORM\Entity\Status;

interface StatusRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null);

    public function findOneBy(array $criteria, ?array $orderBy = null);

    public function save(Status $status): void;
}
