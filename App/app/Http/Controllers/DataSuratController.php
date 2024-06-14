<?php

namespace App\Http\Controllers;

use App\Models\bagian;
use App\Models\surat_domisili;
use App\Models\surat_tidak_mampu;
use App\Models\suratKeluar;
use App\Models\suratMasuk;
use App\Models\suratusaha;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;



class DataSuratController extends Controller
{
    // ===================================Surat Masuk====================================
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
    
    


    // ===================================Surat Keluar==========================================

    public function Surat_keluar(){

        return view('DataSurat.SuratKeluarHome');
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





    // ============================Revisi Untuk SUrat Baru==================================

    // ================================Section Surat Keterangan Usaha=================================
    public function surat_usaha(Request $r){

        $search = $r->input('search');
        $getData = suratusaha::where('nama_lengkap', 'like', "%{$search}%")
        ->orWhere('nik', 'like', "%{$search}%")
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('DataSurat.SuratKeteranganUsaha.suratUsaha', compact('getData'));
    }

    public function surat_usaha_lihat_data($id){

        $getData = suratusaha::with('getUser')->find($id);
        $getUser = User::all();
        // dd($getData);
        return view('DataSurat.SuratKeteranganUsaha.lihatsuratUsaha', compact('getData', 'getUser'));
    }

    public function surat_usaha_add(){

        $getUser = User::all();
        return view('DataSurat.SuratKeteranganUsaha.addsuratUsaha', compact('getUser'));
    }

    public function surat_usaha_add_save(Request $req) {
        // Validasi input
        $req->validate([
            'tanda_tangan' => 'required|exists:users,id',
            'tanggal_surat_dibuat' => 'required|date',
            'nama_lengkap' => 'required|min:3',
            'nik' => 'required|numeric',
            'tempat_lahir' => 'required|min:2',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|min:5',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required|min:3',
            'bidang_usaha' => 'required|min:4',
        ]);
    
        // Extract bulan dan tahun dari tanggal_surat_dibuat
        $tanggalSuratDibuat = Carbon::parse($req->tanggal_surat_dibuat);
        $bulanSuratDibuat = $tanggalSuratDibuat->format('m');
        $tahunSuratDibuat = $tanggalSuratDibuat->format('Y');
    
        // Hitung nomor surat berdasarkan urutan surat per bulan
        $countSuratBulanIni = suratusaha::whereYear('tanggal_surat_dibuat', $tahunSuratDibuat)
                                        ->whereMonth('tanggal_surat_dibuat', $bulanSuratDibuat)
                                        ->count();
        $nomorSuratBerikutnya = $countSuratBulanIni + 1;
    
        // Fungsi untuk mengubah bulan menjadi format Romawi
        function bulanRomawiSuratUsaha($bulan)
        {
            $bulanRomawi = [
                1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
                5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
                9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
            ];
            return $bulanRomawi[intval($bulan)];
        }

        $bulanSuratDibuatRomawi = bulanRomawiSuratUsaha($bulanSuratDibuat);

        // Susun nomor surat
        $nomorSurat = sprintf("140/%03d/KM-MES/%s/%s", 
            $nomorSuratBerikutnya, 
            $bulanSuratDibuatRomawi, 
            $tahunSuratDibuat);
        
        // Simpan data baru ke database
        $new = new suratusaha();
        $new->nomor_surat = $nomorSurat;
        $new->tanda_tangan = $req->tanda_tangan;
        $new->tanggal_surat_dibuat = $req->tanggal_surat_dibuat;
        $new->nama_lengkap = $req->nama_lengkap;
        $new->nik = $req->nik;
        $new->tempat_lahir = $req->tempat_lahir;
        $new->tgl_lahir = $req->tgl_lahir;
        $new->alamat = $req->alamat;
        $new->jenis_kelamin = $req->jenis_kelamin;
        $new->pekerjaan = $req->pekerjaan;
        $new->tempat_pekerjaan = $req->tempat_pekerjaan;
        $new->bidang_usaha = $req->bidang_usaha;
        $new->save();
    
        // Tampilkan data untuk debug (opsional)
        // dd($new);

        return redirect('/surat-usaha')->with('message', 'Surat Usaha berhasil ditambahkan dengan nomor surat: ' . $nomorSurat);
    }
    
    public function surat_usaha_edit($id){

        $getData = suratusaha::with('getUser')->find($id);
        $getUser = User::all();
        // dd($getData);
        return view('DataSurat.SuratKeteranganUsaha.editsuratUsaha', compact('getData', 'getUser'));
    }

    public function surat_usaha_edit_save(Request $req, $id) {
        // Validasi input
        $req->validate([
            'tanda_tangan' => 'required|exists:users,id',
            'tanggal_surat_dibuat' => 'required|date',
            'nama_lengkap' => 'required|min:3',
            'nik' => 'required|numeric',
            'tempat_lahir' => 'required|min:2',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|min:5',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required|min:3',
            'bidang_usaha' => 'required|min:4',
        ]);
    
        // Temukan data surat usaha berdasarkan id
        $suratUsaha = suratusaha::find($id);
        if (!$suratUsaha) {
            return redirect('/surat-usaha')->withErrors('Data surat usaha tidak ditemukan.');
        }
    
        // Check if the tanggal_surat_dibuat is changed
        if ($req->tanggal_surat_dibuat != $suratUsaha->tanggal_surat_dibuat) {
            // Extract bulan dan tahun dari tanggal_surat_dibuat
            $tanggalSuratDibuat = Carbon::parse($req->tanggal_surat_dibuat);
            $bulanSuratDibuat = $tanggalSuratDibuat->format('m');
            $tahunSuratDibuat = $tanggalSuratDibuat->format('Y');
    
            // Hitung nomor surat berdasarkan urutan surat per bulan
            $countSuratBulanIni = suratusaha::whereYear('tanggal_surat_dibuat', $tahunSuratDibuat)
                                            ->whereMonth('tanggal_surat_dibuat', $bulanSuratDibuat)
                                            ->count();
            $nomorSuratBerikutnya = $countSuratBulanIni + 1;
    
            // Fungsi untuk mengubah bulan menjadi format Romawi
            function bulanRomawiSuratUsaha($bulan) {
                $bulanRomawi = [
                    1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
                    5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
                    9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
                ];
                return $bulanRomawi[intval($bulan)];
            }
    
            $bulanSuratDibuatRomawi = bulanRomawiSuratUsaha($bulanSuratDibuat);
    
            // Susun nomor surat
            $nomorSurat = sprintf("140/%03d/KM-MES/%s/%s", 
                $nomorSuratBerikutnya, 
                $bulanSuratDibuatRomawi, 
                $tahunSuratDibuat);
    
            // Perbarui nomor surat
            $suratUsaha->nomor_surat = $nomorSurat;
        }
    
        // Perbarui field lainnya
        $suratUsaha->tanda_tangan = $req->tanda_tangan;
        $suratUsaha->tanggal_surat_dibuat = $req->tanggal_surat_dibuat;
        $suratUsaha->nama_lengkap = $req->nama_lengkap;
        $suratUsaha->nik = $req->nik;
        $suratUsaha->tempat_lahir = $req->tempat_lahir;
        $suratUsaha->tgl_lahir = $req->tgl_lahir;
        $suratUsaha->alamat = $req->alamat;
        $suratUsaha->jenis_kelamin = $req->jenis_kelamin;
        $suratUsaha->pekerjaan = $req->pekerjaan;
        $suratUsaha->tempat_pekerjaan = $req->tempat_pekerjaan;
        $suratUsaha->bidang_usaha = $req->bidang_usaha;
        
        // Save the updated data
        $suratUsaha->save();
    
        // Redirect or return the appropriate response
        return redirect('/surat-usaha')->with('message', 'Surat Usaha berhasil diperbaharui dengan nomor surat: ' . $suratUsaha->nomor_surat);
    }    

    public function cetak_surat_usaha($id) {

        $getData = suratusaha::with('getUser')->find($id);
        // $getUser = User::all();
        // 
        // Atur lokal Carbon ke Bahasa Indonesia
        Carbon::setLocale('id');

        // Mendapatkan tanggal hari ini dengan nama bulan dalam bahasa Indonesia
        $tanggal_Surat = Carbon::parse($getData->tanggal_surat_dibuat)->translatedFormat('d F Y'); // Format tanggal sesuai kebutuhan Anda
        
        $data = [
            'getData' => $getData,
            // 'getUser' => $getUser,
            'tanggal_Surat' => $tanggal_Surat, // Tambahkan tanggal hari ini ke data yang dikirim ke view
        ];
        
        // Load the view, render PDF content, and prepare headers
        $pdf = FacadePdf::loadView('DataSurat.SuratKeteranganUsaha.cetakSuratUsaha', $data);
        $content = $pdf->output();

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Surat_Keterangan_Usaha.pdf"',
        ];

        // Return response with appropriate headers for new tab download
        return response($content, 200, $headers)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Surat_Keterangan_Usaha.pdf"');
    
    }

