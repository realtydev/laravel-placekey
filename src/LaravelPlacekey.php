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

    public function getPlacekeyForAddress($street, $city, $region, $postal_code, $countryCode)
    {
        return $this->service->getPlacekeyForAddress($street, $city, $region, $postal_code, $countryCode);
    }
}
