<?php

use App\Domains\Auth\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});
