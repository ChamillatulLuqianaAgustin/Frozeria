<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;

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

// Redirect halaman utama ke dashboard barang
Route::get('/', function () {
    return redirect()->route('barang.index');
});

// Routes Barang
Route::resource('barang', BarangController::class);

// Routes Kategori (tanpa show)
Route::resource('kategori', KategoriController::class)->except(['show']);

// Route Bantuan
Route::get('/bantuan', function () {
    return view('bantuan');
})->name('bantuan');