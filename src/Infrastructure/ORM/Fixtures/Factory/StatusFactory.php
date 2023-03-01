<?php

namespace App\Infrastructure\ORM\Fixtures\Factory;

use Infrastructure\ORM\Entity\Status;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Status>
 *
 * @method        Status|Proxy     create(array|callable $attributes = [])
 * @method static Status|Proxy     createOne(array $attributes = [])
 * @method static Status|Proxy     find(object|array|mixed $criteria)
 * @method static Status|Proxy     findOrCreate(array $attributes)
 * @method static Status|Proxy     first(string $sortedField = 'id')
 * @method static Status|Proxy     last(string $sortedField = 'id')
 * @method static Status|Proxy     random(array $attributes = [])
 * @method static Status|Proxy     randomOrCreate(array $attributes = [])
 * @method static Status[]|Proxy[] all()
 * @method static Status[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Status[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Status[]|Proxy[] findBy(array $attributes)
 * @method static Status[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Status[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class StatusFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Status.php $status): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Status::class;
    }
}
