<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BagianController extends Controller
{
    public function bagian(){

        return view('Bagian.bagian');

    }

    public function bagian_Add(){

        return view('Bagian.addBagian');

    }
}
