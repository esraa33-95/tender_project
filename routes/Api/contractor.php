<?php

use App\Http\Controllers\Api\front\BidController;
use Illuminate\Support\Facades\Route;



//bids
Route::middleware(['api_localization'])->group(function () {
     Route::prefix('bids')->controller(BidController::class)->group(function () {
        Route::post('/', 'store');
       
    });
 });

