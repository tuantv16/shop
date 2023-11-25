<?php

use App\Http\Controllers\Manage\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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


Route::get('/test-s3', function () {
     // Kiểm tra sự tồn tại của file trong local storage
     $exists = Storage::disk('public')->exists('testfile_tuantv2.txt');
     //url

     if ($exists) {

        echo "File exists in public storage.";
    } else {

        echo "File does not exist in public storage.";
    }


     if (!$exists) {

         // Nếu file không tồn tại, tạo nó
         Storage::disk('public')->put('testfile_tuantv.txt', 'This is a test file');
     }

     // Sau đó, tải file từ local lên S3
     if (!Storage::disk('s3')->exists('testfile_tuantv.txt')) {


         Storage::disk('s3')->put('testfile_tuantv.txt', Storage::disk('public')->get('testfile_tuantv.txt'));
         return 'File was uploaded to S3';
     }

     dd(111);
     return 'File already exists on S3';
});
