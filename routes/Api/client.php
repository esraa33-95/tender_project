<?php


use App\Http\Controllers\Api\front\ProjectController;
use App\Http\Controllers\Api\front\MaterialController;
use App\Http\Controllers\Api\front\RoomController;
use App\Http\Controllers\Api\front\AdditionController;
use App\Http\Controllers\Api\front\AuthController;
use App\Http\Controllers\Api\front\BidController;
use App\Http\Controllers\Api\front\RoomZoneController;
use App\Http\Controllers\Api\front\RatingController;
use Illuminate\Support\Facades\Route;


//register
Route::post('register',[AuthController::class,'register']);

//login
Route::post('login',[AuthController::class,'login']);


//projects
Route::middleware(['api_localization'])->group(function () {
     Route::prefix('projects')->controller(ProjectController::class)->group(function () {
        Route::post('/', 'store');
        Route::post('/submit/{id}', 'submit');
        Route::get('/bids/{id}', 'bids');
        Route::get('/contact/{id}', 'contact');
        Route::post('/complete/{id}', 'complete');
        Route::post('/cancel/{id}', 'cancel');
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::get('/pendingprojects', 'pendingprojects');
        Route::get('/show/{id}', 'showpending');

    });
 });

 //projectrooms
Route::middleware(['api_localization'])->group(function () {
     Route::prefix('projectrooms')->controller(RoomController::class)->group(function () {
        Route::post('/', 'store');
       
    });
 });


 //materials
 Route::middleware(['api_localization'])->group(function () {
     Route::prefix('materials')->controller(MaterialController::class)->group(function () {
        Route::post('/{id}', 'store');
         Route::get('/{id}', 'show');
      
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
        Route::post('/{id}', 'changebids');   
    });
 });


 //rate
 Route::middleware(['api_localization'])->group(function () {
     Route::prefix('rates')->controller(RatingController::class)->group(function () {
        Route::post('/{id}', 'ratecontractor');   
    });
 });




