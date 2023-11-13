<?php

namespace Realtydev\LaravelPlacekey;

class LaravelPlacekey
{

    protected $placekeyService;

    public function __construct(PlacekeyService $placekeyService)
    {
        $this->placekeyService = $placekeyService;
    }


    public function getPlacekeyForCoordinates($latitude, $longitude, $queryId = null)
    {
        return $this->placekeyService->getPlacekeyForCoordinates($latitude, $longitude, $queryId);
    }

    public function getPlacekeyForAddress($street, $city, $region, $postal_code, $countryCode)
    {
        return $this->placekeyService->getPlacekeyForAddress($street, $city, $region, $postal_code, $countryCode);
    }

    public function getCurrentActivePlacekeyAndPredecessors($placekeys)
    {
        return $this->placekeyService->getCurrentActivePlacekeyAndPredecessors($placekeys);
    }
}
