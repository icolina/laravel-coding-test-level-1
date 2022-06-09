<?php

use App\Http\Controllers\Api\v1\EventController;
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

Route::group(['prefix' => 'v1', 'excluded_middleware' => ['auth'],], function () {
    Route::prefix('events')->name('api.')->group(function () {
        Route::get('/active-events', [EventController::class, 'activeEvents'])->name('events.active-events');
    });
    Route::apiResource('events', EventController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
