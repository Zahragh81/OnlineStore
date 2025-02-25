<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\membership\ProductBalanceController;
use App\Http\Controllers\membership\ProductController;
use App\Http\Controllers\membership\ProductGroupTypeController;
use App\Http\Controllers\membership\ProductNatureAttributeController;
use App\Http\Controllers\membership\ProductNatureController;
use App\Http\Controllers\membership\StoreController;
use App\Http\Controllers\membership\StoreTypeController;
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

        // ProductGroupType
        Route::prefix('/productGroupType')->controller(ProductGroupTypeController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{productGroupType}', 'show');
            Route::put('/update/{productGroupType}', 'update');
            Route::delete('/destroy/{productGroupType}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // StoreType
        Route::prefix('/storeType')->controller(StoreTypeController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{storeType}', 'show');
            Route::put('/update/{storeType}', 'update');
            Route::delete('/destroy/{storeType}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // ProductNatureAttribute
        Route::prefix('/productNatureAttribute')->controller(ProductNatureAttributeController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{productNatureAttribute}', 'show');
            Route::put('/update/{productNatureAttribute}', 'update');
            Route::delete('/destroy/{productNatureAttribute}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // ProductNature
        Route::prefix('/productNature')->controller(ProductNatureController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{productNature}', 'show');
            Route::put('/update/{productNature}', 'update');
            Route::delete('/destroy/{productNature}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // Product
        Route::prefix('/product')->controller(ProductController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{product}', 'show');
            Route::put('/update/{product}', 'update');
            Route::delete('/destroy/{product}', 'destroy');
            Route::get('/productNatureAttribute', 'productNatureAttribute');
            Route::get('/product', 'product');
            Route::get('/productDetail/{product}', 'productDetail');
            Route::get('/upsertData', 'upsertData');
        });

        // ProductBalance
        Route::prefix('/productBalance')->controller(ProductBalanceController::class)->group(function (){
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{productBalance}', 'show');
            Route::put('/update/{productBalance}', 'update');
            Route::delete('/destroy/{productBalance}', 'destroy');
            Route::get('/product', 'product');
            Route::get('/storeType', 'storeType');
            Route::get('/productBalance', 'productNatureAttribute');
            Route::get('/productNatureAttributesNonAdminPanel', 'productNatureAttributesNonAdminPanel');
            Route::get('/productBalanceAttribute', 'productBalanceAttribute');
        });
    });

});


