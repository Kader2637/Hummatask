<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siswaController extends Controller
{
    // Return view dashboard siswa
    protected function dashboard()
    {
        $title = "Dashboard";
        return response()->view('siswa.dashboard', compact('title'));
    }

    // Return view profile siswa
    protected function profilePage()
    {
        $title = 'Profile Siswa';
        return response()->view('siswa.profile-siswa', compact('title'));
    }

}
