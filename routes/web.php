<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return view("main");
});
Route::get("/test", function (Request $request) {
    return view("test");
});
