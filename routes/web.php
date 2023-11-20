<?php

use App\Http\Controllers\Manage\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});



// Route::prefix('manage')->group(function () {
//     //Route::resource('dashboard', DashboardController::class);
//     Route::get('dashboard', [DashboardController::class, 'index']);
// });
