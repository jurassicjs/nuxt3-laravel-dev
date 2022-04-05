<?php

use App\Domains\Vote\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/votes')->group(function () {
    Route::get('/', [VoteController::class, 'getCount']);

});
