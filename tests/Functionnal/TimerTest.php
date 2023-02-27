<?php

declare(strict_types=1);

namespace App\Tests\Functionnal;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class TimerTest extends ApiTestCase
{
    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        shell_exec('php bin/console app:load:fixtures');
    }

    public function testCreateTimerForTask(): void
    {
        $response = static::createClient()->request('POST', '/api/tasks', ['json' => [
            'name' => 'drink a coffee',
        ]]);
        $this->assertResponseStatusCodeSame(201);
        $id = $response->toArray()['@id'];

        $response = static::createClient()->request('POST', '/api/timers', ['json' => [
            'task' => $id,
        ]]);

        $this->assertJsonContains([
            '@context' => '/api/contexts/Timer',
        ]);
        $this->assertMatchesRegularExpression('~^/api/timers/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesRegularExpression('~^((?:(\d{4}-\d{2}-\d{2})T(\d{2}:\d{2}:\d{2}(?:\.\d+)?))(Z|[\+-]\d{2}:\d{2})?)$~', $response->toArray()['startedAt']);
        $this->assertArrayNotHasKey('endedAt', $response->toArray());
    }

    public function testStopTimerForTask(): void
    {
        $response = static::createClient()->request('POST', '/api/tasks', ['json' => [
            'name' => 'drink a coffee',
        ]]);
        $this->assertResponseStatusCodeSame(201);
        $id = $response->toArray()['@id'];

        $response = static::createClient()->request('POST', '/api/timers', ['json' => [
            'task' => $id,
        ]]);

        $timerId = $response->toArray()['id'];
        $endedAt = new \DateTime('now');
        $response = static::createClient()->request('PUT', '/api/timers/'.$timerId, ['json' => [
            'task' => $id,
            'endedAt' => $endedAt->format('c')
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'endedAt' => $endedAt->format('c'),
        ]);
    }
}
