<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::middleware('auth:api')->get('/user', function(Request $request) {
//     return $request->user();
// });
Route::get('/login',[UserController::class,'getLogin'])->name('login');
Route::post('/login',[UserController::class,'postLogin'])->name('postLogin');


Route::middleware('auth')->group(function () {
    Route::get('/home', function() {
        return view('home');
    })->name('home');
    Route::prefix('user')->group(function(){
        Route::get('/', 'App\Http\Controllers\Admin\UserController@getUser')->name('list-user');
    });

    Route::prefix('products')->group(function(){
        Route::get('/',[ProductController::class, 'index'])->name('products');
    });
    Route::get('/create-product',[ProductController::class, 'getCreate'])->name('get-AddProduct');
    Route::post('/create-product',[ProductController::class, 'postAddProduct'])->name('post-AddProduct');
    Route::get('/product/{id}',[ProductController::class, 'show'])->name('get-product');
    Route::get('/product/edit/{id}',[ProductController::class, 'edit'])->name('edit-product');
    Route::post('/product/edit/{id}',[ProductController::class, 'postEdit'])->name('post-editProduct');

});
