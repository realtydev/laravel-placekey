<?php

namespace Realtydev\LaravelPlacekey\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class LaravelPlacekeyInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'placekey:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the Placekey API integration';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Setting up Placekey API integration...');

        $apiKey = $this->ask('What is your Placekey API key?');
        Config::set('laravel-placekey.api_key', $apiKey);

        $this->info('Placekey API key has been set.');

        $this->info('Publishing Placekey configuration...');
        $this->call('vendor:publish', ['--provider' => 'Realtydev\LaravelPlacekey\PlacekeyServiceProvider', '--tag' => 'config']);

        $this->info('Placekey configuration has been published.');

        $this->info('Running migrations...');
        $this->call('migrate');

        $this->info('Migrations have been run.');

        $this->info('Placekey API integration has been set up.');

        return 0;
    }
}
