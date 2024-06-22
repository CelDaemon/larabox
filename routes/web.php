<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');



Route::resource('users', UserController::class)->only(['store', 'update', 'destroy']);
Route::post('/users/{user}', [UserController::class, 'updatePassword'])->name('users.update-password');

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

Route::resource('playlists', PlaylistController::class)->except('index');

Route::get('/library', LibraryController::class)->middleware(['auth', 'can:admin'])->name('library');
Route::view('/settings', 'settings')->middleware('auth')->name('settings');
Route::view('/register', 'auth.register')->name('register');
Route::view('/login', 'auth.login')->name('login');

require __DIR__.'/debug.php';
