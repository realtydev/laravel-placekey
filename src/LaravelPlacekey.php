<?php

namespace Realtydev\LaravelPlacekey;

use Realtydev\LaravelPlacekey\Services\PlacekeyService;

class LaravelPlacekey
{
    protected $service;

    public function __construct()
    {
        $this->service = app(PlacekeyService::class);
    }

    // Add methods to interact with the service
}
