<?php

declare(strict_types=1);

namespace App\Task\Tests\Feature;

use App\Task\Database\Factories\TaskFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

/**
 * @internal
 */
final class TaskListActionTest extends TestCase
{
    use RefreshDatabase;

    public function testList(): void
    {
        TaskFactory::new()->count(10)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertOk();

        self::assertCount(10, $response['data']);
    }
}
