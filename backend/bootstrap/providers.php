<?php

use App\Infrastructure\ServiceProvider\MigrationServiceProvider;
use App\Infrastructure\ServiceProvider\RouterServiceProvider;

return [
    RouterServiceProvider::class,
    MigrationServiceProvider::class,
];
