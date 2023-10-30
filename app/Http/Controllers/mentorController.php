<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mentorController extends Controller
{
    // Return view dashboard mentor
    protected function dashboard()
    {
        return response()->view('mentor.dashboard');
    }

    // Return view pengguna mentor
    protected function pengguna()
    {
        return response()->view('mentor.pengguna');
    }

    // Return view history mentor
    protected function history()
    {
        return response()->view('mentor.history');
    }

    // Return view pengajuan projek mentor
    protected function pengajuanProjekPage()
    {
        return response()->view('mentor.pengajuan-projek');
    }

    // Return view detail pengajuan projek mentor
    protected function detailPengajuanPage()
    {
        return response()->view('mentor.detail-pengajuan');
    }

    // Return view projek mentor
    protected function projekPage()
    {
        return response()->view('mentor.projek');
    }

    // Return view detail projek mentor
    protected function detailProjekPage()
    {
        return response()->view('mentor.detail-projek');
    }

    // Return view profile mentor
    protected function profilePage()
    {
        return response()->view('mentor.profile-mentor');
    }

    // return view presentasi mentor
    protected function presentasi()
    {
        return response()->view('mentor.presentasi');
    }
}
