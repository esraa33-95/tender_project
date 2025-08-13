<?php


use App\Http\Controllers\Api\front\ProjectController;
use App\Http\Controllers\Api\front\MaterialController;
use App\Http\Controllers\Api\front\RoomController;
use App\Http\Controllers\Api\front\AdditionController;
use App\Http\Controllers\Api\front\BidController;
use App\Http\Controllers\Api\front\RoomZoneController;
use Illuminate\Support\Facades\Route;





//projects
Route::middleware(['api_localization'])->group(function () {
     Route::prefix('projects')->controller(ProjectController::class)->group(function () {
        Route::post('/', 'store');
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/submit/{id}', 'submit');
        Route::post('/cancel/{id}', 'cancel');
        Route::post('/complete/{id}', 'complete');
        Route::get('/', 'pendingprojects');
         Route::get('/{id}', 'showpending');

    });
 });

 //projectrooms
Route::middleware(['api_localization'])->group(function () {
     Route::prefix('projectrooms')->controller(RoomController::class)->group(function () {
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
 });


 //materials
 Route::middleware(['api_localization'])->group(function () {
     Route::prefix('materials')->controller(MaterialController::class)->group(function () {
        Route::post('/{id}', 'store');
      
    });
 });



 //additions
 Route::middleware(['api_localization'])->group(function () {
     Route::prefix('additions')->controller(AdditionController::class)->group(function () {
        Route::post('/{id}', 'store');
      
    });
 });


 //roomzone
 Route::middleware(['api_localization'])->group(function () {
     Route::prefix('roomzones')->controller(RoomZoneController::class)->group(function () {
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
      
    });
 });

//bids
Route::middleware(['api_localization'])->group(function () {
     Route::prefix('bids')->controller(BidController::class)->group(function () {
        Route::post('/', 'store');
        Route::get('/{id}', 'bids');
        Route::post('/{id}', 'changebids');
      
    });
 });
