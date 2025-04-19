<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('ambassador')->group(function () {
    Route::post('register', [AuthController::class, 'register'])
        ->name('register');
    Route::post('login', [AuthController::class, 'login'])
        ->name('login');
    Route::get('user', [AuthController::class, 'user']);
});
