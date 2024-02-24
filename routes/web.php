<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;
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

Route::get('/', [HomeController::class, 'index']);
Route::resource('/jenis', JenisController::class);
Route::delete('/jenis/hapus/{jenis_id}', [JenisController::class, 'hapusJenis'])->name('jenis.hapus');


Route::resource('/kategori', KategoriController::class);
Route::resource('/menu', MenuController::class);
Route::resource('/stok', StokController::class);
Route::resource('/pelanggan', PelangganController::class);
Route::resource('/transaksi', TransaksiController::class);
Route::resource('/detail_transaksi', DetailTransaksiController::class);
Route::resource('/meja', MejaController::class);
Route::resource('/pemesanan', PemesananController::class);
// Route::resource('/checkout', CheckoutController::class);