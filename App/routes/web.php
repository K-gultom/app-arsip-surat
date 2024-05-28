<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataSuratController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'login_proses']);

Route::middleware(['auth:','cekLevel:Super_Admin,Admin,User'])->group(function () {

    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/beranda', [DashboardController::class, 'berandaSA']);

    // Routing User
        Route::get('/user', [UserController::class, 'user']);

        Route::get('/user/add', [UserController::class, 'user_add']);
        Route::post('/user/add', [UserController::class, 'user_save']);

        Route::get('/user/edit/{id}', [UserController::class, 'user_edit']);
        Route::post('/user/edit/{id}', [UserController::class, 'user_edit_save']);

        Route::get('/user/data/{id}', [UserController::class, 'user_data']);

        Route::get('/user/password/{id}', [UserController::class, 'user_password']);
        Route::post('/user/password/{id}', [UserController::class, 'user_password_save']);

        Route::get('/user/destroy/{id}', [UserController::class, 'destroy']);


    // Routing Bagian
        Route::get('/bagian', [BagianController::class, 'bagian']);

        Route::post('/bagian/add', [BagianController::class, 'bagian_Add']);

        Route::get('/bagian/edit/{id}', [BagianController::class, 'bagian_Edit']);
        Route::post('/bagian/edit/{id}', [BagianController::class, 'bagian_Edit_save']);

        Route::get('/bagian/destroy/{id}', [BagianController::class, 'destroy']);


    // Routing Data Surat
        Route::get('/data/surat-masuk', [DataSuratController::class, 'dataSuratMasuk']);

        Route::get('/surat-masuk/add', [DataSuratController::class, 'addSuratMasuk']);
        Route::post('/surat-masuk/add', [DataSuratController::class, 'addSuratMasuk_save']);

        Route::get('/surat-masuk/data/{id}', [DataSuratController::class, 'lihatDataSurat']);
        
        Route::get('/surat-masuk/edit/{id}', [DataSuratController::class, 'dataSuratMasukEdit']);
        Route::post('/surat-masuk/edit/{id}', [DataSuratController::class, 'dataSuratMasukEdit_save']);


        Route::get('/data/surat-keluar', [DataSuratController::class, 'dataSuratKeluar']);


    // Routing Pelaporan
        Route::get('/pelaporan/surat-masuk', [PelaporanController::class, 'pelaporanSuratMasuk']);
        Route::get('/cetak/surat-masuk', [PelaporanController::class, 'cetakPelaporanSuratMasuk']);
        Route::post('/cetak/surat-masuk', [PelaporanController::class, 'cetakPelaporanSuratMasuk_post']);


        Route::get('/pelaporan/surat-keluar', [PelaporanController::class, 'pelaporanSuratKeluar']);
        Route::get('/cetak/surat-keluar', [PelaporanController::class, 'cetakPelaporanSuratKeluar']);

    
});