<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DiscoveryController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/library', LibraryController::class)->middleware('auth')->name('library');
Route::get('/discovery', DiscoveryController::class)->middleware('auth')->name('discovery');
Route::view('/settings', 'settings')->middleware('auth')->name('settings');
Route::view('/register', 'auth.register')->name('register');
Route::view('/login', 'auth.login')->name('login');

Route::resource('users', UserController::class)->only(['store', 'update', 'destroy']);
Route::patch('/users/{user}/password', [UserController::class, 'updatePassword'])->name('users.update-password');

Route::name('verification.')->prefix('/verify')->middleware('auth')->group(function () {
    Route::get('/', [EmailVerificationController::class, 'notice'])->name('notice');
    Route::post('/', [EmailVerificationController::class, 'send'])->middleware('throttle:6,1')->name('send');
    Route::get('/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verify');
});

Route::name('password.')->prefix('/reset')->middleware('guest')->group(function () {
    Route::get('/', [PasswordResetController::class, 'request'])->name('request');
    Route::post('/', [PasswordResetController::class, 'email'])->name('email');
    Route::get('/{token}', [PasswordResetController::class, 'reset'])->name('reset');
    Route::post('/{token}', [PasswordResetController::class, 'update'])->name('update');
});
Route::singleton('session', AuthenticatedSessionController::class)->creatable()->only(['store', 'destroy']);

Route::get('/playlists/select', [PlaylistController::class, 'select'])->middleware('auth')->name('playlists.select');
Route::post('/playlists/select', [PlaylistController::class, 'prepare'])->middleware('auth')->name('playlists.prepare');
Route::post('/playlists/{playlist}/songs', [PlaylistController::class, 'add'])->middleware(['auth', 'can:update,playlist'])->name('playlists.add');
Route::delete('/playlists/{playlist}/songs/{song}', [PlaylistController::class, 'remove'])->middleware(['auth', 'can:update,playlist'])->name('playlists.remove');
Route::resource('playlists', PlaylistController::class)->except('index');
//Route::name('playlists.songs.')->prefix('/playlists/{playlist}/songs/')->middleware(['auth', 'can:update,playlist'])->group(function () {
//    Route::post('/', [SongController::class, 'store'])->name('store');
//    Route::delete('/{song}', [SongController::class, 'destroy'])->name('destroy');
//});



require __DIR__.'/debug.php';
