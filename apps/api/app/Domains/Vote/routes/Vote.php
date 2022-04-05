<?php

use Illuminate\Support\Facades\Route;

Route::prefix('vote')->group(function () {
       Route::get('/', function(){
           return 'test';
       });
});
