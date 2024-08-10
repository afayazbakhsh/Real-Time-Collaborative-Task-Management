<?php

use App\Http\Controllers\Auth\UserRegisterController;
use Illuminate\Support\Facades\Route;


Route::post(UserRegisterController::class, '/register');
