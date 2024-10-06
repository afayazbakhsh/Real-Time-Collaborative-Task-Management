<?php

use App\Http\Controllers\Projects\CreateProjectController;
use App\Http\Controllers\Projects\IndexProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('projects')->middleware('auth:api')->group(function () {
    Route::get('/', IndexProjectController::class);
    Route::post('/', CreateProjectController::class);
});
