<?php

namespace App\Infrastructure\ServiceProviders;

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
            if (\in_array($moduleDir, ['.', '..'], true)) {
                continue;
            }

            $pathTemplate = \sprintf('app/%s/ServiceProviders/*.php', $moduleDir);

            foreach (glob(base_path($pathTemplate)) as $providerFile) {
                $providerFileName = pathinfo($providerFile, PATHINFO_FILENAME);
                $classProvider = \sprintf('App\\%s\\ServiceProviders\\%s', $moduleDir, $providerFileName);
                if (self::class !== $classProvider && class_exists($classProvider)) {
                    $this->app->register($classProvider);
                }
            }
        }
    }
}
