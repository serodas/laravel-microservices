<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\ScopeAmbassadorMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('ambassador')->group(function () {
    Route::post('register', [AuthController::class, 'register'])
        ->name('register');
    Route::post('login', [AuthController::class, 'login'])
        ->name('login');
    Route::middleware(ScopeAmbassadorMiddleware::class)->group(function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::put('users/info', [AuthController::class, 'updateInfo']);
        Route::put('users/password', [AuthController::class, 'updatePassword']);
    });
});
