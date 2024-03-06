<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //TODO fix user if needed
    return $request->user();

    /* Sessions */
    Route::post('/sessions/start',  [SessionsController::class, 'start']);
    Route::post('/sessions/stop',   [SessionsController::class, 'stop']);
    Route::get('/sessions/history', [SessionsController::class, 'history']);

    /* Settings */
    Route::put('/settings', [SettingsController::class, 'update']);
});
