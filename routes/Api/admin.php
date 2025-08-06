<?php


use App\Http\Controllers\Api\Admin\ProjectController;
use App\Http\Controllers\Api\Admin\RoomController;
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

//project
Route::middleware(['api_localization'])->group(function () {

     Route::prefix('projects')->controller(ProjectController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
 });


//rooms
Route::middleware(['api_localization'])->group(function () {

     Route::prefix('rooms')->controller(RoomController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });

});


// Route::middleware(['api_localization'])->group(function () {

//      Route::prefix('materials')->controller(::class)->group(function () {
//         Route::get('/', 'index');
//         Route::post('/', 'store');
//         Route::get('/{id}', 'show');
//         Route::put('/{id}', 'update');
//         Route::delete('/{id}', 'delete');
//     });

// });