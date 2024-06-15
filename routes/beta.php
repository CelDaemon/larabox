<?php

use Illuminate\Support\Facades\Route;

Route::middleware('can:beta')->group(function () {
    Route::get('test', function () {
        return 'Example beta route!';
    });
});
