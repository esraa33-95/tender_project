<?php

use App\Http\Controllers\Api\Admin\MaterialController;
use App\Http\Controllers\Api\Admin\AdditionController;
use App\Http\Controllers\Api\Admin\AdditionTypeController;
use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\admin\ProjectTypeController;
use App\Http\Controllers\Api\admin\RoomZoneController;
use Illuminate\Support\Facades\Route;



//register
Route::post('/register',[AdminController::class,'register']);

//login
Route::post('/login',[AdminController::class,'login']);

Route::middleware(['auth:sanctum','api_localization','IsAdmin'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::post('/', 'logout');
    });
});

//projecttype
Route::middleware(['api_localization'])->group(function () {

     Route::prefix('projects')->controller(ProjectTypeController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
 });


//rooms
Route::middleware(['api_localization'])->group(function () {

     Route::prefix('rooms')->controller(RoomZoneController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });

});

//materials
Route::middleware(['api_localization'])->group(function () {

     Route::prefix('materials')->controller(MaterialController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });

});


//addition
Route::middleware(['api_localization'])->group(function () {

     Route::prefix('additions')->controller(AdditionController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });

});
//addition types
Route::middleware(['api_localization'])->group(function () {

     Route::prefix('additiontypes')->controller(AdditionTypeController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });

});