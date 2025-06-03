<?php

namespace App\Infrastructure\ServiceProvider;

use Illuminate\Support\ServiceProvider;

final class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Register all migrations.
     */
    public function boot(): void
    {
        foreach (glob(base_path('app/*/Database/Migration/*.php')) as $migrationFile) {
            $this->loadMigrationsFrom($migrationFile);
        }
    }
}
