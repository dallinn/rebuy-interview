<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SettingsController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/signup', [AuthController::class, 'signup']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    /* Sessions */
    Route::post('/sessions/start',  [SessionsController::class, 'start']);
    Route::post('/sessions/stop',   [SessionsController::class, 'stop']);
    Route::get('/sessions/history', [SessionsController::class, 'history']);

    /* Settings */
    Route::put('/settings', [SettingsController::class, 'update']);
});