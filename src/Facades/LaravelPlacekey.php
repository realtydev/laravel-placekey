<?php

namespace Realtydev\LaravelPlacekey\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Realtydev\LaravelPlacekey\LaravelPlacekey
 */
class LaravelPlacekey extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Realtydev\LaravelPlacekey\LaravelPlacekey::class;
    }
}
