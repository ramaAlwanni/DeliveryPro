<?php

use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


//Routes for customers:
Route::post('/register' , [AuthController::class , 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::get('/showProducts/{store_id}', [ProductController::class, 'showStoreProduct']);
// Route::get('/showProductDetails/{product_id}', [ProductController::class, 'showProductDetails']);


//search product & stores
Route::get('search/product', [ProductController::class, 'productSearch']);
Route::get('search/store', [StoreController::class, 'storeSearch']);

//Reset password
Route::post('Password/forget', [AuthController::class, 'forgetPassword']);
Route::post('Password/verifyOtp', [AuthController::class, 'verifyOtp']);
Route::post('Password/resetPassword', [AuthController::class, 'resetPassword']);

Route::post('/createStore', [StoreController::class, 'createStore']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::patch('/Profile', [ProfileController::class, 'updateUserProfile']);


    Route::get('/showAllStores', [StoreController::class, 'showAllStores']);
});

