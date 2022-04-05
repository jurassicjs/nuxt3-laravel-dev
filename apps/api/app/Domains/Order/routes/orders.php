<?php

use App\Domains\Order\Http\Controllers\OrderActionController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/order')->group(function () {
    Route::any('/{id}/{action}', OrderActionController::class);
});
