<?php

use App\Http\Controllers\BagianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataSuratController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::get('/')->name('login');


Route::get('/beranda', [DashboardController::class, 'berandaSA']);

Route::get('/user', [UserController::class, 'user']);

Route::get('/user/add', [UserController::class, 'user_add']);


Route::get('/bagian', [BagianController::class, 'bagian']);
Route::get('/bagian/add', [BagianController::class, 'bagian_Add']);


Route::get('/data/surat-masuk', [DataSuratController::class, 'dataSuratMasuk']);


Route::get('/data/surat-keluar', [DataSuratController::class, 'dataSuratKeluar']);


Route::get('/pelaporan/surat-masuk', [PelaporanController::class, 'pelaporanSuratMasuk']);
Route::get('/cetak/surat-masuk', [PelaporanController::class, 'cetakPelaporanSuratMasuk']);
Route::post('/cetak/surat-masuk', [PelaporanController::class, 'cetakPelaporanSuratMasuk_post']);


Route::get('/pelaporan/surat-keluar', [PelaporanController::class, 'pelaporanSuratKeluar']);
Route::get('/cetak/surat-keluar', [PelaporanController::class, 'cetakPelaporanSuratKeluar']);