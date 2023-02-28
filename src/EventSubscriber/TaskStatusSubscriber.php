<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Task;
use App\Repository\StatusRepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class TaskStatusSubscriber implements EventSubscriberInterface
{
    private StatusRepositoryInterface $statusRepository;

    public function __construct(StatusRepositoryInterface $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['addStatus', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function addStatus(ViewEvent $event): void
    {
        $task = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$task instanceof Task || Request::METHOD_POST !== $method) {
            return;
        }

        if (!$task->getStatus()) {
            $status = $this->statusRepository->findOneBy(['name' => 'todo']);
            $task->setStatus($status);
            $event->setControllerResult($task);
        }
    }
}
