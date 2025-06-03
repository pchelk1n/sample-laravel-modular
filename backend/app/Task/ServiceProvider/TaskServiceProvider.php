<?php

namespace App\Task\ServiceProvider;

use App\Task\Domain\TaskRepository;
use Illuminate\Support\ServiceProvider;

final class TaskServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // sample
        $this->app->singleton(TaskRepository::class);
    }
}
