<?php

namespace App\Http\Controllers;

use App\Models\bagian;
use Illuminate\Http\Request;

class DataSuratController extends Controller
{
    public function dataSuratMasuk(){

        return view('DataSurat.SuratMasuk.suratMasuk');
    }

    public function addSuratMasuk(){

        $getPenerima = bagian::all();
        return view('DataSurat.SuratMasuk.addSuratMasuk', 
            compact(
                'getPenerima',
            )
        );
    }





    public function dataSuratKeluar(){

        return view('dataSurat.suratKeluar');
    }
}
