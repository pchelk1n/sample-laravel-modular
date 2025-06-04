<?php

namespace App\Infrastructure\ServiceProviders;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class RouterServiceProvider extends ServiceProvider
{
    /**
     * Register all routes.
     */
    public function boot(): void
    {
        foreach (glob(base_path('app/**/routes.php')) as $apiFileRoute) {
            Route::prefix('api')
                ->middleware('api')
                ->group($apiFileRoute);
        }
    }
}
