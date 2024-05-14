<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view("/", "welcome")->withoutMiddleware("csp");
Route::get('/register', [UserController::class, "create"])->name("register");
Route::view('/login', "login")->name("login");
