<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KetuaMagangController extends Controller
{

    protected function dashboardPage()
    {
        $title = "Dashboard Ketua Magang";
        $tims = User::find(Auth::user()->id)->tim()->get();
        $usercount = User::where('peran_id', 1)->count();
        $timcount = Tim::where('kadaluwarsa', 0)->count();

        return view('ketuaMagang.dashboard', compact('title', 'tims', 'usercount', 'timcount'));
    }
    protected function presentasiPage()
    {
        $title = "Presentasi Ketua Magang";
        $tims = User::find(Auth::user()->id)->tim()->get();

        return view('ketuaMagang.presentasi', compact('title', 'tims'));
    }
    protected function projectPage()
    {
        $title = "Project Ketua Magang";
        $tims = User::find(Auth::user()->id)->tim()->get();
        $project = Project::with('tim', 'tema')->where('status_project', 'approved')->get();

        return view('ketuaMagang.project', compact('title', 'tims', 'project'));
    }
    protected function detailProject($code)
    {
        $title = "Detail Project Ketua Magang";
        $tims = User::find(Auth::user()->id)->tim()->get();
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->anggota()->get();
        $project = $tim->project()->first();

        return view('ketuaMagang.detail_project', compact('title', 'tims', 'tim', 'anggota', 'project'));
    }
    protected function historyPage()
    {
        $title = "History Ketua Magang";
        $tims = User::find(Auth::user()->id)->tim()->get();

        return view('ketuaMagang.history', compact('title', 'tims'));
    }
}
