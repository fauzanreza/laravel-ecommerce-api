<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CartItemsController;
use App\Http\Controllers\OrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

######################### Public Route #########################

Route::prefix('v1')->group(function () {
    Route::post('login', [UserAuthenticationController::class, 'login']);
    Route::post('register', [UserAuthenticationController::class, 'register']);
});

Route::prefix('v1')->group(function () {
    Route::apiResource('products', ProductsController::class);
    Route::apiResource('categories', CategoriesController::class);
});

######################### Private Route #########################
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::post('logout', [UserAuthenticationController::class, 'logout']);
    Route::apiResource('carts', CartsController::class);
    Route::apiResource('cart_items', CartItemsController::class);
    Route::apiResource('orders', OrdersController::class);
});