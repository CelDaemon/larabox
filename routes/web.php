<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');



Route::resource('users', UserController::class)->only(['store', 'update', 'destroy']);
Route::view('/settings', 'settings')->middleware('auth')->name('settings');

Route::get('/verify', [EmailVerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');
Route::post('/verify', [EmailVerificationController::class, 'send'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/login', [AuthenticationController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');
Route::view('/register', 'auth.register')->name('register');
Route::view('/login', 'auth.login')->name('login');

require __DIR__.'/debug.php';
