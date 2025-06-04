<?php

declare(strict_types=1);

use App\Task\Http\CreateTask\CreateTaskAction;
use App\Task\Http\TaskList\TaskListAction;

Route::prefix('/tasks')->group(static function (): void {
    Route::get('/', TaskListAction::class);
    Route::post('/', CreateTaskAction::class);
});
