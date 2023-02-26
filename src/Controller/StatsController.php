<?php

declare(strict_types=1);

namespace App\Controller;

use App\App\Handler\StatsCalculationHandler;
use App\Entity\Stats;
use App\Entity\Status;
use App\Repository\StatsRepositoryInterface;
use App\Repository\StatusRepository;
use App\Repository\StatusRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class StatsController
{
    public function __construct(
        private StatusRepositoryInterface $statusRepository,
        private StatsRepositoryInterface $statsRepository,
        private StatsCalculationHandler $statsCalculationHandler
    ) {}

    public function __invoke(Request $request, int $id): Response
    {
        $body = json_decode($request->getContent(), true);
        $fromDate = new \DateTime($body['fromDate']);
        $toDate = new \DateTime($body['toDate']);
        $status = $this->statusRepository->find($id);
        $stats = $this->statsCalculationHandler->handle($status, $fromDate, $toDate);
        $this->statsRepository->save($stats);

        return new JsonResponse($stats->toArray(), Response::HTTP_OK);
    }
}
