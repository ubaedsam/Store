<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

// Proses menampilkan semua data
Route::get('/productss',[ProductController::class,'index']);

// Proses tambah data
Route::post('/add-product',[ProductController::class,'addProduct'])->name('product.add');

// Proses mengambil data untuk diubah
Route::get('/productss/{id}',[ProductController::class,'getProductById']);

// Proses menyimpan data yang sudah diubah
Route::put('/productss',[ProductController::class,'updateProduct'])->name('product.update');

// Proses menghapus data
Route::delete('/productss/{id}',[ProductController::class,'deleteProduct']);
