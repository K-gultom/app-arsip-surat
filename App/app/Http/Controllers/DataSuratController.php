<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataSuratController extends Controller
{
    public function dataSuratMasuk(){

        return view('dataSurat.suratMasuk');
    }
    public function dataSuratKeluar(){

        return view('dataSurat.suratKeluar');
    }
}
