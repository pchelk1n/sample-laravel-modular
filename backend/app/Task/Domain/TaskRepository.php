<?php

declare(strict_types=1);

namespace App\Task\Domain;

use Illuminate\Database\Eloquent\Collection;

final readonly class TaskRepository
{
    /**
     * @return Collection<int, Task>
     */
    public function findAll(): Collection
    {
        return Task::all();
    }
}
