<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');

});

Route::prefix('auth')->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

});

