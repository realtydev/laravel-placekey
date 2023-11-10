<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Placekey API Key
    |--------------------------------------------------------------------------
    |
    | This value is your Placekey API key. This value is used when making
    | HTTP requests to the Placekey API. You must set this in your
    | environment file or in the Placekey service configuration.
    |
    */

    'api_key' => env('PLACEKEY_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Placekey API Base URI
    |--------------------------------------------------------------------------
    |
    | This value is the base URI for the Placekey API. This value is used when
    | making HTTP requests to the Placekey API. You can modify this in your
    | environment file or in the Placekey service configuration.
    |
    */

    'base_uri' => env('PLACEKEY_BASE_URI', 'https://api.placekey.io/v1/'),

    /*
    |--------------------------------------------------------------------------
    | Placekey API Endpoints
    |--------------------------------------------------------------------------
    |
    | These values are the endpoints for the Placekey API. These values are used
    | when making HTTP requests to the Placekey API. You can modify these in your
    | environment file or in the Placekey service configuration.
    |
    */

    'endpoints' => [
        'placekey_lookup' => 'placekey',
        'lineage' => 'lineage',
        'batch_lookup' => 'placekey/batch',
        'resolve' => 'resolve',
        'reverse_geocode' => 'reverse',
    ],

];