    public function hapus_surat_usaha($id){

        $data = suratusaha::find($id);
        $data->delete();

        return redirect()->back()->with('message', 'Surat Usaha dengan nomor ' . $data->nomor_surat . ' Berhasil dihapus');
    }
    
     

// ======================Section Surat Tidak Mampu=============================
    public function surat_tidak_mampu(Request $r){

        $search = $r->input('search');

        $getData = surat_tidak_mampu::where('nama_lengkap', 'like', "%{$search}%")
        ->orWhere('nik', 'like', "%{$search}%")
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('DataSurat.SuratKeteranganTidakMampu.suratTidakMampu', compact('getData'));
    }

    public function surat_tidak_mampu_add(){
        $getUser = User::all();
        return view('DataSurat.SuratKeteranganTidakMampu.addsuratTidakMampu', compact('getUser'));
    }

    public function surat_tidak_mampu_add_save(Request $req){

        $req->validate([
            'tanda_tangan' => 'required|exists:users,id',
            'nama_lengkap' => 'required|min:3',
            'nik' => 'required|numeric',
            'tempat_lahir' => 'required|min:2',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'status_perkawinan' => 'required',
            'agama' => 'required',
            'pekerjaan_pemohon' => 'required',
            'alamat' => 'required|min:5',
            'tgl_surat_dibuat' => 'required|date',
        ]);
    
        // Extract bulan dan tahun dari tanggal_surat_dibuat
        $tanggalSuratDibuat = Carbon::parse($req->tgl_surat_dibuat);
        $bulanSuratDibuat = $tanggalSuratDibuat->format('m');
        $tahunSuratDibuat = $tanggalSuratDibuat->format('Y');
    
        // Hitung nomor surat berdasarkan urutan surat per bulan
        $countSuratBulanIni = surat_tidak_mampu::whereYear('tgl_surat_dibuat', $tahunSuratDibuat)
            ->whereMonth('tgl_surat_dibuat', $bulanSuratDibuat)
            ->count();
        $nomorSuratBerikutnya = $countSuratBulanIni + 1;
    
        
        // Fungsi untuk mengubah bulan menjadi format Romawi
        function bulanRomawiSuratTidakMampu($bulan)
        {
            $bulanRomawi = [
                1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
                5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
                9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
            ];
            return $bulanRomawi[intval($bulan)];
        }

        $bulanSuratDibuatRomawi = bulanRomawiSuratTidakMampu($bulanSuratDibuat);

        // Susun nomor surat
        $nomorSurat = sprintf("140/%03d/KM-MES/%s/%s", 
            $nomorSuratBerikutnya, 
            $bulanSuratDibuatRomawi, 
            $tahunSuratDibuat);
    
        $new = new surat_tidak_mampu();
        $new->tanda_tangan = $req->tanda_tangan;
        $new->nomor_surat = $nomorSurat;
        $new->nama_lengkap = $req->nama_lengkap;
        $new->nik = $req->nik;
        $new->tempat_lahir = $req->tempat_lahir;
        $new->tgl_lahir = $req->tgl_lahir;
        $new->jenis_kelamin = $req->jenis_kelamin;
        $new->status_perkawinan = $req->status_perkawinan;
        $new->agama = $req->agama;
        $new->pekerjaan_pemohon = $req->pekerjaan_pemohon;
        $new->alamat = $req->alamat;
        $new->tgl_surat_dibuat = $tanggalSuratDibuat;
        $new->save();
    
        return redirect('/surat-tidak-mampu')->with('message', 'Surat Tidak Mampu berhasil ditambahkan dengan nomor surat: ' . $nomorSurat);
    
    }

