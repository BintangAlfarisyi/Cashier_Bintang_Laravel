<?php

use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegsitrasiController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
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

// login
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login/cek', [UserController::class, 'cekLogin'])->name('cekLogin');

// Registrasi
Route::get('/registrasi', [UserController::class, 'registrasi'])->name('registrasi');
Route::post('/registrasi', [UserController::class, 'register']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/tentang', [TentangController::class, 'index']);

    // Export Import
    Route::get('export/menu', [MenuController::class, 'generateexcel'])->name('exportExcelMenu');
    Route::get('generate/menu', [MenuController::class, 'generatePdf'])->name('exportPdfMenu');
    Route::get('export/jenis', [JenisController::class, 'generateexcel'])->name('exportExcelJenis');
    Route::get('generate/jenis', [JenisController::class, 'generatepdf'])->name('exportPdfJenis');
    Route::get('export/produk', [ProdukController::class, 'generateexcel'])->name('exportExcelProduk');
    Route::get('generate/produk', [ProdukController::class, 'generatepdf'])->name('exportPdfProduk');

    // Import
    Route::post('jenis/import', [JenisController::class, 'importData'])->name('importJenis');
    Route::post('menu/import', [MenuController::class, 'importData'])->name('importMenu');
    Route::post('produk/import', [ProdukController::class, 'importData'])->name('importProduk');

    // logout
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    //admin
    Route::group(['middleware' => ['cekUserLogin:1']], function () {
        // Route Page
        Route::resource('/jenis', JenisController::class);
        Route::resource('/kategori', KategoriController::class);
        Route::resource('/menu', MenuController::class);
        Route::resource('/stok', StokController::class);
        Route::resource('/pelanggan', PelangganController::class);
        Route::resource('/transaksi', TransaksiController::class);
        Route::resource('/detail_transaksi', DetailTransaksiController::class);
        Route::resource('/meja', MejaController::class);
        Route::resource('/produk', ProdukController::class);
    });
    // kasir
    Route::group(['middleware' => ['cekUserLogin:2']], function () {
        Route::resource('/pemesanan', PemesananController::class);
        Route::post('/pemesanan-transaksi', [TransaksiController::class, 'makeTransaksi'])->name('pemesanan-transaksi');

        // Nota Faktur
        Route::get('nota/{nofaktur}', [TransaksiController::class, 'faktur']);
    });
});
