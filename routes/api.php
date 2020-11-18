<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\QueryController;

Route::group([
    'middleware' => 'api',
], function () {
    Route::post('auth', [AuthController::class ,'login']);
    Route::post('logout', [AuthController::class ,'logout']);
    Route::post('refresh', [AuthController::class ,'refresh']);
    Route::post('me', [AuthController::class ,'me']);
    Route::post('registration', [AuthController::class, 'registration']);

    Route::group([
        'prefix' => 'users',
    ], function () {
        Route::get('{user}', [UserController::class ,'show']);
        Route::get('/', [UserController::class ,'index']);
    });
});

/**
 * Auth api
 */
Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::group([
        'prefix' => 'weather',
    ], function () {
        Route::get('city/{city}/current', [QueryController::class ,'current']);
        Route::get('city/{city}/all', [QueryController::class ,'all']);
    });
});
