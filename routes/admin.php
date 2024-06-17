<?php

use App\Http\Controllers\Admin\BetaController;
use Illuminate\Support\Facades\Route;

Route::middleware('can:admin')->prefix('/admin')->group(function () {
    Route::get('/beta', BetaController::class)->name('admin.beta');
});
