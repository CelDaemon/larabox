<?php

use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => ["auth", "can:beta"]], function () {
    Route::get("/song", [SongController::class, "index"])->name("song.index");
    Route::post("/song/test", [SongController::class, "test"])->name("song.test");
});
