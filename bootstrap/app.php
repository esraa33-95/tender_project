<?php

use App\Http\Middleware\api_localization;
use App\Http\Middleware\IsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
         using: function () {
           
                 Route::namespace('App\Http\Controllers\Api')
                 ->prefix('api/admin')
                 ->group(base_path('routes/Api/admin.php'));

                   Route::namespace('App\Http\Controllers\Api')
                    ->prefix('api/client')
                    ->group(base_path('routes/Api/client.php'));
  
                  Route::namespace('App\Http\Controllers')
                 ->prefix('api/auth')
                 ->group(base_path('routes/api.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
        'api_localization' => api_localization::class,
        'IsAdmin'=> IsAdmin::class,
         
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
