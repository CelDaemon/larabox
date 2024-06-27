<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DiscoveryController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');


Route::name('users.')->prefix('/users')->group(function() {
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::group(['middleware' => 'can:update,user'], function () {
        Route::patch('/{user}', [UserController::class, 'update'])->name('update');
        Route::patch('/{user}/password', [UserController::class, 'updatePassword'])->name('update-password');
    });
    Route::delete('/{user}', [UserController::class, 'destroy'])->middleware('can:delete,user')->name('destroy');
});
Route::name('password.')->prefix('/reset')->middleware('guest')->group(function() {
    Route::get('/', [PasswordResetController::class, 'request'])->name('request');
    Route::post('/', [PasswordResetController::class, 'email'])->name('email');
    Route::get('/{token}', [PasswordResetController::class, 'reset'])->name('reset');
    Route::post('/{token}', [PasswordResetController::class, 'update'])->name('update');
});
Route::name('session.')->prefix('/session')->group(function() {
    Route::post('/', [AuthenticatedSessionController::class, 'store'])->name('store');
    Route::delete('/', [AuthenticatedSessionController::class, 'destroy'])->name('destroy');
});
Route::name('queue.')->prefix('/queue')->group(function() {
    Route::get('/', [QueueController::class, 'show'])->name('show');
    Route::post('/', [QueueController::class, 'store'])->name('store');
    Route::delete('/', [QueueController::class, 'destroy'])->name('destroy');
});
Route::view('/register', 'auth.register')->name('register');
Route::view('/login', 'auth.login')->name('login');
Route::get('/discovery', DiscoveryController::class)->name('discovery');

require __DIR__ . '/auth.php';
require __DIR__ . '/debug.php';
