<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\membership\StoreController;
use App\Http\Controllers\membership\UserController;
use Illuminate\Support\Facades\Route;


// Auth
Route::prefix('/auth')->controller(AuthController::class)->group(function () {
    Route::post('/sendCode', 'sendCode');
    Route::post('/verifyCode', 'verifyCode');

    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

Route::prefix('/admin')->middleware('auth:sanctum')->group(function () {

    Route::prefix('/membership')->group(function () {

        // User
        Route::prefix('/user')->controller(UserController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{user}', 'show');
            Route::put('/update/{user}', 'update');
            Route::delete('/destroy/{user}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // Store
        Route::prefix('/store')->controller(StoreController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{store}', 'show');
            Route::put('/update/{store}', 'update');
            Route::delete('/destroy/{store}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

    });


});


