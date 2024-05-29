<?php

namespace App\Http\Controllers;

use App\Models\bagian;
use App\Models\suratKeluar;
use App\Models\suratMasuk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DataSuratController extends Controller
{
    public function dataSuratMasuk(Request $r){
        $search = $r->input('search');
        
        $getSurat = suratMasuk::with('getPengirim', 'getPenerima')
            ->where('perihal', 'like', "%{$search}%")
            ->orWhere('nomor_surat', 'like', "%{$search}%")
            ->orWhereHas('getPengirim', function($query) use ($search) {
                $query->where('Jabatan', 'like', "%{$search}%"); // Adjust 'name' to the appropriate column in getPengirim
            })
            ->orWhereHas('getPenerima', function($query) use ($search) {
                $query->where('nama_bagian', 'like', "%{$search}%"); // Adjust 'nama_bagian' to the appropriate column in getPenerima
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        // Format the date for each item in the collection
        foreach ($getSurat as $item) {
            $item->tgl_surat = Carbon::parse($item->tgl_surat)->format('d-m-Y'); // Format as day-month-year
        }
    
        return view('DataSurat.SuratMasuk.suratMasuk', compact('getSurat'));
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
            'nomor_surat' => 'required',
            'tgl_surat' => 'required|date',
            'perihal' => 'required|min:3',
            'penerima' => 'required',
            'pengirim' => 'required',
            'file_surat' => 'required|mimes:pdf',
            // 'user_id' => 'required',
        ]);

        $fileSurat = $req->file('file_surat');
        $new_pdf_name = uniqid() . "." . $fileSurat->getClientOriginalExtension();
        $fileSurat->move('assets/SuratMasuk', $new_pdf_name);

        
        $new = new suratMasuk();
        $new -> nomor_surat = $req->nomor_surat;
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
            'nomor_surat' => 'required',
            'tgl_surat' => 'required|date',
            'perihal' => 'required|min:3',
            'penerima' => 'required',
            'pengirim' => 'required',
            'file_surat' => 'sometimes|mimes:pdf',
        ]);

        $new = suratMasuk::find($id);

        // Check if there's a new file_surat being uploaded
        if ($req->hasFile('file_surat')) {
            $fileSurat = $req->file('file_surat');
            $new_pdf_name = uniqid() . "." . $fileSurat->getClientOriginalExtension();
            
            // Move new file to storage
            $fileSurat->move('assets/SuratMasuk', $new_pdf_name);

            // Delete old file from storage
            if ($new->file_surat && file_exists(public_path('assets/SuratMasuk/' . $new->file_surat))) {
                unlink(public_path('assets/SuratMasuk/' . $new->file_surat));
            }

            // Set new file name to the record
            $new->file_surat = $new_pdf_name;
        }

        $new->nomor_surat = $req->nomor_surat;
        $new->tgl_surat = $req->tgl_surat;
        $new->perihal = $req->perihal;
        $new->penerima = $req->penerima;
        $new->pengirim = $req->pengirim;
        $new->user_id = Auth::user()->id;
        $new->save();

        return redirect('/data/surat-masuk')->with('message', 'Data Surat Berhasil diPerbaharui!!!');
    }

    public function destroySuratMasuk($id) {

        $data = suratMasuk::find($id);
    
        if ($data) {
            // Path ke foto UMKM
            $photo_path = public_path('assets/SuratMasuk/' . $data->file_surat);
    
            // Hapus file foto jika ada
            if (File::exists($photo_path)) {
                File::delete($photo_path);
            }
    
            // Hapus data dari tabel
            $data->delete();
            
            return redirect('/data/surat-keluar')->with('message', 'Data Surat Berhasil diHapus!!!');
        }
        
    
        return redirect('/data/surat-keluar')->with('message', 'Data Surat tidak ditemukan!!!');
    }
    
    







    public function dataSuratKeluar(Request $r){
        $search = $r->input('search');
        
        $getSurat = suratKeluar::with('getPengirim', 'getPenerima')
            ->where('perihal', 'like', "%{$search}%")
            ->orWhere('nomor_surat', 'like', "%{$search}%")
            ->orWhereHas('getPengirim', function($query) use ($search) {
                $query->where('Jabatan', 'like', "%{$search}%"); // Adjust 'name' to the appropriate column in getPengirim
            })
            ->orWhereHas('getPenerima', function($query) use ($search) {
                $query->where('nama_bagian', 'like', "%{$search}%"); // Adjust 'nama_bagian' to the appropriate column in getPenerima
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        // Format the date for each item in the collection
        foreach ($getSurat as $item) {
            $item->tgl_surat = Carbon::parse($item->tgl_surat)->format('d-m-Y'); // Format as day-month-year
        }
    
        return view('DataSurat.Suratkeluar.suratKeluar', compact('getSurat'));
    }

    public function addSuratKeluar(){

        $getPenerima = bagian::all();
        $getPengirim = User::all();
        return view('DataSurat.Suratkeluar.addSuratKeluar', 
            compact(
                'getPenerima',
                'getPengirim',
            )
        );

    }

    public function addSuratKeluar_save(Request $req){

        $req->validate([
            'nomor_surat' => 'required',
            'tgl_surat' => 'required|date',
            'perihal' => 'required|min:3',
            'penerima' => 'required',
            'pengirim' => 'required',
            'file_surat' => 'required|mimes:pdf',
            // 'user_id' => 'required',
        ]);

        $fileSurat = $req->file('file_surat');
        $new_pdf_name = uniqid() . "." . $fileSurat->getClientOriginalExtension();
        $fileSurat->move('assets/SuratKeluar', $new_pdf_name);

        
        $new = new suratKeluar();
        $new -> nomor_surat = $req->nomor_surat;
        $new -> tgl_surat = $req->tgl_surat;
        $new -> perihal = $req->perihal;
        $new -> penerima = $req->penerima;
        $new -> pengirim = $req->pengirim;
        $new -> file_surat = $new_pdf_name;
        $new -> user_id = Auth::user()->id;
        $new->save();
        // dd($new);

        return redirect('/data/surat-keluar')->with('message', 'Surat Baru Berhasil Dibuat!!!');

    }

    public function lihatDataSuratKeluar($id){

        $getSuratMasuk =  suratKeluar::with('getPengirim', 'getPenerima')->find($id);

        if ($getSuratMasuk) {
            $getSuratMasuk->tgl_surat = Carbon::parse($getSuratMasuk->tgl_surat)->format('d-m-Y'); // Format day-month-year
        }
        // dd($getSuratMasuk);
        return view('DataSurat.SuratKeluar.lihatSuratKeluar',
            compact(
                'getSuratMasuk'
            )
        );
    }


    public function dataSuratKeluarEdit($id){
        
        $getDataEditSM =  suratKeluar::with('getPengirim', 'getPenerima')->find($id);

        $getPenerima = bagian::all();
        $getPengirim = User::all();
        // dd($getDataEditSM);
        return view('DataSurat.SuratKeluar.editSuratKeluar',
            compact(
                'getDataEditSM',
                'getPenerima',
                'getPengirim',
            )
        );
        
    }

    public function dataSuratKeluarEdit_save(Request $req, $id){

        $req->validate([
            'nomor_surat' => 'required',
            'tgl_surat' => 'required|date',
            'perihal' => 'required|min:3',
            'penerima' => 'required',
            'pengirim' => 'required',
            'file_surat' => 'sometimes|mimes:pdf',
        ]);

        $new = suratKeluar::find($id);

        // Check if there's a new file_surat being uploaded
        if ($req->hasFile('file_surat')) {
            $fileSurat = $req->file('file_surat');
            $new_pdf_name = uniqid() . "." . $fileSurat->getClientOriginalExtension();
            
            // Move new file to storage
            $fileSurat->move('assets/SuratKeluar', $new_pdf_name);

            // Delete old file from storage
            if ($new->file_surat && file_exists(public_path('assets/SuratKeluar/' . $new->file_surat))) {
                unlink(public_path('assets/SuratKeluar/' . $new->file_surat));
            }

            // Set new file name to the record
            $new->file_surat = $new_pdf_name;
        }

        $new->nomor_surat = $req->nomor_surat;
        $new->tgl_surat = $req->tgl_surat;
        $new->perihal = $req->perihal;
        $new->penerima = $req->penerima;
        $new->pengirim = $req->pengirim;
        $new->user_id = Auth::user()->id;
        $new->save();

        return redirect('/data/surat-keluar')->with('message', 'Data Surat Berhasil diPerbaharui!!!');

    }

    public function destroySuratKeluar($id){
        $data = suratKeluar::find($id);
    
        if ($data) {
            // Path ke foto UMKM
            $photo_path = public_path('assets/SuratKeluar/' . $data->file_surat);
    
            // Hapus file foto jika ada
            if (File::exists($photo_path)) {
                File::delete($photo_path);
            }
    
            // Hapus data dari tabel
            $data->delete();

            return redirect('/data/surat-keluar')->with('message', 'Data Surat Berhasil diHapus!!!');
        }
        
    
        return redirect('/data/surat-keluar')->with('message', 'Data Surat tidak ditemukan!!!');
    }





}
