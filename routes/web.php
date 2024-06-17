<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');



Route::apiResource('users', UserController::class)->only(['store', 'update', 'destroy']);
Route::post('/login', [AuthenticationController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');

Route::view('/settings', 'settings')->middleware('auth')->name('settings');
Route::view('/register', 'auth.register')->name('auth.register');
Route::view('/login', 'auth.login')->name('auth.login');


require __DIR__.'/debug.php';
