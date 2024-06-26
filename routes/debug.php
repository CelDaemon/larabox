<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

if(!App::hasDebugModeEnabled()) return;

Route::prefix('/debug')->group(function () {
    Route::get('info', function () {
        phpinfo();
    });
    Route::get('routes', function () {
        dd(Route::getRoutes());
    });
    Route::get('middleware', function () {
        dd(Route::getMiddleware());
    });
    Route::get('session', function () {
        dd(Session::all());
    });
});