    public function surat_tidak_mampu_edit($id) {

        $getData = surat_tidak_mampu::with('getUser')->find($id);
        $getUser = User::all();
        // dd($getData);
        return view('DataSurat.SuratKeteranganTidakMampu.editsuratTidakMampu', compact('getData', 'getUser'));
    
    }
    public function surat_tidak_mampu_edit_save(Request $req, $id) {
        // Validasi input
        $req->validate([
            'tanda_tangan' => 'required|exists:users,id',
            'nama_lengkap' => 'required|min:3',
            'nik' => 'required|numeric',
            'tempat_lahir' => 'required|min:2',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'status_perkawinan' => 'required',
            'agama' => 'required',
            'pekerjaan_pemohon' => 'required',
            'alamat' => 'required|min:5',
            'tgl_surat_dibuat' => 'required|date',
        ]);
    
        // Temukan data surat tidak mampu berdasarkan id
        $suratTidakMampu = surat_tidak_mampu::find($id);
        if (!$suratTidakMampu) {
            return redirect('/surat-tidak-mampu')->withErrors('Data surat tidak mampu tidak ditemukan.');
        }
    
        // Check if the tgl_surat_dibuat is changed
        if ($req->tgl_surat_dibuat != $suratTidakMampu->tgl_surat_dibuat) {
            // Extract bulan dan tahun dari tanggal_surat_dibuat
            $tanggalSuratDibuat = Carbon::parse($req->tgl_surat_dibuat);
            $bulanSuratDibuat = $tanggalSuratDibuat->format('m');
            $tahunSuratDibuat = $tanggalSuratDibuat->format('Y');
    
            // Hitung nomor surat berdasarkan urutan surat per bulan
            $countSuratBulanIni = surat_tidak_mampu::whereYear('tgl_surat_dibuat', $tahunSuratDibuat)
                ->whereMonth('tgl_surat_dibuat', $bulanSuratDibuat)
                ->count();
            $nomorSuratBerikutnya = $countSuratBulanIni + 1;
    
            // Fungsi untuk mengubah bulan menjadi format Romawi
            function bulanRomawiSuratTidakMampu($bulan) {
                $bulanRomawi = [
                    1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
                    5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
                    9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
                ];
                return $bulanRomawi[intval($bulan)];
            }
    
            $bulanSuratDibuatRomawi = bulanRomawiSuratTidakMampu($bulanSuratDibuat);
    
            // Susun nomor surat
            $nomorSurat = sprintf("140/%03d/KM-MES/%s/%s", 
                $nomorSuratBerikutnya, 
                $bulanSuratDibuatRomawi, 
                $tahunSuratDibuat);
    
            // Perbarui nomor surat
            $suratTidakMampu->nomor_surat = $nomorSurat;
        }
    
        // Perbarui field lainnya
        $suratTidakMampu->tanda_tangan = $req->tanda_tangan;
        $suratTidakMampu->nama_lengkap = $req->nama_lengkap;
        $suratTidakMampu->nik = $req->nik;
        $suratTidakMampu->tempat_lahir = $req->tempat_lahir;
        $suratTidakMampu->tgl_lahir = $req->tgl_lahir;
        $suratTidakMampu->jenis_kelamin = $req->jenis_kelamin;
        $suratTidakMampu->status_perkawinan = $req->status_perkawinan;
        $suratTidakMampu->agama = $req->agama;
        $suratTidakMampu->pekerjaan_pemohon = $req->pekerjaan_pemohon;
        $suratTidakMampu->alamat = $req->alamat;
        $suratTidakMampu->tgl_surat_dibuat = $req->tgl_surat_dibuat;
        
        // Save the updated data
        $suratTidakMampu->save();
    
        // Redirect or return the appropriate response
        return redirect('/surat-tidak-mampu')->with('message', 'Surat Tidak Mampu berhasil diperbaharui dengan nomor surat: ' . $suratTidakMampu->nomor_surat);
    }
    

