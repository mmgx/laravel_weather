<?php

use App\Http\Controllers\Backend\User\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group([
    'prefix' => 'admin',
    'as' => 'admin.auth.user.',
], function () {

    /**
     * Пользователи
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
