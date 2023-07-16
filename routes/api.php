<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('customers', App\Http\Controllers\CustomerController::class);
Route::apiResource('customer-devices', App\Http\Controllers\CustomerDeviceController::class);
Route::apiResource('customer-notifications', App\Http\Controllers\CustomerNotificationController::class);
