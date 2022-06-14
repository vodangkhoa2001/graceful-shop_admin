<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\UserController;
use \App\Http\Controllers\Api\ProductController;
use \App\Http\Controllers\Api\CategoryController;
use \App\Http\Controllers\Api\SlideController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Product
Route::post('product-new-view', [ProductController::class, 'getAllNewProduct']);
Route::post('product-popular-view', [ProductController::class, 'getAllPopularProduct']);
Route::get('product-byid/{id}', [ProductController::class, 'getProductDetailById']);
Route::post('product-category-byid/{id}', [ProductController::class, 'getProductByProductCategory']);
Route::post('product-type-byid/{id}', [ProductController::class, 'getProductByProductType']);
Route::post('product-search/{key_search}', [ProductController::class, 'searchProduct']);

//Rate
Route::post('rate-of-product', [ProductController::class, 'getAllRateOfProduct']);

//Category
Route::get('category', [CategoryController::class, 'getAllCategory']);

//Slide
Route::get('slide-show', [SlideController::class, 'getAllSlideShow']);
Route::get('slide-show-detail/{id}', [SlideController::class, 'getAllSlideShowDetail']);

//User
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

//Authorization
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('user-info', [UserController::class, 'info']);
    Route::delete('logout', [UserController::class, 'logout']);
    Route::post('change_pass', [UserController::class, 'changePass']);
    Route::post('like', [ProductController::class, 'likeProduct']);
    Route::get('product-like', [ProductController::class, 'getAllProductLike']);
    Route::post('change-info', [UserController::class, 'changeInfo']);
    Route::post('change-avatar', [UserController::class, 'changeAvatar']);
    Route::post('rate-product', [ProductController::class, 'rateProduct']);
});
