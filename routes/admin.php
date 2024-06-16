<?php

use App\Http\Controllers\Admin\BetaController;
use Illuminate\Support\Facades\Route;

Route::middleware('can:admin')->prefix('/admin')->group(function () {
    Route::get('/beta', [BetaController::class, 'index'])->name('admin.beta.index');
    Route::patch('/beta/{user}', [BetaController::class, 'update'])->name('admin.beta.update');
});
