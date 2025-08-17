<?php

use App\Http\Controllers\Api\front\ListController;
use Illuminate\Support\Facades\Route;





Route::middleware('api_localization')->controller(ListController::class)->group(function () {   
        Route::get('projecttypes', 'projecttypes');
        Route::get('roomzones', 'roomzones');
        Route::get('materials', 'materials');
        Route::get('additiontypes', 'additiontypes');
        Route::get('projects', 'projects');

});