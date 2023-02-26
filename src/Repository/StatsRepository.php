<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Stats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StatsRepository extends ServiceEntityRepository implements StatsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stats::class);
    }

    public function save(Stats $stats)
    {
        $em = $this->getEntityManager();
        $em->persist($stats);
        $em->flush();
    }
}