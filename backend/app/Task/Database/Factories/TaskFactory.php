<?php

declare(strict_types=1);

namespace App\Task\Database\Factories;

use App\Task\Domain\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
final class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $isCompleted = fake()->boolean();
        $completedAt = $isCompleted ? now()->addMinutes(fake()->randomDigit()) : null;

        return [
            'title' => fake()->realText(),
            'is_completed' => $isCompleted,
            'completed_at' => $completedAt,
        ];
    }
}
