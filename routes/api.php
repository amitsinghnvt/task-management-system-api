<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;

Route::post('/register', [
    AuthController::class,
    'register'
])->middleware('throttle:auth');

Route::post('/login', [
    AuthController::class,
    'login'
])->middleware('throttle:auth');

Route::middleware('auth:sanctum')
    ->group(function () {

        Route::post('/logout', [
            AuthController::class,
            'logout'
        ]);

        Route::apiResource(
            'tasks',
            TaskController::class
        );
    });