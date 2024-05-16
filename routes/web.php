<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;

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
Route::middleware('auth')->group(function () {
    Route::get('/', [BarangController::class,'store'])->name('home');
    Route::get('/master/barang', [BarangController::class,'viewDataBarang'])->name('barang');
    Route::get('/master/kategori', [KategoriController::class,'viewkategori'])->name('kategori');
    Route::get('/master/member', [MemberController::class,'index'])->name('member');
    Route::get('/transaksi', [TransaksiController::class,'index'])->name('transaksi');
    Route::get('/transaksi/laporan', [TransaksiController::class,'laporanView'])->name('laporan');
    Route::get('/master/user', [UserController::class,'view'])->name('userView');
    Route::get('/logout', [UserController::class,'logout'])->name('logout');
});

Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');
Route::get('/logout' , function()
{
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});
