<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
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

Route::get('/', [BarangController::class,'store']);
Route::get('/master/barang', [BarangController::class,'viewDataBarang'])->name('barang');
Route::get('/master/kategori', [KategoriController::class,'viewkategori'])->name('kategori');
Route::get('/master/member', [MemberController::class,'index'])->name('member');
Route::get('/transaksi', [TransaksiController::class,'index'])->name('transaksi');
Route::get('/transaksi/laporan', [TransaksiController::class,'laporanView'])->name('laporan');
