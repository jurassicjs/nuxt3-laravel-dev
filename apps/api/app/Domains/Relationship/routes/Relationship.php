<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api/relationship')->group(function () {
       Route::get('/', function(){
           return 'test';
       });
});
