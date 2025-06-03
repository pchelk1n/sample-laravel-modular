<?php

namespace App\Infrastructure\ServiceProvider;

use Illuminate\Support\ServiceProvider;

final class ServiceProviderLoader extends ServiceProvider
{
    /**
     * Register all service providers.
     */
    public function register(): void
    {
        $moduleDirs = scandir(app_path());

        foreach ($moduleDirs as $moduleDir) {
            if (in_array($moduleDir, ['.', '..'])) {
                continue;
            }

            $pathTemplate = sprintf("app/%s/ServiceProvider/*.php", $moduleDir);

            foreach (glob(base_path($pathTemplate)) as $providerFile) {
                $providerFileName = pathinfo($providerFile, PATHINFO_FILENAME);
                $classProvider = sprintf("App\\%s\\ServiceProvider\\%s", $moduleDir, $providerFileName);
                if (self::class !== $classProvider && class_exists($classProvider)) {
                    $this->app->register($classProvider);
                }
            }
        }
    }
}