    public function surat_tidak_mampu_lihat_data($id) {
        $getData = surat_tidak_mampu::with('getUser')->find($id);
        $getUser = User::all();
        
        return view('DataSurat.SuratKeteranganTidakMampu.lihatsuratTidakMampu', compact('getData', 'getUser'));

    }

    public function cetak_surat_tidak_mampu($id) {

        $getData = surat_tidak_mampu::with('getUser')->find($id);
         // Atur lokal Carbon ke Bahasa Indonesia
         Carbon::setLocale('id');

         // Mendapatkan tanggal hari ini dengan nama bulan dalam bahasa Indonesia
         $tanggal_Surat = Carbon::parse($getData->tgl_surat_dibuat)->translatedFormat('d F Y'); // Format tanggal sesuai kebutuhan Anda
         
         $data = [
             'getData' => $getData,
             // 'getUser' => $getUser,
             'tanggal_Surat' => $tanggal_Surat, // Tambahkan tanggal hari ini ke data yang dikirim ke view
         ];
         
         // Load the view, render PDF content, and prepare headers
         $pdf = FacadePdf::loadView('DataSurat.SuratKeteranganTidakMampu.cetaksuratTidakMampu', $data);
         $content = $pdf->output();
 
         $headers = [
             'Content-Type' => 'application/pdf',
             'Content-Disposition' => 'attachment; filename="Surat_Keterangan_Tidak_Mampu.pdf"',
         ];
 
         // Return response with appropriate headers for new tab download
         return response($content, 200, $headers)
             ->header('Content-Type', 'application/pdf')
             ->header('Content-Disposition', 'attachment; filename="Surat_Keterangan_Tidak_Mampu.pdf"');
     
    }

