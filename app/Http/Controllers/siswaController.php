<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class siswaController extends Controller
{
    // Return view dashboard siswa
    protected function dashboard()
    {
        $title = "Dashboard";
        $tims = User::find(Auth::user()->id)->tim()->get();
        // dd($tims);
        return response()->view('siswa.dashboard', compact('title','tims'));
    }

    // Return view profile siswa
    protected function profilePage()
    {
        $title = 'Profile Siswa';
        $user = User::with('peran')->where('id', Auth::user()->id)->first();
        return response()->view('siswa.profile-siswa', compact('title', 'user'));
    }
}
