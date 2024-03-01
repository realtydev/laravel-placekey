<?php

namespace Realtydev\LaravelPlacekey;

use Realtydev\LaravelPlacekey\Services\PlacekeyService;

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
        try {
            $result = $this->placekeyService->getPlacekeyForAddress($street, $city, $region, $postal_code, $countryCode);
        } catch (\TypeError $e) {
            throw new \InvalidArgumentException('Invalid arguments provided. Please ensure you provide a street address, city, region, postal code, and country code.');
        }

        return $result;
    }

    public function getPlacekeysForAddresses($addresses)
    {
        return $this->placekeyService->getPlacekeysForAddresses($addresses);
    }

    public function getCurrentActivePlacekeyAndPredecessors($placekeys)
    {
        return $this->placekeyService->getCurrentActivePlacekeyAndPredecessors($placekeys);
    }
}
