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
            ->publishesServiceProvider('PlacekeyService')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command->publishConfigFile()->copyAndRegisterServiceProviderInApp();
            });

    }

    public function packageRegistered()
    {
        $this->app->bind('Realtydev\LaravelPlacekey', function ($app) {
            return new LaravelPlacekey();
        });
        $this->app->singleton('placekey', function ($app) {
            $config = $app['config']['placekey']; // Access the 'placekey' configuration

            return new PlacekeyService($config);
        });
    }
}
