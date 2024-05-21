<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PlaylistController;
use Illuminate\Support\Facades\Route;

Route::view("/", "welcome")->withoutMiddleware("csp")->name("welcome");
Route::get('/register', [RegisterController::class, "create"])->name("register");
Route::post("/register", [RegisterController::class, "store"]);
Route::get('/login', [AuthenticatedSessionController::class, "create"])->name("login");
Route::post("/login", [AuthenticatedSessionController::class, "store"]);
Route::post("/logout", [AuthenticatedSessionController::class, "destroy"])->name("logout");
Route::resource("playlist", PlaylistController::class);
include "debug.php";
