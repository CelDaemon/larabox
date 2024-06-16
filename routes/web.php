<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::delete('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::singleton('user', UserController::class)->destroyable()->except('edit')->middleware('auth');
Route::patch('/user/email', [UserController::class, 'updateEmail'])->middleware('auth')->name('user.update.email');

Route::get('/verify', [EmailVerificationController::class, 'index'])->middleware('auth')->name('verification.notice');
Route::post('/verify', [EmailVerificationController::class, 'send'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
require __DIR__.'/beta.php';
require __DIR__.'/admin.php';
require __DIR__.'/debug.php';
