<?php

namespace App\Task\Http\TaskList;


use App\Task\Domain\TaskRepository;
use Illuminate\Http\Resources\Json\JsonResource;

final readonly class TaskListAction
{
    public function __construct(
        private TaskRepository $taskRepository,
    ) {}

    public function __invoke(): JsonResource
    {
        $tasks = $this->taskRepository->findAll();

        return TaskResource::collection($tasks);
    }
}
