<?php

use Illuminate\Support\Facades\Route;

Route::view("/", "welcome")->withoutMiddleware("csp");
Route::view('/signup', "signup")->name("signup");
Route::view('/login', "login")->name("login");
