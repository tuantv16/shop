<?php

use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\DemoController;
use App\Http\Controllers\Web\MainController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ShopController;
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


//Route::middleware(['customer-login'])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('main.index');

    Route::get('/{slug?}-{product?}.html', [ProductController::class, 'index'])
    ->where('slug', '[\w\s\-_\/]+')
    ->where('product', '[\w\s\-_\/]*[0-9]') // sự khác biệt với các trang khác là param product sẽ kết thúc là 1 chữ số, còn các trang khác là ký tự
    ->name('web.product.index');

    Route::get('/shop.html', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/web-shopping-cart.html', [CartController::class, 'index'])->name('cart.index');
//});

Route::get('/login.html', [CustomerController::class, 'login'])->name('customer.get_login');
Route::get('/register.html', [CustomerController::class, 'register'])->name('customer.get_register');

Route::get('/demo', [DemoController::class, 'demo'])->name('demo.demo');
Route::get('/demo2', [DemoController::class, 'demo2'])->name('demo2.demo2');

