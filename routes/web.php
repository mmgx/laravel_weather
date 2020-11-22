<?php

use App\Http\Controllers\Backend\Geo\CityController;
use App\Http\Controllers\Backend\User\UserController;
use App\Http\Controllers\QueryController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group([
    'prefix' => 'admin',
    'as' => 'admin.user.',
    'middleware' => 'auth:sanctum',
], function () {

    /**
     * Управление пользователями
     */
    Route::group([
        'prefix' => 'users',
    ], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');

        Route::group(['prefix' => '{user}'], function () {
            Route::get('show', [UserController::class, 'show'])->name('show');
            Route::get('edit', [UserController::class, 'edit'])->name('edit');
            Route::patch('/', [UserController::class, 'update'])->name('update');
        });

        Route::group(['middleware' => 'isAdmin'], function () {
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');

            Route::group(['prefix' => '{deletedUser}'], function () {
                Route::patch('restore', [UserController::class, 'restore'])->name('restore');
                Route::delete('destroy', [UserController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => '{user}'], function () {
                Route::delete('/delete', [UserController::class, 'delete'])->name('delete');
            });
        });
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
                Session::flash('toast_success', __('Погода успешно обновлена'));
                return redirect()->route('admin.geo.cities.index',);
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
        Route::get('city/{city}/current', [QueryController::class ,'current'])->name('test.weather.current');
        Route::get('city/{city}/all', [QueryController::class ,'all'])->name('test.weather.all');
    });
});
