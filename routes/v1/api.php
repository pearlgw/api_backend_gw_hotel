<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BedroomController;
use App\Http\Controllers\Api\BedroomImageController;
use App\Http\Controllers\Api\CategoryBedroomController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'api'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:api')->group(function () {
        Route::middleware('can:manage users')->group(function () {
            Route::apiResource('users', UserController::class);
        });
        Route::middleware('can:manage category')->group(function () {
            Route::apiResource('category-bedrooms', CategoryBedroomController::class);
        });
        Route::middleware('can:manage bedrooms')->group(function () {
            Route::apiResource('bedrooms', BedroomController::class);
            Route::apiResource('bedrooms-images', BedroomImageController::class);
        });
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
});
