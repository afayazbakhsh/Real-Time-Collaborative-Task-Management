<?php

use App\Http\Controllers\Projects\CreateProjectController;
use App\Http\Controllers\Projects\IndexProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('projects')
    ->middleware('auth:api')
    ->name('projects.')
    ->group(function () {
    Route::get('/', IndexProjectController::class)->name('index');
    Route::post('/', CreateProjectController::class)->name('create');
});
