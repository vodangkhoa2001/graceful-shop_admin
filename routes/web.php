<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\Admin\VoucherController;
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
    Route::get('/home',[UserController::class,'statistic'])->name('home');
    Route::prefix('user')->group(function(){
        Route::get('/', 'App\Http\Controllers\Admin\UserController@getUsers')->name('list-user');
        Route::get('/create-account', [UserController::class,'getCreateAccount'])->name('get-CreateAccount');
        Route::post('/create-account', [UserController::class,'postCreateAccount'])->name('post-CreateAccount');
        Route::get('/edit-account/{id}', [UserController::class,'getEditUser'])->name('get-EditUser');
        Route::post('/edit-account/{id}', [UserController::class,'postEditUser'])->name('post-EditUser');
    });

    Route::prefix('products')->group(function(){
        Route::get('/',[ProductController::class, 'index'])->name('products');
        Route::get('/create-product',[ProductController::class, 'getCreate'])->name('get-AddProduct');
        Route::post('/create-product',[ProductController::class, 'postCreate'])->name('post-AddProduct');
        Route::get('/product/{id}',[ProductController::class, 'show'])->name('get-product');
        Route::get('/product/edit/{id}',[ProductController::class, 'edit'])->name('edit-product');
        Route::post('/product/edit/{id}',[ProductController::class, 'postEdit'])->name('post-editProduct');
    });

    Route::prefix('category')->group(function () {
        Route::get('/',[CategoryController::class, 'index'])->name('list-category');
        Route::get('/create-category',[CategoryController::class,'getCreate'])->name('get-CreateCategory');
        Route::post('/create-category',[CategoryController::class,'postCreate'])->name('post-CreateCategory');
        Route::get('/edit-category/{id}',[CategoryController::class,'getEdit'])->name('get-EditCategory');
        Route::post('/edit-category/{id}',[CategoryController::class,'postEdit'])->name('post-EditCategory');
    });

    Route::prefix('product-type')->group(function () {
        Route::get('/',[ProductTypeController::class, 'index'])->name('list-productType');
        Route::get('/create',[ProductTypeController::class,'getCreate'])->name('get-CreateProductType');
        Route::post('/create',[ProductTypeController::class,'postCreate'])->name('post-CreateProductType');
        Route::get('/edit/{id}',[ProductTypeController::class,'getEdit'])->name('get-EditProductType');
        Route::post('/edit/{id}',[ProductTypeController::class,'postEdit'])->name('post-EditProductType');
    });

    Route::prefix('invoices')->group(function () {
        Route::get('/',[InvoiceController::class, 'index'])->name('list-invoice');
        Route::get('/edit/{id}',[InvoiceController::class,'getEdit'])->name('get-EditInvoice');
        Route::post('/edit/{id}',[InvoiceController::class,'postEdit'])->name('post-EditInvoice');
    });

    Route::prefix('brands')->group(function () {
        Route::get('/',[BrandController::class, 'index'])->name('list-brand');
        Route::get('/{id}/detail',[BrandController::class, 'show'])->name('detail-brand');
        Route::get('/create',[BrandController::class,'getCreate'])->name('get-CreateBrand');
        Route::post('/create',[BrandController::class,'postCreate'])->name('post-CreateBrand');
        Route::get('/edit/{id}',[BrandController::class,'getEdit'])->name('get-EditBrand');
        Route::post('/edit/{id}',[BrandController::class,'postEdit'])->name('post-EditBrand');
        // Route::get('/{id}/delete',[BrandController::class,'destroy'])->name('delete-brand');
    });

    Route::prefix('voucher')->group(function () {
        Route::get('/',[VoucherController::class,'index'])->name('list-voucher');
        Route::get('/{id}/detail',[VoucherController::class,'show'])->name('detail-voucher');
        Route::get('/create',[VoucherController::class,'getCreate'])->name('get-CreateVoucher');
        Route::post('/create',[VoucherController::class,'postCreate'])->name('post-CreateVoucher');
        Route::get('{id}/edit',[VoucherController::class,'getEdit'])->name('get-EditVoucher');
        Route::post('{id}/edit',[VoucherController::class,'postEdit'])->name('post-EditVoucher');
    });
});
