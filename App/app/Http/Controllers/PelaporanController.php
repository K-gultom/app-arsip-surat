<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    public function pelaporanSuratMasuk(){

        return view('pelaporan.suratMasuk');
    }
    
    public function cetakPelaporanSuratMasuk(){

        return view('pelaporan.hasilCari.hasilSuratMasuk');
    }

    public function cetakPelaporanSuratMasuk_post(Request $req){
        $req->validate([
            'awal' => 'required|date',
            'akhir' => 'required|date',
        ]);

        $get1 = $req->awal;
        $get2 = $req->akhir;

        dd($get1);
        dd($get2);

        return view('pelaporan.hasilCari.test');
    }




    public function pelaporanSuratKeluar(){

        return view('pelaporan.suratKeluar');
    }
}
