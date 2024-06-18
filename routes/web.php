<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');



Route::resource('users', UserController::class)->only(['store', 'update', 'destroy']);
Route::post('/users/{user}', [UserController::class, 'updatePassword'])->name('users.update.password');
Route::view('/settings', 'settings')->middleware('auth')->name('settings');

Route::get('/verify', [EmailVerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');
Route::post('/verify', [EmailVerificationController::class, 'send'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/reset', [PasswordResetController::class, 'request'])->name('password.request');
Route::post('/reset', [PasswordResetController::class, 'email'])->name('password.email');
Route::get('/reset/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
Route::post('/reset/{token}', [PasswordResetController::class, 'update'])->name('password.update');

Route::post('/login', [AuthenticationController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');
Route::view('/register', 'auth.register')->name('register');
Route::view('/login', 'auth.login')->name('login');

require __DIR__.'/debug.php';
