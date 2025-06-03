<?php

namespace App\Task\Database\Seeder;

use App\Task\Database\Factory\TaskFactory;
use Illuminate\Database\Seeder;

final class TaskSeeder extends Seeder
{
    public function run(): void
    {
        TaskFactory::new()->count(10)->create();
    }
}
