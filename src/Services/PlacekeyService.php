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

    public function setApiKey($api_key)
    {
        self::$client = new Client([
            'base_uri' => $this->config['api_url'].'/'.$this->config['api_version'].'/',
            'headers' => [
                'apikey' => $api_key,
                'Content-Type' => 'application/json',
            ],
        ]);

        return $this;
    }

    public function getPlacekey($placekey)
    {
        $key = is_array($placekey) ? 'queries' : 'query';

        return $this->sendRequest('placekey', [$key => $placekey]);
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
            'options' => ['fields' => ['building_placekey', 'address_placekey']]

        ]);
    }

    public function getPlacekeysForAddresses($addresses)
    {
        // ensure that the addresses have street_address, city, region, postal_code, iso_country_code, and unique id
        foreach ($addresses as $address) {
            if (! isset($address['street_address'], $address['city'], $address['region'], $address['postal_code'], $address['iso_country_code'], $address['query_id'])) {
                throw new \InvalidArgumentException('Street address, city, region, postal code, iso country code, and query id are required');
            }
        }

        return $this->sendRequest('placekeys', [
            'queries' => $addresses,
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
            $params = [
                'json' => $body,
                'http_errors' => false, // or true depends on how you want to handle http exceptions.
            ];

            if (isset($this->config['connect_timeout'])) {
                $params['connect_timeout'] = $this->config['connect_timeout'];
            }
            if (isset($this->config['read_timeout'])) {
                $params['read_timeout'] = $this->config['read_timeout'];
            }

            $response = self::$client->post($endpoint, $params);

            if ($response->getStatusCode() >= 400) {
                throw new PlacekeyApiException($response->getReasonPhrase(), $response->getStatusCode());
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new PlacekeyApiException($e->getMessage(), $e->getCode());
        }
    }
}
