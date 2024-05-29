<?php

namespace App\Http\Controllers;

use App\Models\suratKeluar;
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
        $suratMasuk = suratMasuk::whereBetween('tgl_surat', [$get1, $get2])
        ->orderBy('tgl_surat', 'asc')
        ->get();
    
        // Check if data is found
        if($suratMasuk->isEmpty()){
            // Data not found, return back with error message
            return back()->with('message', 'Maaf, data tidak ada. Silahkan cek kembali data yang anda cari.');
        } else {
            // Pass the data to the view
            return view('pelaporan.hasilCari.hasilSuratMasuk', compact('suratMasuk', 'get1', 'get2'));
        }
    }
    
    
    // Print Surat Masuk
    public function cetakPelaporanSuratMasuk_post(Request $req){

        $req->validate([
            'awal' => 'required|date',
            'akhir' => 'required|date',
        ]);

        $get1 = $req->awal;
        $get2 = $req->akhir;

        // Retrieve data between the specified dates and order by date ascending
        $suratMasuk = suratMasuk::whereBetween('tgl_surat', [$get1, $get2])
                                ->orderBy('tgl_surat', 'asc')
                                ->get();

        // Share data with the view
        $data = [
            'suratMasuk' => $suratMasuk,
            'get1' => $get1,
            'get2' => $get2,
        ];

        // Load the view, render PDF content, and prepare headers
        $pdf = PDF::loadView('pelaporan.CetakLaporan.printSuratMasuk', $data);
        $content = $pdf->output();

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Laporan_Surat_Masuk.pdf"',
        ];

        // Return response with appropriate headers for new tab download
        return response($content, 200, $headers)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Laporan_Surat_Masuk.pdf"');
    }






    // SECTION UNTUK CETAK SURAT KELUAR

    public function pelaporanSuratKeluar(){

        return view('pelaporan.suratKeluar');
    }

    public function pelaporanSuratKeluar_proses(Request $req){
        $req->validate([
            'awal' => 'required|date',
            'akhir' => 'required|date',
        ]);
    
        $get1 = $req->awal;
        $get2 = $req->akhir;
    
        // Retrieve data between the specified dates
        $suratKeluar = suratKeluar::whereBetween('tgl_surat', [$get1, $get2])
        ->orderBy('tgl_surat', 'asc')
        ->get();
    
        // Check if data is found
        if($suratKeluar->isEmpty()){
            // Data not found, return back with error message
            return back()->with('message', 'Maaf, data tidak ada. Silahkan cek kembali data yang anda cari.');
        } else {
            // Pass the data to the view
            return view('pelaporan.hasilCari.hasilSuratKeluar', compact('suratKeluar', 'get1', 'get2'));
        }
    }
    
    
    // Print Surat Masuk
    public function cetakPelaporanSuratKeluar_post(Request $req){

        $req->validate([
            'awal' => 'required|date',
            'akhir' => 'required|date',
        ]);

        $get1 = $req->awal;
        $get2 = $req->akhir;

        // Retrieve data between the specified dates and order by date ascending
        $suratKeluar = suratKeluar::whereBetween('tgl_surat', [$get1, $get2])
                                ->orderBy('tgl_surat', 'asc')
                                ->get();

        // Share data with the view
        $data = [
            'suratKeluar' => $suratKeluar,
            'get1' => $get1,
            'get2' => $get2,
        ];

        // Load the view, render PDF content, and prepare headers
        $pdf = PDF::loadView('pelaporan.CetakLaporan.printSuratKeluar', $data);
        $content = $pdf->output();

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Laporan_Surat_Masuk.pdf"',
        ];

        // Return response with appropriate headers for new tab download
        return response($content, 200, $headers)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Laporan_Surat_Masuk.pdf"');
    }


}
