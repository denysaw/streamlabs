<?php

use App\Http\Controllers\OAuthController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/user/events', [UserController::class, 'events']);
    Route::get('/user/stats', [UserController::class, 'stats']);
});

Route::middleware('oauth.providers')->group(function () {
    Route::get('/login/{provider}', [OAuthController::class, 'redirectToProvider']);
    Route::get('/login/{provider}/callback', [OAuthController::class, 'handleProviderCallback']);
});
