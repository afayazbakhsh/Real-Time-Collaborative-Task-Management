<?php

use App\Http\Controllers\Tasks\CreateTaskController;
use App\Http\Controllers\Tasks\IndexTaskController;
use App\Http\Controllers\Tasks\UpdateTaskController;

Route::post('/', CreateTaskController::class)->name('create-task');
Route::patch('/{task}', UpdateTaskController::class);
Route::get('/', IndexTaskController::class);
