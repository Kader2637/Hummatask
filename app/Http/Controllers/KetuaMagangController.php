<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KetuaMagangController extends Controller
{

    protected function dashboardPage(){
        $title = "Dashboard Ketua Magang";
        return view('ketuaMagang.dashboard',compact('title'));
    }
    protected function presentasiPage(){
        $title = "Presentasi Ketua Magang";
        return view('ketuaMagang.presentasi',compact('title'));
    }
    protected function projectPage(){
        $title = "Project Ketua Magang";
        return view('ketuaMagang.project',compact('title'));
    }
    protected function detailProject(){
        $title = "ketua.detail_project";
        return view('ketuaMagang.detail_project',compact('title'));
    }
    protected function historyPage(){
        $title = "History Ketua Magang";
        return view('ketuaMagang.history',compact('title'));
    }
}
