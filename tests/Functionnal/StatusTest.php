<?php

declare(strict_types=1);

namespace App\Tests\Functionnal;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Status;
use App\Entity\Task;

class StatusTest extends ApiTestCase
{
    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        shell_exec('php bin/console app:load:fixtures');
    }

    public function testGetCollectionOfTodoTasks(): void
    {
        $response = static::createClient()->request('GET', '/api/statuses/1');
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@type' => 'Status',
            '@id' => '/api/statuses/1',
            'name' => 'todo',
        ]);
        $this->assertCount(3, $response->toArray()['tasks']);
    }

    public function testGetCollectionOfInProgressTasks(): void
    {
        $response = static::createClient()->request('GET', '/api/statuses/2');
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@type' => 'Status',
            '@id' => '/api/statuses/2',
            'name' => 'in_progress',
        ]);
        $this->assertCount(3, $response->toArray()['tasks']);
    }

    public function testGetCollectionOfDoneTasks(): void
    {
        $response = static::createClient()->request('GET', '/api/statuses/3');
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@type' => 'Status',
            '@id' => '/api/statuses/3',
            'name' => 'done',
        ]);
        $this->assertCount(3, $response->toArray()['tasks']);
    }

    public function testGetCollectionOfAllTasks(): void
    {
        $response = static::createClient()->request('GET', '/api/statuses');
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@context' => '/api/contexts/Status',
            '@type' => 'hydra:Collection',
            '@id' => '/api/statuses',
        ]);
        $responseArray = $response->toArray()['hydra:member'];
        $this->assertCount(3, $response->toArray()['hydra:member']);
        self::assertArrayHasKey('name', $responseArray[0]);
        self::assertEquals('todo', $responseArray[0]['name']);
        self::assertArrayHasKey('name', $responseArray[1]);
        self::assertEquals('in_progress', $responseArray[1]['name']);
        self::assertArrayHasKey('name', $responseArray[2]);
        self::assertEquals('done', $responseArray[2]['name']);
    }
}
