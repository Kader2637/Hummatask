<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileSiswaController extends Controller
{
    protected function profilePage()
    {
        $title = 'Profile Siswa';
        return response()->view('siswa.profile-siswa', compact('title'));
    }
}
