<?php

use App\Http\Controllers\Manage\BrandController;
use App\Http\Controllers\Manage\CartController;
use App\Http\Controllers\Manage\CategoryController;
use App\Http\Controllers\Manage\CustomerController;
use App\Http\Controllers\Manage\DashboardController;
use App\Http\Controllers\Manage\OrderController;
use App\Http\Controllers\Manage\ProductController;
use App\Http\Controllers\Manage\ProductDetailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('manage')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('products', ProductController::class)->names([
        'index' => 'product.index',
        'create' => 'product.create',
        'store' => 'product.store',
        'show' => 'product.show',
        'edit' => 'product.edit',
        'update' => 'product.update2',
        'destroy' => 'product.destroy',
    ]);

    Route::prefix('product-details')->group(function () {
        Route::resource('product-details', ProductDetailController::class);
        Route::get('/add/{productId}', [ProductDetailController::class, 'createMultiProductDetail'])->name('product_details.create_rows');
    });

    Route::resource('categories', CategoryController::class)->names([
        'index' => 'category.index',
        'create' => 'category.create',
        'store' => 'category.store',
        'show' => 'category.show',
        'edit' => 'category.edit',
        'update' => 'category.update',
        'destroy' => 'category.destroy',
    ]);

    Route::resource('brands', BrandController::class)->names([
        'index' => 'brand.index',
        'create' => 'brand.create',
        'store' => 'brand.store',
        'show' => 'brand.show',
        'edit' => 'brand.edit',
        'update' => 'brand.update',
        'destroy' => 'brand.destroy',
    ]);

    Route::resource('customers', CustomerController::class);
    Route::resource('carts', CartController::class);
    Route::resource('orders', OrderController::class);


});

