<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tim;
use App\Models\Anggota;
use App\Models\StatusTim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KetuaMagangController extends Controller
{

    protected function dashboardPage()
    {
        $title = "Dashboard Ketua Magang";
        $tims = Anggota::with('tim')->where('user_id', Auth::user()->id)->get();
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
        $users = User::where('peran_id',1)
        ->whereDoesntHave('tim', function($query){
            $query->where('kadaluwarsa', true);
        })
        ->get();
        $status_tim = StatusTim::whereNot('status','solo')->get();
        return view('ketuaMagang.project', compact('title', 'tims','users','status_tim' , 'project'));
    }
    protected function detailProject($code)
    {
        $title = "Detail Project Ketua Magang";
        $tims = User::find(Auth::user()->id)->tim()->get();
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->anggota()->get();
        $project = $tim->project()->first();
        // $tims = Anggota::with('tim')->where('user_id', Auth::user()->id)->get();
        return view('ketuaMagang.project',compact('title','tims','tim', 'anggota', 'project'));
    }

    protected function historyPage()
    {
        $title = "History Ketua Magang";
        $tims = User::find(Auth::user()->id)->tim()->get();
        return view('ketuaMagang.history', compact('title', 'tims'));
    }
}
