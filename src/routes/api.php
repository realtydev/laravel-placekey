<?php

use Illuminate\Support\Facades\Route;
use Realtydev\LaravelPlacekey\Controllers\PlacekeyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'placekey'], function () {
    Route::post('/coordinates', [PlacekeyController::class, 'getPlacekeyForCoordinates']);
    Route::post('/custom-query', [PlacekeyController::class, 'getPlacekeyWithCustomQuery']);
    Route::post('/address', [PlacekeyController::class, 'getPlacekeyForAddress']);
    Route::post('/lineage', [PlacekeyController::class, 'getActivePlacekeyAndPredecessors']);
});
