<?php

namespace App\Http\Controllers;

use App\Models\surat_domisili;
use App\Models\surat_tidak_mampu;
use App\Models\suratKeluar;
use App\Models\suratMasuk;
use App\Models\suratusaha;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function berandaSA(){

        $getSuratMasuk = suratMasuk::all()->count();
        // $getSuratKeluar = suratKeluar::all()->count();
        $getUser = User::all()->count();
        $getSuratDomisili = surat_domisili::all()->count();
        $getSuratTidakMampu = surat_tidak_mampu::all()->count();
        $getSuratKeteranganUsaha = suratusaha::all()->count();

        $getUserInfo = Auth::user();

        // dd($getSuratKeluar);
        return view('beranda', 
            compact(
                'getSuratMasuk',
                // 'getSuratKeluar',
                'getUser',
                'getSuratDomisili',
                'getSuratTidakMampu',
                'getSuratKeteranganUsaha',
                'getUserInfo',
            )
        );
    }
}
