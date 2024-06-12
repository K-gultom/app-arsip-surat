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
        
        //view untuk home menu surat keluar
        Route::get('/surat-keluar', [DataSuratController::class, 'Surat_keluar']);


            //  Surat Keterangan Usaha
            Route::get('/surat-usaha', [DataSuratController::class, 'surat_usaha']);
            Route::get('/surat-usaha/data/{id}', [DataSuratController::class, 'surat_usaha_lihat_data']);
            Route::get('/surat-usaha/cetak/{id}', [DataSuratController::class, 'cetak_surat_usaha']);


        // Surat Keterangan Tidak Mampu
        Route::get('/surat-tidak-mampu', [DataSuratController::class, 'surat_tidak_mampu']);
        Route::get('/surat-tidak-mampu/data/{id}', [DataSuratController::class, 'surat_tidak_mampu_lihat_data']);
        Route::get('/surat-tidak-mampu/cetak/{id}', [DataSuratController::class, 'cetak_surat_tidak_mampu']);


            // Surat Keterangan Domisili
            Route::get('/surat-domisili', [DataSuratController::class, 'surat_domisili']);
            Route::get('/surat-domisili/data/{id}', [DataSuratController::class, 'surat_domisili_lihat_data']);
            Route::get('/surat-domisili/cetak/{id}', [DataSuratController::class, 'cetak_surat_domisili']);
           
    });



    Route::middleware(['auth:','cekLevel:Super_Admin,Admin,User'])->group(function () {
        /**
         * Routing untuk tombol Logout
         */
        Route::get('/logout', [AuthController::class, 'logout']);



        //surat masuk (lihat data)
        Route::get('/surat-masuk/data/{id}', [DataSuratController::class, 'lihatDataSurat']);

        //surat keluar (lihat data)
        Route::get('/surat-keluar/data/{id}', [DataSuratController::class, 'lihatDataSuratKeluar']);

    });

    Route::middleware(['auth:','cekLevel:Super_Admin'])->group(function () {
        // Routing User
        /**
         * Routing Menu dan fitur-fitur pada menu User
         * Fitur ini hanya Eksklusif digunakan oleh
         * Level -> Super_Admin
         */
        Route::get('/user', [UserController::class, 'user']);

        Route::get('/user/add', [UserController::class, 'user_add']);
        Route::post('/user/add', [UserController::class, 'user_save']);

        Route::get('/user/edit/{id}', [UserController::class, 'user_edit']);
        Route::post('/user/edit/{id}', [UserController::class, 'user_edit_save']);

        Route::get('/user/data/{id}', [UserController::class, 'user_data']);

        Route::get('/user/password/{id}', [UserController::class, 'user_password']);
        Route::post('/user/password/{id}', [UserController::class, 'user_password_save']);

        Route::get('/user/destroy/{id}', [UserController::class, 'destroy']);
    });

    Route::middleware(['auth:','cekLevel:Admin'])->group(function () {
        
        /**
         * ======Routing Menu Bagian======
         * Routing Fitur Pada Menu Bagian
         * Fitur ini hanya dapat digunakan oleh
         * level -> Admin
         */
        Route::get('/bagian/add', [BagianController::class, 'bagianAdd']);
        Route::post('/bagian/add', [BagianController::class, 'bagianAdd_save']);

        Route::get('/bagian/edit/{id}', [BagianController::class, 'bagian_Edit']);
        Route::post('/bagian/edit/{id}', [BagianController::class, 'bagian_Edit_save']);

        Route::get('/bagian/destroy/{id}', [BagianController::class, 'destroy']);


        // Routing Menu Data Surat
            /**
             * Routing Menu Surat Masuk
             * Fitur ini hanya dapat digunakan oleh
             * Level -> Admin
             */
            Route::get('/surat-masuk/add', [DataSuratController::class, 'addSuratMasuk']);
            Route::post('/surat-masuk/add', [DataSuratController::class, 'addSuratMasuk_save']);

            Route::get('/surat-masuk/edit/{id}', [DataSuratController::class, 'dataSuratMasukEdit']);
            Route::post('/surat-masuk/edit/{id}', [DataSuratController::class, 'dataSuratMasukEdit_save']);

            Route::get('/surat-masuk/destroy/{id}', [DataSuratController::class, 'destroySuratMasuk']);

    });

    Route::middleware(['auth:','cekLevel:User'])->group(function () {
        // Routing Menu Data Surat
            /**
             * ======Surat keluar========
             * Fitur ini hanya dapat gunakan oleh level User
             */
            Route::get('/surat-keluar/add', [DataSuratController::class, 'addSuratKeluar']);
            Route::post('/surat-keluar/add', [DataSuratController::class, 'addSuratKeluar_save']);

            Route::get('/surat-keluar/edit/{id}', [DataSuratController::class, 'dataSuratKeluarEdit']);
            Route::post('/surat-keluar/edit/{id}', [DataSuratController::class, 'dataSuratKeluarEdit_save']);

            Route::get('/surat-keluar/destroy/{id}', [DataSuratController::class, 'destroySuratKeluar']);


            // surat Keterangan Usaha
            Route::get('/surat-usaha/add', [DataSuratController::class, 'surat_usaha_add']);
            Route::post('/surat-usaha/add', [DataSuratController::class, 'surat_usaha_add_save']);

            Route::get('/surat-usaha/edit/{id}', [DataSuratController::class, 'surat_usaha_edit']);
            Route::post('/surat-usaha/edit/{id}', [DataSuratController::class, 'surat_usaha_edit_save']);

            Route::get('/surat-usaha/del/{id}', [DataSuratController::class, 'hapus_surat_usaha']);


                //Surat Keterangan Tidak Mampu
                Route::get('/surat-tidak-mampu/add', [DataSuratController::class, 'surat_tidak_mampu_add']);
                Route::post('/surat-tidak-mampu/add', [DataSuratController::class, 'surat_tidak_mampu_add_save']);
        
                Route::get('/surat-tidak-mampu/edit/{id}', [DataSuratController::class, 'surat_tidak_mampu_edit']);
                Route::post('/surat-tidak-mampu/edit/{id}', [DataSuratController::class, 'surat_tidak_mampu_edit_save']);

                Route::get('/surat-tidak-mampu/del/{id}', [DataSuratController::class, 'hapus_surat_tidak_mampu']);


            //Surat Keterangan Domisili
            Route::get('/surat-domisili/add', [DataSuratController::class, 'surat_domisili_add']);
            Route::post('/surat-domisili/add', [DataSuratController::class, 'surat_domisili_add_save']);

            Route::get('/surat-domisili/edit/{id}', [DataSuratController::class, 'surat_domisili_edit']);
            Route::post('/surat-domisili/edit/{id}', [DataSuratController::class, 'surat_domisili_edit_save']);

            Route::get('/surat-domisili/del/{id}', [DataSuratController::class, 'hapus_surat_domisili']);


    });

    Route::middleware(['auth:','cekLevel:Super_Admin,Admin'])->group(function () {
        
        /**
         * =======Routing Menu Bagian=======
         * user level -> Super_Admin dan Admin
         *  yang hanya bisa melihat data pada menu ini
         */
        Route::get('/bagian', [BagianController::class, 'bagian']);

    });

    Route::middleware(['auth:','cekLevel:Super_Admin,Admin,User'])->group(function () {

        Route::get('/beranda', [DashboardController::class, 'berandaSA']);

            // Routing Menu Data Surat
                /** 
                 * =======Surat Keluar========
                 * Route ini hanya untuk melihat data saja
                 * user level -> Super_Admin dan User
                */ 
                Route::get('/data/surat-masuk', [DataSuratController::class, 'dataSuratMasuk']);

                /** 
                 *==========Surat Keluar========
                * Route ini hanya untuk melihat data saja
                * user level -> Super_Admin dan User
                */ 
                Route::get('/data/surat-keluar', [DataSuratController::class, 'dataSuratKeluar']);

            
        /**
         * ===========Routing Menu Pelaporan===========
         * Seleuruh user level mendapat hak akses untuk fitur cetak/download
         */
        Route::get('/pelaporan/surat-masuk', [PelaporanController::class, 'pelaporanSuratMasuk']);
        Route::post('/pelaporan/surat-masuk', [PelaporanController::class, 'pelaporanSuratMasuk_proses']);

        Route::post('/cetak/surat-masuk', [PelaporanController::class, 'cetakPelaporanSuratMasuk_post']);


        Route::get('/pelaporan/surat-keluar', [PelaporanController::class, 'pelaporanSuratKeluar']);
        Route::post('/pelaporan/surat-keluar', [PelaporanController::class, 'pelaporanSuratKeluar_proses']);

        Route::post('/cetak/surat-keluar', [PelaporanController::class, 'cetakPelaporanSuratKeluar_post']);

    });