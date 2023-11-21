<?php

namespace Realtydev\LaravelPlacekey\Facades;

use Illuminate\Support\Facades\Facade;
use Realtydev\LaravelPlacekey\Services\PlacekeyService;

/**
 * @see \Realtydev\LaravelPlacekey\LaravelPlacekey
 */
class LaravelPlacekey extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Realtydev\LaravelPlacekey\LaravelPlacekey::class;
    }

    public static function setApiKey($api_key)
    {
        return app(PlacekeyService::class)->setApiKey($api_key);
    }
}
