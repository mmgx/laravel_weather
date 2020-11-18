<?php

use App\Http\Controllers\Backend\Geo\CityController;
use App\Http\Controllers\Backend\User\UserController;
use App\Http\Controllers\QueryController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group([
    'prefix' => 'admin',
    'as' => 'admin.auth.user.',
    'middleware' => 'auth:sanctum',
], function () {

    /**
     * Управление пользователями
     */
    Route::group([
        'prefix' => 'users',
    ], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::delete('/', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('create', [UserController::class, 'create'])->name('create');
    });

    Route::group(['prefix' => 'users/{user}'], function () {
        Route::get('show', [UserController::class, 'show'])->name('show');
        Route::get('edit', [UserController::class, 'edit'])->name('edit');
        Route::patch('/', [UserController::class, 'update'])->name('update');
        Route::delete('/delete', [UserController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'users/{deletedUser}'], function () {
        Route::patch('restore', [UserController::class, 'restore'])->name('restore');
        Route::delete('destroy', [UserController::class, 'destroy'])->name('destroy');
    });
});

/**
 * Просмотр информации о погоде в городах
 */

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth:sanctum',
], function () {

    Route::group([
        'prefix' => 'cities',
        'as' => 'geo.cities.',
    ], function () {

        Route::get('/', [CityController::class, 'index'])->name('index');

        Route::group(['prefix' => '{city}'], function () {
            Route::get('show', [CityController::class, 'show'])->name('show');
            Route::get('history', [CityController::class, 'history'])->name('history');
        });

        Route::group([
            'middleware' => 'isAdmin',
        ], function () {
            Route::get('update', function () {
                Artisan::call('weather:all');
                return redirect()->route('admin.geo.cities.index',)->withFlashSuccess(__('Информация о погоде обновлена'));
            })->name('update');
        });
    });
});

/**
 * Тестовые маршруты получения погоды без проверки токена
 */
Route::group([
], function () {
    Route::group([
        'prefix' => 'test/weather',
    ], function () {
        Route::get('city/{city}/current', [QueryController::class ,'current']);
        Route::get('city/{city}/all', [QueryController::class ,'all']);
    });
});
