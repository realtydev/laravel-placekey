<?php

namespace Realtydev\LaravelPlacekey\Commands;

use Illuminate\Console\Command;

class LaravelPlacekeyCommand extends Command
{
    public $signature = 'laravel-placekey';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
