<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');


Route::get("/register", [UserController::class, "register"])->name('register');
Route::post("/register", [UserController::class, "store"]);
Route::get("/login", [AuthenticationController::class, "login"])->name("login");
Route::post("/login", [AuthenticationController::class, "store"]);
Route::post("/logout", [AuthenticationController::class, "destroy"])->name("logout");

require __DIR__.'/debug.php';
