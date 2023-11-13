<?php

namespace Realtydev\LaravelPlacekey\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Realtydev\LaravelPlacekey\Exceptions\PlacekeyApiException;

class PlacekeyService
{
    protected static $client;

    protected $config;

    public function __construct($config)
    {
        if (! isset($config['api_url'], $config['api_version'], $config['api_key'])) {
            throw new \InvalidArgumentException('Config data is missing or incomplete');
        }
        $this->config = $config;

        if (self::$client === null) {
            self::$client = new Client([
                'base_uri' => $this->config['api_url'].'/'.$this->config['api_version'].'/',
                'headers' => [
                    'apikey' => $this->config['api_key'],
                    'Content-Type' => 'application/json',
                ],
            ]);
        }
    }

    public function getPlacekeyForCoordinates($latitude, $longitude, $queryId = null)
    {
        if ($latitude === null || $longitude === null) {
            throw new \InvalidArgumentException('Latitude and longitude are required');
        }

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
        if ($streetAddress === null || $city === null || $region === null || $postalCode === null) {
            throw new \InvalidArgumentException('Street address, city, region, and postal code are required');
        }
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
            $response = self::$client->post($endpoint, [
                'json' => $body,
                'http_errors' => false, // or true depends on how you want to handle http exceptions.
            ]);

            if ($response->getStatusCode() >= 400) {
                throw new PlacekeyApiException($response->getReasonPhrase(), $response->getStatusCode());
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new PlacekeyApiException($e->getMessage(), $e->getCode());
        }
    }
}
