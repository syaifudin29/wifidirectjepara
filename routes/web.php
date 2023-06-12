<?php

use App\Http\Middleware\CekLogin;
use App\Http\Middleware\CekPelanggan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\PelbayarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UsermanagController;
use App\Http\Controllers\PelProfileController;
use App\Http\Controllers\PelDashboardController;


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
    return redirect('masuk');
});
Route::middleware([CekLogin::class])->group(function () {
    Route::get('admin', function () {
        return redirect('admin/dashboard');
    });
    Route::get('admin/dashboard', [DashboardController::class, 'index']);
    Route::get('admin/paket', [PaketController::class, 'index']);
    Route::post('admin/paket/tambah', [PaketController::class, 'tambah']);
    Route::get('admin/paket/delete/{id}', [PaketController::class, 'delete']);
    Route::post('admin/paket/edit', [PaketController::class, 'edit']);

    Route::resource('admin/pelanggan', PelangganController::class);
    Route::get('admin/pelanggan/updatepassword/{id}', [PelangganController::class, 'updatepassword']);

    Route::get('admin/tagihan/', [TagihanController::class, 'sudahbyr']);
    Route::get('admin/tagihan/sudahbayar', [TagihanController::class, 'sudahbyr']);
    Route::get('admin/tagihan/bulanini', [TagihanController::class, 'bulanini']);
    Route::get('admin/tagihan/jatuhtempo', [TagihanController::class, 'jatuhtempo']);
    Route::get('admin/tagihan/bayartagihan', [TagihanController::class, 'bayartagihan']); 
    Route::post('admin/tagihan/bayartagihanproses', [TagihanController::class, 'bayartagihanproses']);
    Route::get('admin/tagihan/batal/{id}', [TagihanController::class, 'pembatalanTransaksi']);

    Route::get('admin/usermanage', [UsermanagController::class, 'index']);

    Route::get('admin/profile', [ProfileController::class, 'index']);
    Route::post('admin/profile/updateprofile', [ProfileController::class, 'updateProfile']);
    Route::post('admin/profile/updatepassword', [ProfileController::class, 'updatePassword']);
    Route::post('admin/profile/updatephoto', [ProfileController::class, 'updatePhoto']);
    Route::get('admin/profile/updatesimulasi/{status}', [ProfileController::class, 'updateSimulasi']);
});
Route::middleware([CekPelanggan::class])->group(function () {
    Route::get('pelanggan', [PelDashboardController::class, 'index']);
    Route::get('pelanggan/dashboard', [PelDashboardController::class, 'index']);

    Route::get('pelanggan/bayar', [PelbayarController::class, 'index']);
    Route::get('pelanggan/bayar/proses', [PelbayarController::class, 'proses']);
    Route::get('pelanggan/bayar/belum', [PelbayarController::class, 'belum']);
    // Route::get('pelanggan/bayar/cek', [PelbayarController::class, 'bayar']);

    Route::get('pelanggan/profile', [PelProfileController::class, 'index']);
    Route::post('pelanggan/profile/updatepassword', [PelProfileController::class, 'updatePassword']);
    Route::get('pelanggan/updatetagihan/{order_id}/{keterangan}', [PelbayarController::class, 'updatePembayaran']);
    Route::post('pelanggan/profile/updatephoto', [PelProfileController::class, 'updatePhoto']);
});

Route::get('masuk', [LoginController::class, 'index']);
Route::post('masuk/proses', [LoginController::class, 'prosesLogin']);


Route::get('pelanggan/contoh', [PelbayarController::class, 'contoh']);
//perbarui tagihan
Route::get('updatetagihanpelanggan', [TagihanController::class, 'perbarui']);
//cancel transaksi
Route::get('pelanggan/transaksi/cancel/{id}', [PelbayarController::class, 'cancelTransaksi']);
Route::get('admin/transaksi/cancel/{id}', [TagihanController::class, 'cancelTransaksi']);

Route::get('logout', [LoginController::class, 'logout']);







