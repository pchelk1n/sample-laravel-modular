<?php

declare(strict_types=1);

namespace App\Task\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @internal
 */
final class CreateTaskActionTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccess(): void
    {
        $response = $this->postJson('/api/tasks', [
            'title' => $expectedTitle = 'Task 1',
            'description' => $expectedDescription = 'Task 1 description',
        ]);

        $response->assertCreated();

        self::assertSame($expectedTitle, $response['data']['title']);
        self::assertSame($expectedDescription, $response['data']['description']);
        self::assertFalse($response['data']['isCompleted']);
        self::assertNull($response['data']['completedAt']);
    }

    public function testSuccessWithEmptyDescription(): void
    {
        $response = $this->postJson('/api/tasks', [
            'title' => $expectedTitle = 'Task 1',
        ]);

        $response->assertCreated();

        self::assertSame($expectedTitle, $response['data']['title']);
        self::assertNull($response['data']['description']);
        self::assertFalse($response['data']['isCompleted']);
        self::assertNull($response['data']['completedAt']);
    }

    #[DataProvider('invalidBody')]
    public function testUnprocessable(array $body): void
    {
        $response = $this->postJson('/api/tasks', $body);

        $response->assertUnprocessable();
    }

    public static function invalidBody(): Iterator
    {
        yield 'empty' => [['']];

        yield 'bad field' => [['badKey']];

        yield 'empty title' => [['title' => '']];
    }
}
