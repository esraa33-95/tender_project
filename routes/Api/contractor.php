<?php

use App\Http\Controllers\Api\front\BidController;
use App\Http\Controllers\Api\front\ProjectController;
use Illuminate\Support\Facades\Route;



//bids
Route::middleware(['api_localization'])->group(function () {
     Route::prefix('bids')->controller(BidController::class)->group(function () {
        Route::post('/', 'store');
       
    });
 });

//contractor
 Route::middleware(['api_localization'])->group(function () {
     Route::prefix('projects')->controller(ProjectController::class)->group(function () {
        Route::post('/changeproject/{id}', 'changeproject');
       
    });
 });