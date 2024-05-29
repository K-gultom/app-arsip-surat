<?php

namespace App\Http\Controllers;

use App\Models\suratKeluar;
use App\Models\suratMasuk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function berandaSA(){

        $getSuratMasuk = suratMasuk::all()->count();
        $getSuratKeluar = suratKeluar::all()->count();
        $getUser = User::all()->count();

        // dd($getSuratKeluar);
        return view('beranda', 
            compact(
                'getSuratMasuk',
                'getSuratKeluar',
                'getUser'
            )
        );
    }
}
