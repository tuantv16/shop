<?php

use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\MainController;
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


Route::get('/', [MainController::class, 'index'])->name('main.index');

Route::get('/shop.html', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shopping-cart.html', [CartController::class, 'index'])->name('cart.index');



Route::get('/login.html', [CustomerController::class, 'login'])->name('customer.get_login');
Route::get('/register.html', [CustomerController::class, 'register'])->name('customer.get_register');

