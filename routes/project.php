<?php

use App\Http\Controllers\Projects\CreateProjectController;
use App\Http\Controllers\Projects\IndexProjectController;

Route::get('/', IndexProjectController::class)->name('index');
Route::post('/', CreateProjectController::class)->name('create');
