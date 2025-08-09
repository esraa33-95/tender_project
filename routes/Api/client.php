<?php


use App\Http\Controllers\Api\Admin\ProjectController;
use Illuminate\Support\Facades\Route;





//projects
Route::middleware(['api_localization'])->group(function () {
     Route::prefix('project')->controller(ProjectController::class)->group(function () {
        Route::post('/', 'store');
    });
 });

