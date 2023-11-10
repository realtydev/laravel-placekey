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

    public function getPlacekeyForCoordinates($latitude, $longitude, $queryId = null)
    {
        return $this->service->getPlacekeyForCoordinates($latitude, $longitude, $queryId);
    }
    public function getPlacekeyForAddress($street, $city, $region, $postal_code, $countryCode)
    {
        return $this->service->getPlacekeyForAddress($street, $city, $region, $postal_code, $countryCode);
    }
    public function getCurrentActivePlacekeyAndPredecessors($placekeys)
    {
        return $this->service->getCurrentActivePlacekeyAndPredecessors($placekeys);
    }
}
