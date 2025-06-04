<?php

namespace App\Task\Database\Seeders;

use App\Task\Database\Factories\TaskFactory;
use Illuminate\Database\Seeder;

final class TaskSeeder extends Seeder
{
    public function run(): void
    {
        TaskFactory::new()->count(10)->create();
    }
}
