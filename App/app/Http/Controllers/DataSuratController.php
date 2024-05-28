<?php

namespace App\Http\Controllers;

use App\Models\bagian;
use App\Models\suratMasuk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataSuratController extends Controller
{
    public function dataSuratMasuk(){

        $getSurat = suratMasuk::paginate(10);

        foreach ($getSurat as $item) {
            $item->tgl_surat = Carbon::parse($item->tgl_surat)->format('d-m-Y'); // Format as day-month-year
        }


        return view('DataSurat.SuratMasuk.suratMasuk', 
            compact(
                'getSurat',
            )
        );
    }

    public function addSuratMasuk(){

        $getPenerima = bagian::all();
        $getPengirim = User::all();
        return view('DataSurat.SuratMasuk.addSuratMasuk', 
            compact(
                'getPenerima',
                'getPengirim',
            )
        );
    }

    public function addSuratMasuk_save (Request $req){

        $req->validate([
            // 'nomor_surat' => 'required',
            'tgl_surat' => 'required|date',
            'perihal' => 'required|min:3',
            'penerima' => 'required',
            'pengirim' => 'required',
            'file_surat' => 'required|mimes:pdf',
            // 'user_id' => 'required',
        ]);

        $tanggalKirim = Carbon::parse($req->tgl_surat)->format('Ymd');
        $lastSurat = suratMasuk::whereDate('tgl_surat', $req->tgl_surat)->orderBy('id', 'desc')->first();

        $lastId = $lastSurat ? substr($lastSurat->nomor_surat, -4) : 0;
        $newId = str_pad((int)$lastId + 1, 4, '0', STR_PAD_LEFT);

        $nomorSurat = $tanggalKirim . '-' . $newId;


        $fileSurat = $req->file('file_surat');
        $new_pdf_name = uniqid() . "." . $fileSurat->getClientOriginalExtension();
        $fileSurat->move('assets/pdf', $new_pdf_name);

        
        $new = new suratMasuk();
        $new -> nomor_surat = $nomorSurat;
        $new -> tgl_surat = $req->tgl_surat;
        $new -> perihal = $req->perihal;
        $new -> penerima = $req->penerima;
        $new -> pengirim = $req->pengirim;
        $new -> file_surat = $new_pdf_name;
        $new -> user_id = Auth::user()->id;
        $new->save();
        // dd($new);

        return redirect('/data/surat-masuk')->with('message', 'Surat Baru Berhasil Dibuat!!!');
    }

    public function lihatDataSurat($id){

        $getSuratMasuk =  suratMasuk::with('getPengirim', 'getPenerima')->find($id);

        if ($getSuratMasuk) {
            $getSuratMasuk->tgl_surat = Carbon::parse($getSuratMasuk->tgl_surat)->format('d-m-Y'); // Format day-month-year
        }
        // dd($getSuratMasuk);
        return view('DataSurat.SuratMasuk.lihatSuratMasuk',
            compact(
                'getSuratMasuk'
            )
        );

    }

    public function dataSuratMasukEdit($id){
        
        $getDataEditSM =  suratMasuk::with('getPengirim', 'getPenerima')->find($id);

        // if ($getDataEditSM) {
        //     $getDataEditSM->tgl_surat = Carbon::parse($getDataEditSM->tgl_surat)->format('d-m-Y'); // Format day-month-year
        // }

        
        $getPenerima = bagian::all();
        $getPengirim = User::all();
        // dd($getDataEditSM);
        return view('DataSurat.SuratMasuk.editSuratMasuk',
            compact(
                'getDataEditSM',
                'getPenerima',
                'getPengirim',
            )
        );
        
    }

    public function dataSuratMasukEdit_save(Request $req, $id){

        $req->validate([
            'tgl_surat' => 'required|date',
            'perihal' => 'required|min:3',
            'penerima' => 'required',
            'pengirim' => 'required',
            'file_surat' => 'sometimes|mimes:pdf',
        ]);

        $new = suratMasuk::find($id);

        // Format tanggal surat baru
        $newTanggalKirim = Carbon::parse($req->tgl_surat)->format('Ymd');

        // Ambil nomor surat lama untuk mendapatkan nomor urut
        $oldNomorSurat = $new->nomor_surat;
        $oldTanggalKirim = substr($oldNomorSurat, 0, 8);
        $nomorUrut = substr($oldNomorSurat, 9);

        // Jika tanggal berubah, ubah hanya tanggal pada nomor surat
        if ($newTanggalKirim !== $oldTanggalKirim) {
            $newNomorSurat = $newTanggalKirim . '-' . $nomorUrut;
        } else {
            $newNomorSurat = $oldNomorSurat;
        }

        // Check if there's a new file_surat being uploaded
        if ($req->hasFile('file_surat')) {
            $fileSurat = $req->file('file_surat');
            $new_pdf_name = uniqid() . "." . $fileSurat->getClientOriginalExtension();
            
            // Move new file to storage
            $fileSurat->move('assets/pdf', $new_pdf_name);

            // Delete old file from storage
            if ($new->file_surat && file_exists(public_path('assets/pdf/' . $new->file_surat))) {
                unlink(public_path('assets/pdf/' . $new->file_surat));
            }

            // Set new file name to the record
            $new->file_surat = $new_pdf_name;
        }

        $new->nomor_surat = $newNomorSurat;
        $new->tgl_surat = $req->tgl_surat;
        $new->perihal = $req->perihal;
        $new->penerima = $req->penerima;
        $new->pengirim = $req->pengirim;
        $new->user_id = Auth::user()->id;
        $new->save();

        return redirect('/data/surat-masuk')->with('message', 'Data Surat Berhasil diPerbaharui!!!');
    }








    public function dataSuratKeluar(){

        return view('dataSurat.suratKeluar');
    }
}