    public function hapus_surat_tidak_mampu($id) {

        $data = surat_tidak_mampu::find($id);
        $data->delete();

        return redirect()->back()->with('message', 'Surat Tidak Mampu dengan nomor ' . $data->nomor_surat . ' Berhasil dihapus');
    }



// =======================Section Surat Domisili============================

    public function surat_domisili(Request $r){

        $search = $r->input('search');

        $getData = surat_domisili::where('nama_lengkap', 'like', "%{$search}%")
        ->orWhere('nik', 'like', "%{$search}%")
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('DataSurat.SuratKeteranganDomisili.suratDomisili', compact('getData'));
    }

    public function surat_domisili_add(){
        
        $getUser = User::all();
        return view('DataSurat.SuratKeteranganDomisili.addsuratDomisili', compact('getUser'));
    
    }

    public function surat_domisili_add_save(Request $req){
        $req->validate([
            'tanda_tangan' => 'required|exists:users,id',
            'nama_lengkap' => 'required|min:3',
            'nik' => 'required|numeric',
            'tempat_lahir' => 'required|min:2',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'kewarganegaraan' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan_pemohon' => 'required',
            'alamat' => 'required',
            'tgl_surat_dibuat' => 'required|date',
        ]);

        // Extract bulan dan tahun dari tanggal_surat_dibuat
        $tanggalSuratDibuat = Carbon::parse($req->tgl_surat_dibuat);
        $bulanSuratDibuat = $tanggalSuratDibuat->format('m');
        $tahunSuratDibuat = $tanggalSuratDibuat->format('Y');

        // Hitung nomor surat berdasarkan urutan surat per bulan
        $countSuratBulanIni = surat_domisili::whereYear('tgl_surat_dibuat', $tahunSuratDibuat)
            ->whereMonth('tgl_surat_dibuat', $bulanSuratDibuat)
            ->count();
        $nomorSuratBerikutnya = $countSuratBulanIni + 1;

        // Fungsi untuk mengubah bulan menjadi format Romawi
        function bulanRomawiSuratDomisili($bulan)
        {
            $bulanRomawi = [
                1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
                5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
                9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
            ];
            return $bulanRomawi[intval($bulan)];
        }

        $bulanSuratDibuatRomawi = bulanRomawiSuratDomisili($bulanSuratDibuat);

        // Susun nomor surat
        $nomorSurat = sprintf("140/%03d/KM-MES/%s/%s", 
            $nomorSuratBerikutnya, 
            $bulanSuratDibuatRomawi, 
            $tahunSuratDibuat);
        
        $new = new surat_domisili();
        $new->tanda_tangan = $req->tanda_tangan;
        $new->nomor_surat = $nomorSurat;
        $new->nama_lengkap = $req->nama_lengkap;
        $new->nik = $req->nik;
        $new->tempat_lahir = $req->tempat_lahir;
        $new->tgl_lahir = $req->tgl_lahir;
        $new->jenis_kelamin = $req->jenis_kelamin;
        $new->kewarganegaraan = $req->kewarganegaraan;
        $new->agama = $req->agama;
        $new->status_perkawinan = $req->status_perkawinan;
        $new->pekerjaan_pemohon = $req->pekerjaan_pemohon;
        $new->alamat = $req->alamat;
        $new->tgl_surat_dibuat = $req->tgl_surat_dibuat;
        $new->save();

        // dd($new);

        return redirect('/surat-domisili')->with('message', 'Surat Keterangan Domisili berhasil dibuat dengan nomor surat: ' . $nomorSurat);
    }



