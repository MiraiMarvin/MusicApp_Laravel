<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TrackController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiKeyController;

Route::get('/', [TrackController::class, 'index'])->name('tracks.index');
Route::get('/test', [HomeController::class, 'test'])->name('test');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::resource('playlists', PlaylistController::class);

    Route::controller(TrackController::class)
        ->prefix('tracks')
        ->name('tracks.')
        ->middleware([IsAdmin::class])
        ->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{track}', 'show')->name('show');
            Route::get('/{track}/edit', 'edit')->name('edit');
            Route::put('/{track}', 'update')->name('update');
            Route::delete('/{track}', 'destroy')->name('destroy');
    });
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('api-keys', [ApiKeyController::class, 'index'])->name('api-keys.index');
    Route::get('api-keys/create', [ApiKeyController::class, 'create'])->name('api-keys.create');
    Route::post('api-keys', [ApiKeyController::class, 'store'])->name('api-keys.store');
    Route::delete('api-keys/{apiKey}', [ApiKeyController::class, 'destroy'])->name('api-keys.destroy');
});