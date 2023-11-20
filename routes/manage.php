<?php

use App\Http\Controllers\Manage\CategoryController;
use App\Http\Controllers\Manage\DashboardController;
use App\Http\Controllers\Manage\ProductController;
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
    Route::resource('products', ProductController::class);

    Route::resource('categories', CategoryController::class);
});

