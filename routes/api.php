<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\PlaylistController;
use App\Http\Middleware\CheckApiKey;

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
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('api-keys', [ApiKeyController::class, 'index']);
    Route::post('api-keys', [ApiKeyController::class, 'store']);
    Route::delete('api-keys/{apiKey}', [ApiKeyController::class, 'destroy']);
});



Route::middleware([CheckApiKey::class])->group(function () {
    Route::get('playlists', [PlaylistController::class, 'index']);
});