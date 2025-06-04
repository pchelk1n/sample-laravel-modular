<?php

declare(strict_types=1);

namespace App\Task\Http\CreateTask;

use App\Task\Domain\Task;
use Illuminate\Http\Resources\Json\JsonResource;

final readonly class CreateTaskAction
{
    public function __construct(
    ) {}

    public function __invoke(CreateTaskRequest $createTaskRequest): JsonResource
    {
        $task = Task::create($createTaskRequest->validated());

        $task->refresh();

        return new TaskResource($task);
    }
}
