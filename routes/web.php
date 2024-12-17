<?php

use App\Models\BarangKeluar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

Route::get('/', [LoginController::class, 'index'])->name('home');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    // laptop
    Route::get('/data-laptop', [LaptopController::class, 'index'])->name('data-laptop.index');
    Route::get('/data-laptop/report', [LaptopController::class, 'report'])->name('data-laptop.report');
    Route::get('data-laptop/export/', [LaptopController::class, 'export'])->name('data-laptop.export');
    // 
    // Route::post('/data-laptop/store', [LaptopController::class, 'store'])->name('laptop.store');
    // Route::get('/data-laptop/edit/{id}', [LaptopController::class, 'show'])->name('laptop.edit');
    // Route::post('/data-laptop/update/{id}', [LaptopController::class, 'update'])->name('laptop.update');
    // Route::get('/data-laptop/delete/{id}', [LaptopController::class, 'destroy'])->name('laptop.delete');

    // barang masuk
    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
    Route::get('/barang-masuk/create', [BarangMasukController::class, 'form'])->name('barang-masuk.create');
    Route::post('/barang-masuk/store', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
    Route::get('/barang-masuk/show/{id}', [BarangMasukController::class, 'form'])->name('barang-masuk.show');
    Route::post('/barang-masuk/update/{id}', [BarangMasukController::class, 'update'])->name('barang-masuk.update');
    Route::delete('/barang-masuk/destroy/{id}', [BarangMasukController::class, 'destroy'])->name('barang-masuk.destroy');

    // barang keluar
    Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
    Route::get('/barang-keluar/cari', [BarangKeluarController::class, 'search'])->name('barang-keluar.search');
    Route::get('/barang-keluar/create', [BarangKeluarController::class, 'form'])->name('barang-keluar.create');
    Route::post('/barang-keluar/store', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');
    Route::get('/barang-keluar/show/{id}', [BarangKeluarController::class, 'form'])->name('barang-keluar.show');
    Route::post('/barang-keluar/update/{id}', [BarangKeluarController::class, 'update'])->name('barang-keluar.update');
    Route::delete('/barang-keluar/destroy/{id}', [BarangKeluarController::class, 'destroy'])->name('barang-keluar.destroy');


    // pengguna
    Route::get('/ubah-password', [UserController::class, 'changePassword'])->name('ubah-password');
    Route::post('/ubah-password', [UserController::class, 'updatePassword'])->name('ubah-password.update');
});
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::fallback(function () {
    return view('404');
});