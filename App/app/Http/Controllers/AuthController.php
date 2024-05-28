<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){

        return view('authViews.login');
    }

    public function login_proses (Request $request){

        $request -> validate([
            "email" => 'required|max:50|email|exists:users,email',
            "password" => 'required',
        ]);

        $user = User::where('email',$request->email)->first();

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // if (Auth::attempt($infoLogin)) {

        //     if ($user->level === 'admin') {

        //         return redirect('/dashboard');

        //     } else if ($user->level === 'rt') {

        //         return redirect('/dashboard/rt');

        //     } else if ($user->level === 'user') {

        //         return redirect('/dashboard/umkm');
                
        //     } 
                
        // }else{
            // return redirect()->back()->withErrors(['password' => 'Password is Invalid']);
        // }

        if (Auth::attempt($infoLogin)) {
            return redirect('/beranda');

        }else{
            
            return redirect()->back()->withErrors(['password' => 'Password is Invalid']);

        }

    }

    public function logout(){

        Auth::logout();
        return redirect('/');

    }
}
