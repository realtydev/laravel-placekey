<?php

namespace Realtydev\LaravelPlacekey;

use Realtydev\LaravelPlacekey\Services\PlacekeyService;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPlacekeyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-placekey')
            ->hasConfigFile()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('realtydev/laravel-placekey');
            });

    }

    public function packageRegistered()
    {
        $this->app->singleton(PlacekeyService::class, function ($app) {
            $config = $app['config']->get('placekey');

            return new PlacekeyService($config);
        });
    }
}
