<?php

declare(strict_types=1);

namespace App\Tests\Functionnal;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Task;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

class TasksTest extends ApiTestCase
{
    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        shell_exec('php bin/console app:load:fixtures');
    }

    public function testGetCollectionOfTasks(): void
    {
        $response = static::createClient()->request('GET', '/api/tasks');
        $this->assertResponseIsSuccessful();
        $this->assertCount(9, $response->toArray()['hydra:member']);
        $this->assertMatchesResourceCollectionJsonSchema(Task::class);
    }

    /**
     * status_id=1 => "todo"
     */
    public function testCreateTask(): void
    {
        $response = static::createClient()->request('POST', '/api/tasks', ['json' => [
            'name' => 'drink a coffee',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Task',
            '@type' => 'Task',
            'name' => 'drink a coffee',
            'status' => '/api/statuses/1'
        ]);
        $this->assertMatchesRegularExpression('~^/api/tasks/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Task::class);
    }

    public function testUpdateTask(): void
    {
        $response = static::createClient()->request('POST', '/api/tasks', ['json' => [
            'name' => 'drink a coffee',
        ]]);

        $client = static::createClient();
        $iri = $this->findIriBy(Task::class, ['name' => 'drink a coffee']);

        $client->request('PUT', $iri, ['json' => [
            'name' => 'drink two coffees',
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@id' => $iri,
            'name' => 'drink two coffees',
            'status' => '/api/statuses/1'
        ]);
    }

    public function testDeleteTask(): void
    {
        $response = static::createClient()->request('POST', '/api/tasks', ['json' => [
            'name' => 'drink a coffee',
        ]]);

        $client = static::createClient();
        $iri = $this->findIriBy(Task::class, ['name' => 'drink a coffee']);

        $client->request('DELETE', $iri);

        $this->assertResponseStatusCodeSame(204);
        $this->assertNull(
            // Through the container, you can access all your services from the tests, including the ORM, the mailer, remote API clients...
            static::getContainer()->get('doctrine')->getRepository(Task::class)->findOneBy(['name' => 'drink a coffee'])
        );
    }
}
