<?php

use App\Http\Controllers\Api\Backend\BrandController;
use App\Http\Controllers\Api\Backend\CategoryController;
use App\Http\Controllers\Api\Backend\FeedbackController;
use App\Http\Controllers\Api\Backend\ProductControler;
use App\Http\Controllers\Api\Backend\ProductDetailController;
use App\Http\Controllers\Api\Web\CustomerController;
use App\Http\Controllers\Api\Web\ShopController;
use App\Http\Controllers\Api\Web\TestController;
use App\Http\Resources\ProductDetails\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('backend')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);

    Route::resource('products', ProductControler::class);
    Route::post('products/update-product', [ProductControler::class,'updateProduct'])->name('product.update');

    Route::prefix('product-details')->group(function () {
        Route::post('save-multi-rows', [ProductDetailController::class,'saveMultiRows'])->name('product_details.save_rows');
    });

    Route::prefix('feedbacks')->group(function () {
        Route::post('setting', [FeedbackController::class,'setting'])->name('feedbacks.settings');
    });
});

Route::prefix('webs')->group(function () {
    Route::get('shop/get-list-products', [ShopController::class, 'getListProducts'])->name('product_detail.get_list_products');
    Route::post('/login', [CustomerController::class, 'login'])->name('customer.post_login');
    Route::post('/register', [CustomerController::class, 'register'])->name('customer.post_register');
    Route::get('/logout', [CustomerController::class, 'logout'])->name('customer.logout');
    Route::get('/test', [TestController::class, 'test'])->name('test.test');

});


