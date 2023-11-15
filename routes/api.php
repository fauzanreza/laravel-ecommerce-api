<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CartItemsController;
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

//These routes are NOT protected using middleware

Route::prefix('v1')->group(function () {
    Route::post('login', [UserAuthenticationController::class, 'login']);
    Route::post('register', [UserAuthenticationController::class, 'register']);
});


//These routes are protected using middleware
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::post('logout', [UserAuthenticationController::class, 'logout']);
    Route::apiResource('products', ProductsController::class);
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('carts', CartsController::class);
    Route::apiResource('cart_items', CartItemsController::class);
});