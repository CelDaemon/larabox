<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

if(!App::isLocal()) return;

Route::get("/urls", function () {
    dd(Route::getRoutes());
});
