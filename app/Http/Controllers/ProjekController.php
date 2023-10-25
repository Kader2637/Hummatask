<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjekController extends Controller
{
    protected function projekPage()
    {
        return view('mentor.projek');
    }

    protected function detailProjekPage()
    {
        return view('mentor.detail-projek');
    }

}
