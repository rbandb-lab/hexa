<?php

declare(strict_types=1);

namespace App\Infrastructure\ORM\Fixtures\Command;

use App\Domain\Repository\StatusRepositoryInterface;
use App\Infrastructure\ORM\Fixtures\Factory\StatusFactory;
use App\Infrastructure\ORM\Fixtures\Factory\TaskFactory;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:load:fixtures',
    description: 'Creates fixtures',
    aliases: ['app:load:fixtures'],
    hidden: false
)]
class LoadFixturesCommand extends Command
{
    private StatusRepositoryInterface $statusRepository;

    public function __construct(
        StatusRepositoryInterface $statusRepository,
        string $name = null
    ) {
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
            'name' => 'todo',
        ]);

        StatusFactory::createOne([
            'id' => 1,
            'name' => 'in_progress',
        ]);

        StatusFactory::createOne([
            'id' => 0,
            'name' => 'done',
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

        for ($t = 0; $t < 3; ++$t) {
            $task = TaskFactory::createOne([
                'status' => $this->statusRepository->find(3),
                'createdAt' => $createdAt = \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 days', 'now')),
                'updatedAt' => $faker->dateTimeBetween('-10 days', $createdAt->getTimestamp()),
            ]);
        }

        return Command::SUCCESS;
    }
}
