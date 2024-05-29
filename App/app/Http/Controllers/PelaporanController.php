<?php

namespace App\Http\Controllers;

use App\Models\suratMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// use Barryvdh\DomPDF\PDF as DomPDFPDF;

class PelaporanController extends Controller
{
    public function pelaporanSuratMasuk(){

        return view('pelaporan.suratMasuk');
    }

    public function pelaporanSuratMasuk_proses(Request $req){
        $req->validate([
            'awal' => 'required|date',
            'akhir' => 'required|date',
        ]);
    
        $get1 = $req->awal;
        $get2 = $req->akhir;
    
        // Retrieve data between the specified dates
        $suratMasuk = suratMasuk::whereBetween('tgl_surat', [$get1, $get2])->get();
    
        // dd($suratMasuk);
        // Pass the data to the view
        return view('pelaporan.hasilCari.hasilSuratMasuk', compact('suratMasuk', 'get1', 'get2'));
    }
    


    // public function cetakPelaporanSuratMasuk(){

    //     return view('pelaporan.hasilCari.hasilSuratMasuk');
    // }

    
    public function cetakPelaporanSuratMasuk_post(Request $req)
    {
        $req->validate([
            'awal' => 'required|date',
            'akhir' => 'required|date',
        ]);
    
        $get1 = $req->awal;
        $get2 = $req->akhir;
    
        // Retrieve data between the specified dates
        $suratMasuk = suratMasuk::whereBetween('tgl_surat', [$get1, $get2])->get();
    
        // Share data with the view
        $data = [
            'suratMasuk' => $suratMasuk,
            'get1' => $get1,
            'get2' => $get2,
        ];
    
        // Load the view, render PDF content, and prepare headers
        $pdf = PDF::loadView('pelaporan.hasilCari.test', $data);
        $content = $pdf->output();

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Laporan_Surat_Masuk.pdf"',
        ];
    

        // return view('pelaporan.test', compact('suratMasuk'));



        // Return response with appropriate headers for new tab download

        return response($content, 200, $headers)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Laporan_Surat_Masuk.pdf"');
    }
    
    
    public function test(){

        return view('pelaporan.test');
    }
    



    public function pelaporanSuratKeluar(){

        return view('pelaporan.suratKeluar');
    }
}
