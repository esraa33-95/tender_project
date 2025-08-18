<?php

use App\Http\Controllers\Api\front\AuthController;
use App\Http\Controllers\Api\front\BidController;
use Illuminate\Support\Facades\Route;


//register
Route::post('register',[AuthController::class,'register']);


//login
Route::post('login',[AuthController::class,'login']);

//bids
Route::middleware(['api_localization'])->group(function () {
     Route::prefix('bids')->controller(BidController::class)->group(function () {
        Route::post('/', 'store');
       
    });
 });

