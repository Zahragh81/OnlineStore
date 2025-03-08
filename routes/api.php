<?php

use App\Http\Controllers\admin\Membership\ProductController;
use App\Http\Controllers\customer\membership\V1\ProductController as CustomerProductController;
use App\Http\Controllers\admin\Membership\ProductGroupTypeController;
use App\Http\Controllers\admin\Membership\ProductNatureAttributeController;
use App\Http\Controllers\admin\Membership\ProductNatureController;
use App\Http\Controllers\customer\membership\V1\ProductNatureController as CustomerProductNatureController;
use App\Http\Controllers\admin\Membership\StoreController;
use App\Http\Controllers\Customer\Membership\V1\ShoppingCartController;
use App\Http\Controllers\shop\Membership\StoreController as ShopStoreController;
use App\Http\Controllers\customer\membership\V1\StoreController as CustomerStoreController;
use App\Http\Controllers\admin\Membership\StoreTypeController;
use App\Http\Controllers\Customer\Membership\V1\StoreTypeController as CustomerStoreTypeController;
use App\Http\Controllers\admin\Membership\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\shop\Membership\ProductBalanceController;
use App\Http\Controllers\customer\membership\V1\ProductBalanceController as CustomerProductBalanceController;
use Illuminate\Support\Facades\Route;


// Auth
Route::prefix('/auth')->controller(AuthController::class)->group(function () {
    Route::post('/sendCode', 'sendCode');
    Route::post('/verifyCode', 'verifyCode');

    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

// Admin
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
            Route::get('userStores', 'userStores');
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
            Route::get('/upsertData', 'upsertData');
        });

    });

});

// Shop
Route::prefix('/shop')->middleware('auth:sanctum')->group(function () {

    Route::prefix('/membership')->group(function () {
        // store
        Route::get('/store/show/{store}', ShopStoreController::class);

        // ProductBalance
        Route::prefix('/productBalance')->controller(ProductBalanceController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{productBalance}', 'show');
            Route::put('/update/{productBalance}', 'update');
            Route::delete('/destroy/{productBalance}', 'destroy');
            Route::get('/product', 'product');
            Route::get('/storeType', 'storeType');
            Route::get('/productNatureAttribute', 'productNatureAttribute');
            Route::get('/productNatureAttributesNonAdminPanel', 'productNatureAttributesNonAdminPanel');
        });
    });

});

// Customer
Route::prefix('/customer')->middleware('auth:sanctum')->group(function () {

    Route::prefix('/membership')->group(function () {
        Route::prefix('/v1')->group(function () {
            // Store
            Route::get('/store/', CustomerStoreController::class);

            // StoreType
            Route::get('/storeType/', CustomerStoreTypeController::class);

            // ProductNature
            Route::get('/productNature/', CustomerProductNatureController::class);

            // Product
            Route::prefix('/product')->controller(CustomerProductController::class)->group(function () {
                Route::get('/', 'index');
//                Route::get('/productDetail/{product}', 'productDetail');
                Route::get('/productDetail', 'productDetail');
            });

            // ProductBalance
            Route::get('/productBalance/', CustomerProductBalanceController::class);

            // ShoppingCart
            Route::prefix('/shoppingCart')->controller(ShoppingCartController::class)->group(function (){
                Route::get('/', 'index');
                Route::post('/insertUpdate', 'insertUpdate');
                Route::get('/finalPrice', 'finalPrice');
                Route::delete('/destroy/{shoppingCart}', 'destroy');
            });

        });

    });
});


