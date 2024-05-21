<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function user(){
        return view('User.user');
    }

    public function user_add(){
        return view('User.addUser');
    }
}
