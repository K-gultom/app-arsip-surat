<?php

namespace App\Http\Controllers;

use App\Models\bagian;
use Illuminate\Http\Request;

class BagianController extends Controller
{
    public function bagian(Request $r){

        $search = $r->input('search');
        $getData = bagian::where('nama_bagian', 'like', "%{$search}%")->paginate(10);

        // dd($getData);
        return view('Bagian.bagian', compact('getData'));

    }

    public function bagianAdd(){
        return view('Bagian.addBagian');
    }
    public function bagianAdd_save(Request $req){

        $req->validate([
            'nama_bagian' => 'required|unique:bagians,nama_bagian',
        ]);

        $new =  new bagian();
        $new->nama_bagian = $req->nama_bagian;
        $new->save();

        return redirect('/bagian')->with('message', 'Tambah Data Bagian Berhasil!!!');

    }

    public function bagian_Edit($id){

        $getedit = bagian::find($id);
        $getData = bagian::paginate(10);
        return view('Bagian.editBagian', compact('getedit', 'getData'));

    }
    
    public function bagian_Edit_save(Request $req, $id){

        $req->validate([
            'nama_bagian' => 'required|unique:bagians,nama_bagian',
        ]);

        $new =  bagian::find($id);
        $new->nama_bagian = $req->nama_bagian;
        $new->save();

        return redirect('/bagian')->with('message', 'Data Bagian Berhasil diUbah!!!');

    }
    public function destroy($id){

        $getDelete = bagian::find($id);
        $getDelete -> delete();

        return redirect('/bagian')->with('message', 'Data Bagian Berhasil diHapus!!!');
    }
}
