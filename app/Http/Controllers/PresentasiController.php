<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresentasiController extends Controller
{
    protected function presentasi(){
        return view('mentor.presentasi');
    }
}
