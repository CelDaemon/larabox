<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PlaylistController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::name('verification.')->prefix('/verify')->group(function () {
        Route::get('/', [EmailVerificationController::class, 'notice'])->name('notice');
        Route::post('/', [EmailVerificationController::class, 'send'])->middleware('throttle:6,1')->name('send');
        Route::get('/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verify');
    });
    Route::get('/library', LibraryController::class)->name('library');

    Route::view('/settings', 'settings')->name('settings');

    Route::name('playlists.')->prefix('/playlists')->group(function() {
        Route::get('/create', [PlaylistController::class, 'create'])->name('create');
        Route::post('/', [PlaylistController::class, 'store'])->name('store');
        Route::get('/{playlist}', [PlaylistController::class, 'show'])->middleware('can:view,playlist')->withoutMiddleware('auth')->name('show');
        Route::middleware('can:update,playlist')->group(function () {
            Route::patch('/{playlist}', [PlaylistController::class, 'update'])->name('update');
            Route::get('/{playlist}/edit', [PlaylistController::class, 'edit'])->name('edit');
        });
        Route::delete('/{playlist}', [PlaylistController::class, 'destroy'])->middleware('can:delete,playlist')->name('destroy');
    });
});