    public function surat_domisili_edit($id){

        $getData = surat_domisili::with('getUser')->find($id);
        $getUser = User::all(); 

        return view('DataSurat.SuratKeteranganDomisili.editsuratDomisili', compact('getData','getUser'));
    
    }
    public function surat_domisili_edit_save(Request $req, $id) {
        // Validasi input
        $req->validate([
            'tanda_tangan' => 'required|exists:users,id',
            'nama_lengkap' => 'required|min:3',
            'nik' => 'required|numeric',
            'tempat_lahir' => 'required|min:2',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'kewarganegaraan' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan_pemohon' => 'required',
            'alamat' => 'required|min:5',
            'tgl_surat_dibuat' => 'required|date',
        ]);
    
        // Temukan data surat domisili berdasarkan id
        $suratDomisili = surat_domisili::find($id);
        if (!$suratDomisili) {
            return redirect('/surat-domisili')->withErrors('Data surat domisili tidak ditemukan.');
        }
    
        // Check if the tgl_surat_dibuat is changed
        if ($req->tgl_surat_dibuat != $suratDomisili->tgl_surat_dibuat) {
            // Extract bulan dan tahun dari tanggal_surat_dibuat
            $tanggalSuratDibuat = Carbon::parse($req->tgl_surat_dibuat);
            $bulanSuratDibuat = $tanggalSuratDibuat->format('m');
            $tahunSuratDibuat = $tanggalSuratDibuat->format('Y');
    
            // Hitung nomor surat berdasarkan urutan surat per bulan
            $countSuratBulanIni = surat_domisili::whereYear('tgl_surat_dibuat', $tahunSuratDibuat)
                ->whereMonth('tgl_surat_dibuat', $bulanSuratDibuat)
                ->count();
            $nomorSuratBerikutnya = $countSuratBulanIni + 1;
    
            // Fungsi untuk mengubah bulan menjadi format Romawi
            function bulanRomawiSuratDomisili($bulan) {
                $bulanRomawi = [
                    1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
                    5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
                    9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
                ];
                return $bulanRomawi[intval($bulan)];
            }
    
            $bulanSuratDibuatRomawi = bulanRomawiSuratDomisili($bulanSuratDibuat);
    
            // Susun nomor surat
            $nomorSurat = sprintf("140/%03d/KM-MES/%s/%s", 
                $nomorSuratBerikutnya, 
                $bulanSuratDibuatRomawi, 
                $tahunSuratDibuat);
    
            // Perbarui nomor surat
            $suratDomisili->nomor_surat = $nomorSurat;
        }
    
        // Perbarui field lainnya
        $suratDomisili->tanda_tangan = $req->tanda_tangan;
        $suratDomisili->nama_lengkap = $req->nama_lengkap;
        $suratDomisili->nik = $req->nik;
        $suratDomisili->tempat_lahir = $req->tempat_lahir;
        $suratDomisili->tgl_lahir = $req->tgl_lahir;
        $suratDomisili->jenis_kelamin = $req->jenis_kelamin;
        $suratDomisili->kewarganegaraan = $req->kewarganegaraan;
        $suratDomisili->agama = $req->agama;
        $suratDomisili->status_perkawinan = $req->status_perkawinan;
        $suratDomisili->pekerjaan_pemohon = $req->pekerjaan_pemohon;
        $suratDomisili->alamat = $req->alamat;
        $suratDomisili->tgl_surat_dibuat = $req->tgl_surat_dibuat;
    
        // Save the updated data
        $suratDomisili->save();
    
        // Redirect or return the appropriate response
        return redirect('/surat-domisili')->with('message', 'Surat Keterangan Domisili berhasil diperbaharui dengan nomor surat: ' . $suratDomisili->nomor_surat);
    }
    

