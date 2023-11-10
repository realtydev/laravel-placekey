<?php

namespace Realtydev\LaravelPlacekey\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Realtydev\LaravelPlacekey\Exceptions\PlacekeyApiException;

class PlacekeyService
{
    protected $client;

    protected $config;

    public function __construct()
    {

        $this->client = new Client([
            'base_uri' => 'https://api.placekey.io/v1/',
            'headers' => [
                'apikey' => config('placekey.api_key'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getPlacekeyForCoordinates($latitude, $longitude, $queryId = null)
    {
        $query = [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];

        if ($queryId) {
            $query['query_id'] = $queryId;
        }

        return $this->sendRequest('placekey', [
            'query' => $query,
        ]);
    }

    public function getPlacekeyForAddress($streetAddress, $city, $region, $postalCode, $countryCode)
    {
        $query = [
            'street_address' => $streetAddress,
            'city' => $city,
            'region' => $region,
            'postal_code' => $postalCode,
            'iso_country_code' => $countryCode ?? 'US',
        ];

        return $this->sendRequest('placekey', [
            'query' => $query,
        ]);
    }

    public function getCurrentActivePlacekeyAndPredecessors($placekeys)
    {

        return $this->sendRequest('lineage', [
            'queries' => $placekeys,
        ]);
    }

    protected function sendRequest($endpoint, $body)
    {
        try {
            $response = $this->client->post($endpoint, [
                'json' => $body,
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new PlacekeyApiException($e->getMessage(), $e->getCode());
        }
    }
}
