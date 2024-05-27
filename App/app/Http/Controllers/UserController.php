<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    
    // Proses Untuk menampilkan halaman data user
    public function user(){

        $getUser = User::paginate(10);
        return view('User.user', compact('getUser'));
    }
    
    // Proses Untuk Simpan Data User get
    public function user_add(){
        return view('User.addUser');
    }

    // Proses Untuk Simpan Data User post
    public function user_save(Request $req){

        $req->validate([
            'name' => 'required|min:3',
            'Jabatan' => 'required|min:3',
            'alamat' => 'required|min:5',
            'telp' => 'required|min:8|max:14',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'level' => 'required',
        ]);

        $new                = new User();
        $new->name          = $req->name;
        $new->Jabatan       = $req->Jabatan;
        $new->alamat        = $req->alamat;
        $new->telp          = $req->telp;
        $new->email         = $req->email;
        $new->password      = Hash::make($req->password);
        $new->level         = $req->level;
        $new->save();

        return redirect('/user')->with('message', 'Tambah Data User Berhasil!!!');
    }

    // Proses Untuk Ubah Data User get
    public function user_edit($id){

        $getData = User::find($id);
        return view('User.editUser', compact('getData'));
    }

    // Proses Untuk Ubah Data User post
    public function user_edit_save(Request $req, $id){

        $req->validate([
            'name' => 'required|min:3',
            'Jabatan' => 'required|min:3',
            'alamat' => 'required|min:5',
            'telp' => 'required|min:8|max:14',
            'email' => 'required|unique:users,email',
            'level' => 'required',
        ]);

        $new                = User::find($id);
        $new->name          = $req->name;
        $new->Jabatan       = $req->Jabatan;
        $new->alamat        = $req->alamat;
        $new->telp          = $req->telp;
        $new->email         = $req->email;
        $new->level         = $req->level;
        $new->save();

        return redirect('/user')->with('message', 'Data User Berhasil diUpdate!!!');
    }

    // Untuk Lihat Data
    public function user_data($id){

        $getData = User::find($id);
        return view('User.dataUser', compact('getData'));
    }

    // Proses Untuk Ubah Password get
    public function user_password($id){

        $getData = User::find($id);

        return view('User.ubahPassword', compact('getData'));
    }

    // Proses Untuk Ubah Password Post
    public function user_password_save(Request $req, $id){
        
        $req->validate([
            'password' => 'min:6',
        ]);

        $new = User::find($id);
        $new->password = Hash::make($req->password);
        $new->save();
        
        return redirect('/user')->with('message', 'Password Berhasil Diubah!!!');
    }

    public function destroy($id){

        $getData = User::find($id);
        $getData->delete();
        
        return redirect()->back()->with('message', 'Data User Berhasil Dihapus!!!');
    }
}
