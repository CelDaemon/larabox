<?php

use Illuminate\Support\Facades\Route;

Route::view("/", "welcome")->withoutMiddleware("csp");
Route::view('/register', "register")->name("register");
Route::view('/login', "login")->name("login");
