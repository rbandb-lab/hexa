<?php

declare(strict_types=1);

namespace App\UI\Command;

use App\Entity\Task;
use App\Entity\Timer;
use App\Factory\StatusFactory;
use App\Factory\TaskFactory;
use App\Repository\StatusRepositoryInterface;
use App\Repository\TaskRepositoryInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\Time;

#[AsCommand(name: 'app:load:fixtures')]
class LoadFixturesCommand extends Command
{
    private StatusRepositoryInterface $statusRepository;

    public function __construct(
        StatusRepositoryInterface $statusRepository,
        string $name = null)
    {
        $this->statusRepository = $statusRepository;
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        shell_exec('APP_ENV=test php bin/console d:d:d --force');
        shell_exec('APP_ENV=test php bin/console d:d:c');
        shell_exec('APP_ENV=test php bin/console d:m:m -n');

        StatusFactory::createOne([
            'id' => 0,
            'name' => 'todo'
        ]);

        StatusFactory::createOne([
            'id' => 1,
            'name' => 'in_progress'
        ]);

        StatusFactory::createOne([
            'id' => 0,
            'name' => 'done'
        ]);

        $faker = Factory::create('en');

        $tasks = TaskFactory::createMany(3, [
            'status' => $this->statusRepository->find(1),
            'createdAt' => $createdAt = \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 days', 'now')),
            'updatedAt' => $updatedAt = $faker->dateTimeBetween('-10 days', $createdAt->getTimestamp()),
        ]);

        $tasks = TaskFactory::createMany(3, [
            'status' => $this->statusRepository->find(2),
            'createdAt' => $createdAt = \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 days', 'now')),
            'updatedAt' => $faker->dateTimeBetween('-10 days', $createdAt->getTimestamp()),
        ]);

        for($t = 0; $t <3 ; $t++){
            $timer = new Timer($startedAt = $faker->dateTimeBetween('-10 days', $updatedAt));
            $endedAt = new \DateTime();
            $timer->setEndedAt($endedAt->setTimestamp($startedAt->getTimestamp() + random_int(100, 14400)));

            $task = TaskFactory::createOne([
                'status' => $this->statusRepository->find(3),
                'createdAt' => $createdAt = \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 days', 'now')),
                'updatedAt' => $faker->dateTimeBetween('-10 days', $createdAt->getTimestamp()),
                'timer' => $timer
            ]);

        }

        return Command::SUCCESS;
    }
}