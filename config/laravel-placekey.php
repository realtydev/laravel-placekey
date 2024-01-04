<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Placekey API Key
    |--------------------------------------------------------------------------
    |
    | This value is the API key provided by Placekey. It is used when making
    | requests to the Placekey API. You can get your API key from the Placekey
    | dashboard after creating an account.
    |
    */

    'api_key' => env('PLACEKEY_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Placekey API URL
    |--------------------------------------------------------------------------
    |
    | This value is the base URL for the Placekey API. It is used when making
    | requests to the Placekey API. You should not need to change this value.
    |
    */

    'api_url' => 'https://api.placekey.io',

    /*
    |--------------------------------------------------------------------------
    | Placekey API Version
    |--------------------------------------------------------------------------
    |
    | This value is the version of the Placekey API that the package will use.
    | It is used when making requests to the Placekey API. You should not need
    | to change this value.
    |
    */

    'api_version' => 'v1',

    /*
    |--------------------------------------------------------------------------
    | Connect Timeout
    |--------------------------------------------------------------------------
    |
    | This value is the connection timeout (in seconds) passed to the
    | underlying HTTP client for making requests to the Placekey API.
    |
    */
    // 'connect_timeout' => '5',

    /*
    |--------------------------------------------------------------------------
    | Read Timeout
    |--------------------------------------------------------------------------
    |
    | This value is the read timeout (in seconds) passed to the
    | underlying HTTP client for making requests to the Placekey API.
    |
    */
    // 'read_timeout' => '5',

];
