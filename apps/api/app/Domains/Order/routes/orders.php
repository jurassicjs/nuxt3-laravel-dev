<?php

use App\Domains\Order\Http\Controllers\OrderActionController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/order')->group(function () {
    Route::any('/server-boss/{id}/{action}', OrderActionController::class);
});
