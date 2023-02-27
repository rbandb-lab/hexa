<?php

namespace App\Factory;

use App\Entity\Task;
use App\Entity\Timer;
use App\Repository\StatusRepositoryInterface;
use Faker\Factory;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Task>
 *
 * @method        Task|Proxy create(array|callable $attributes = [])
 * @method static Task|Proxy createOne(array $attributes = [])
 * @method static Task|Proxy find(object|array|mixed $criteria)
 * @method static Task|Proxy findOrCreate(array $attributes)
 * @method static Task|Proxy first(string $sortedField = 'id')
 * @method static Task|Proxy last(string $sortedField = 'id')
 * @method static Task|Proxy random(array $attributes = [])
 * @method static Task|Proxy randomOrCreate(array $attributes = [])
 * @method static Task[]|Proxy[] all()
 * @method static Task[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Task[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Task[]|Proxy[] findBy(array $attributes)
 * @method static Task[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Task[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TaskFactory extends ModelFactory
{/**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'name' => self::faker()->text(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        $faker = Factory::create('en');
        return $this
             ->afterInstantiate(function (Task $task) use ($faker): void {
                 $status = $task->getStatus();
                 $status->addTask($task);
                 $timer = new Timer($task, $startedAt = $faker->dateTimeBetween('-10 days', $task->getUpdatedAt() ?? new \DateTime('now')));
                 $timer->setEndedAt($faker->dateTimeBetween('-10 days', $task->getUpdatedAt()));
                 $task->setTimer($timer);
             })
        ;
    }

    protected static function getClass(): string
    {
        return Task::class;
    }
}
