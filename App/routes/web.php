<?php

use App\Http\Controllers\BagianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::get('/')->name('login');


Route::get('/beranda', [DashboardController::class, 'berandaSA']);

Route::get('/user', [UserController::class, 'user']);

Route::get('/user/add', [UserController::class, 'user_add']);


Route::get('/bagian', [BagianController::class, 'bagian']);
Route::get('/bagian/add', [BagianController::class, 'bagian_Add']);