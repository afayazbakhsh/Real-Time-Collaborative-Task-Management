<?php

use App\Http\Controllers\Projects\CreateProjectController;
use App\Http\Controllers\Projects\IndexProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('projects')->group(function () {
    Route::get('/', IndexProjectController::class);
    Route::post('/create', CreateProjectController::class);
});
