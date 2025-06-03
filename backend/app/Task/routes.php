<?php

declare(strict_types=1);

use App\Task\Http\TaskList\TaskListAction;

Route::get('/tasks', TaskListAction::class);
