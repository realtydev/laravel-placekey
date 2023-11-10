<?php

namespace Realtydev\LaravelPlacekey;

use Realtydev\LaravelPlacekey\Services\PlacekeyService;

class LaravelPlacekey
{
    protected $service;

    public function __construct(PlacekeyService $service)
    {
        $this->service = $service;
    }

    // Add methods to interact with the service
}
