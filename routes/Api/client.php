<?php


use App\Http\Controllers\Api\front\ProjectController;
use App\Http\Controllers\Api\front\MaterialController;
use App\Http\Controllers\Api\front\RoomZoneController;
use Illuminate\Support\Facades\Route;





//projects
Route::middleware(['api_localization'])->group(function () {
     Route::prefix('project')->controller(ProjectController::class)->group(function () {
        Route::post('/', 'store');
    });
 });

 //projectrooms
Route::middleware(['api_localization'])->group(function () {
     Route::prefix('projectrooms')->controller(RoomZoneController::class)->group(function () {
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