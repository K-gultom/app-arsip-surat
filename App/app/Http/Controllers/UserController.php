<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    
    // Proses Untuk menampilkan halaman data user
    public function user(Request $r){

        $search = $r->input('search');
        $getUser = User::where('name', 'like', "%{$search}%")
        ->orWhere('Jabatan', 'like', "%{$search}%")
        ->paginate(10);
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

    public function user_edit_save(Request $req, $id){

        // Find the existing user
        $user = User::find($id);

        // Initial validation for all fields except email
        $req->validate([
            'name' => 'required|min:3',
            'Jabatan' => 'required|min:3',
            'alamat' => 'required|min:5',
            'telp' => 'required|min:8|max:14',
            'level' => 'required',
        ]);

        // Additional validation for email if it's different
        if ($req->email !== $user->email) {
            $req->validate([
                'email' => 'required|email|unique:users,email',
            ]);
            $user->email = $req->email;
        }

        // Update the remaining fields
        $user->name = $req->name;
        $user->Jabatan = $req->Jabatan;
        $user->alamat = $req->alamat;
        $user->telp = $req->telp;
        $user->level = $req->level;

        // Save the updated user
        $user->save();

        // Redirect with success message
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
