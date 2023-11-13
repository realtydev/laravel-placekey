<?php

namespace Realtydev\LaravelPlacekey;

use Realtydev\LaravelPlacekey\Commands\LaravelPlacekeyCommand;
use Realtydev\LaravelPlacekey\Commands\LaravelPlacekeyInstallCommand;
use Realtydev\LaravelPlacekey\Services\PlacekeyService;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

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
                    ->startWith(function (InstallCommand $command) {
                        $command->info('Hello, and welcome to my great new package!');
                    })
                    ->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('realtydev/laravel-placekey')
                    ->endWith(function (InstallCommand $command) {
                        $command->info('Have a great day!');
                    });
            });

    }

    public function packageRegistered()
    {
        $this->app->singleton(PlacekeyService::class, function ($app) {
            $config = $app['config']->get('laravel-placekey');

            return new PlacekeyService($config);
        });
    }
}
