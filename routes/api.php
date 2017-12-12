<?php

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
Route::get('/{endpoint}', '\\' . \App\Http\Controllers\API\APIRouteController::class . '@index');
Route::get('/{endpoint}/{id}', '\\' . \App\Http\Controllers\API\APIRouteController::class . '@show');
Route::post('/{endpoint}', '\\' . \App\Http\Controllers\API\APIRouteController::class . '@store');
Route::patch('/{endpoint}/{id}', '\\' . \App\Http\Controllers\API\APIRouteController::class . '@update');
Route::delete('/{endpoint}/{id}', '\\' . \App\Http\Controllers\API\APIRouteController::class . '@destroy');
Route::post('/{endpoint}/bulkPost', '\\' . \App\Http\Controllers\API\APIRouteController::class . '@bulkStore');
Route::post('/{endpoint}/bulkPatch', '\\' . \App\Http\Controllers\API\APIRouteController::class . '@bulkUpdate');
