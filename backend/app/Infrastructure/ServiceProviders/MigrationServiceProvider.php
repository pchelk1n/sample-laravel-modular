<?php

namespace App\Infrastructure\ServiceProviders;

use Illuminate\Support\ServiceProvider;

final class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Register all migrations.
     */
    public function boot(): void
    {
        foreach (glob(base_path('app/*/Database/Migrations/*.php')) as $migrationFile) {
            $this->loadMigrationsFrom($migrationFile);
        }
    }
}
