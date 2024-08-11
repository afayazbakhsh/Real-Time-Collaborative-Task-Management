<?php

use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Projects\CreateProjectController;
use Illuminate\Support\Facades\Route;

Route::post('/register', UserRegisterController::class);

Route::prefix('projects')->group(function () {
    Route::post('/create', CreateProjectController::class);
});
