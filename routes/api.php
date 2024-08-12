<?php

use App\Http\Controllers\Api\MQTTController;
use App\Http\Controllers\Web\MedisController;
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


Route::prefix('mqtt')->group(function () {
    Route::post('record', [MQTTController::class, 'recordStore'])->middleware('throttle:12000,1')->name('mqtt.record.store');
});
 
