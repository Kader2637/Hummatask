<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanProjekController extends Controller
{
    protected function pengajuanProjekPage()
    {
        return view('mentor.pengajuan-projek');
    }

    protected function detailPengajuanPage()
    {
        return view('mentor.detail-pengajuan');
    }
}
