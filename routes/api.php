<?php

use App\Http\Controllers\Api\Backend\BrandController;
use App\Http\Controllers\Api\Backend\CategoryController;
use App\Http\Controllers\Api\ProductControler;
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

Route::get('/some-endpoint2', [ProductControler::class, 'someEndpoint'])->name('someEndpoint');

Route::prefix('backend')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
});

