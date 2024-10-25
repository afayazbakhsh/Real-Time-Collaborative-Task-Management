<?php

use App\Http\Controllers\Projects\CreateProjectController;
use App\Http\Controllers\Projects\IndexProjectController;
use App\Http\Controllers\Tasks\CreateTaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('projects')
    ->middleware('auth:api')
    ->group(function () {
        Route::get('/', IndexProjectController::class)->name('index');
        Route::post('/', CreateProjectController::class)->name('create');

        Route::prefix('/{project}/tasks')->group(function () {
            Route::post('/', CreateTaskController::class);
        });
    })->name('projects.');
