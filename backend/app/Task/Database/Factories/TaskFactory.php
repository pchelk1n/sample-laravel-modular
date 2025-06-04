<?php

namespace App\Task\Database\Factories;

use App\Task\Domain\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

final class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $isCompleted = $this->faker->boolean();
        $completedAt = $isCompleted ? now()->addMinutes($this->faker->randomDigit()) : null;

        return [
            'title' => $this->faker->realText(),
            'is_completed' => $isCompleted,
            'completed_at' => $completedAt,
        ];
    }
}
