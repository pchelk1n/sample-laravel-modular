<?php

declare(strict_types=1);

namespace App\Task\Http\CreateTask;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $task = $this->resource;

        return [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'isCompleted' => $task->is_completed,
            'completedAt' => $task->completed_at,
        ];
    }
}
