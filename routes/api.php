<?php


use App\Http\Controllers\Api\front\AuthController;
use App\Http\Controllers\Api\front\ListController;
use Illuminate\Support\Facades\Route;


// Route::middleware('api_localization')->controller(AuthController::class)->group(function () {
//     Route::post('register','register');
//     Route::post('login','login');
//     Route::post('sendotp','sendotp');
//     Route::post('verify-email','verifyEmailOtp');
//     Route::post('reset-password','resetpassword');
    
//     Route::middleware('auth:sanctum')->group(function () {
//         Route::post('logout', 'logout');
//     });
 
// });


Route::middleware('api_localization')->controller(ListController::class)->middleware('auth:sanctum')->group(function () {   
        Route::get('projecttypes', 'projecttypes');
        Route::get('materials', 'materials');
        Route::get('additiontypes', 'additiontypes');
         Route::get('projects', 'projects');
        
});