<?php

namespace Realtydev\LaravelPlacekey;

use Realtydev\LaravelPlacekey\Commands\LaravelPlacekeyCommand;
use Realtydev\LaravelPlacekey\Commands\LaravelPlacekeyInstallCommand;
use Realtydev\LaravelPlacekey\Services\PlacekeyService;
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
            ->hasCommands([LaravelPlacekeyInstallCommand::class, LaravelPlacekeyCommand::class]);

    }

    public function packageRegistered()
    {
        $this->app->singleton('placekey', function ($app) {
            $config = $app['config']->get('placekey'); // Assuming you have a placekey.php config file
            return new PlacekeyService($config);
        });
    }
}
