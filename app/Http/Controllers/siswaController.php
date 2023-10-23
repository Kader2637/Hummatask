<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siswaController extends Controller
{
    protected function dashboard()
    {
        return response()->view('siswa.dashboard');
    }
}
