<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KetuaMagangController extends Controller
{

    protected function dashboardPage(){
        $title = "ketua.dashboard";
        return view('ketuaMagang.dashboard',compact('title'));
    }
    protected function presentasiPage(){
        $title = "ketua.presentasi";
        return view('ketuaMagang.presentasi',compact('title'));
    }
    protected function projectPage(){
        $title = "ketua.project";
        return view('ketuaMagang.project',compact('title'));
    }
    protected function detailProject(){
        $title = "ketua.detail_project";
        return view('ketuaMagang.detail_project',compact('title'));
    }
    protected function historyPage(){
        $title = "ketua.history";
        return view('ketuaMagang.history',compact('title'));
    }
}
