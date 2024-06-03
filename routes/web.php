<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');
require __DIR__.'/debug.php';
