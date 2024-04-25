<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\RegsitrasiController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Jenis;
use App\Models\Karyawan;
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
Route::get('/registrasi', [RegistrasiController::class, 'registrasi'])->name('registrasi');
Route::post('/registrasi', [RegistrasiController::class, 'register']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/tentang', [TentangController::class, 'index']);
    Route::get('/contact', [ContactController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'tampil']);
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/change-password', [ProfileCOntroller::class, 'changePassword']);

    // Export
    Route::get('export/kategori', [KategoriController::class, 'generateexcel'])->name('exportExcelKategori');
    Route::get('generate/kategori', [KategoriController::class, 'generatepdf'])->name('exportPdfKategori');
    Route::get('export/jenis', [JenisController::class, 'generateexcel'])->name('exportExcelJenis');
    Route::get('generate/jenis', [JenisController::class, 'generatepdf'])->name('exportPdfJenis');
    Route::get('export/menu', [MenuController::class, 'generateexcel'])->name('exportExcelMenu');
    Route::get('generate/menu', [MenuController::class, 'generatePdf'])->name('exportPdfMenu');
    Route::get('export/stok', [StokController::class, 'generateexcel'])->name('exportExcelStok');
    Route::get('generate/stok', [StokController::class, 'generatePdf'])->name('exportPdfStok');
    Route::get('export/meja', [MejaController::class, 'generateexcel'])->name('exportExcelMeja');
    Route::get('generate/meja', [MejaController::class, 'generatePdf'])->name('exportPdfMeja');
    Route::get('export/pelanggan', [PelangganController::class, 'generateexcel'])->name('exportExcelPelanggan');
    Route::get('generate/pelanggan', [PelangganController::class, 'generatePdf'])->name('exportPdfPelanggan');
    Route::get('export/produk', [ProdukController::class, 'generateexcel'])->name('exportExcelProduk');
    Route::get('generate/produk', [ProdukController::class, 'generatepdf'])->name('exportPdfProduk');
    Route::get('export/pegawai', [PegawaiController::class, 'generateexcel'])->name('exportExcelPegawai');
    Route::get('generate/pegawai', [PegawaiController::class, 'generatepdf'])->name('exportPdfPegawai');

    // Import
    Route::post('kategori/import', [KategoriController::class, 'importData'])->name('importKategori');
    Route::post('jenis/import', [JenisController::class, 'importData'])->name('importJenis');
    Route::post('menu/import', [MenuController::class, 'importData'])->name('importMenu');
    Route::post('stok/import', [StokController::class, 'importData'])->name('importStok');
    Route::post('meja/import', [MejaController::class, 'importData'])->name('importMeja');
    Route::post('pelanggan/import', [PelangganController::class, 'importData'])->name('importPelanggan');
    Route::post('produk/import', [ProdukController::class, 'importData'])->name('importProduk');
    Route::post('pegawai/import', [PegawaiController::class, 'importData'])->name('importPegawai');

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

        Route::resource('/karyawan', KaryawanController::class);
        Route::post('/karyawan/update-status', [KaryawanController::class, 'update'])->name('karyawan.update-status');

        Route::resource('/pegawai', PegawaiController::class);
    });

    // kasir
    Route::group(['middleware' => ['cekUserLogin:2']], function () {
        Route::get('/pemesanan', [PemesananController::class, 'tampil']);
        Route::post('/pemesanan-transaksi', [TransaksiController::class, 'makeTransaksi'])->name('pemesanan-transaksi');

        // Nota Faktur
        Route::get('nota/{nofaktur}', [TransaksiController::class, 'faktur']);
    });
});
