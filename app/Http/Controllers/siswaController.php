<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siswaController extends Controller
{
    protected function dashboard()
    {
        $title = "Dashboard";
        return response()->view('siswa.dashboard', compact('title'));
    }

}