    public function surat_domisili_lihat_data($id){
        $getData = surat_domisili::with('getUser')->find($id);
        $getUser = User::all();
        
        return view('DataSurat.SuratKeteranganDomisili.lihatsuratDomisili', compact('getData', 'getUser'));

    }

    public function cetak_surat_domisili($id){

        $getData = surat_domisili::with('getUser')->find($id);
         // Atur lokal Carbon ke Bahasa Indonesia
         Carbon::setLocale('id');

         // Mendapatkan tanggal hari ini dengan nama bulan dalam bahasa Indonesia
         $tanggal_Surat = Carbon::parse($getData->tgl_surat_dibuat)->translatedFormat('d F Y'); // Format tanggal sesuai kebutuhan Anda
         
         $data = [
             'getData' => $getData,
             // 'getUser' => $getUser,
             'tanggal_Surat' => $tanggal_Surat, // Tambahkan tanggal hari ini ke data yang dikirim ke view
         ];
         
         // Load the view, render PDF content, and prepare headers
         $pdf = FacadePdf::loadView('DataSurat.SuratKeteranganDomisili.cetaksuratDomisili', $data);
         $content = $pdf->output();
 
         $headers = [
             'Content-Type' => 'application/pdf',
             'Content-Disposition' => 'attachment; filename="Surat_Keterangan_Domisili.pdf"',
         ];
 
         // Return response with appropriate headers for new tab download
         return response($content, 200, $headers)
             ->header('Content-Type', 'application/pdf')
             ->header('Content-Disposition', 'attachment; filename="Surat_Keterangan_Domisili.pdf"');
     
    }

    public function hapus_surat_domisili($id){
        
        $data = surat_domisili::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Surat Keterangan Domisili berhasil dihapus dengan nomor surat: ' . $data->nomor_surat);

    }

}

