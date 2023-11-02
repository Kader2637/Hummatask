<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\HistoryPresentasi;
use App\Models\Presentasi;
use App\Models\Project;
use App\Models\Tema;
use App\Models\StatusTim;
use App\Models\Tim;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Polyfill\Intl\Idn\Idn;

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
        $projects = Project::with('tim.anggota.user')->where('status_project', 'notapproved')->get();

        return response()->view('mentor.pengajuan-projek', compact('projects'));
    }

    // Return view detail pengajuan projek mentor
    protected function detailPengajuanPage($code)
    {
        $projects = Project::where('code', $code)->firstOrFail();
        $tema = Tema::where('code', $code)->get();

        return response()->view('mentor.detail-pengajuan', compact('projects', 'tema'));
    }

    // Return view projek mentor
    protected function projekPage()
    {
        $projects = Project::with('tim', 'tema')
            ->where('status_project', 'approved')
            ->get();

        $anggota = $projects->flatMap(function ($project) {
            return $project->tim->anggota;
        });

        $users = User::where('peran_id', 1)
            ->whereDoesntHave('tim', function ($query) {
                $query->where('kadaluwarsa', true);
            })
            ->get();

        $status_tim = StatusTim::whereNot('status', 'solo')->get();
        return response()->view('mentor.projek', compact('users', 'status_tim', 'projects', 'anggota'));
    }



    protected function detailProjekPage($code)
    {
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->anggota()->get();
        $project = $tim->project()->first();

        return response()->view('mentor.detail-projek', compact('tim', 'anggota', 'project'));
    }

    // Return view profile mentor
    protected function profilePage()
    {
        return response()->view('mentor.profile-mentor');
    }

    // return view presentasi mentor
    protected function presentasi()
    {
    $presentasi = Presentasi::all();
    $historyPresentasi = HistoryPresentasi::all();
    $persetujuan_presentasi = $presentasi->where('status_pengajuan','menunggu');
    $konfirmasi_presentasi = $presentasi->where('status_pengajuan','disetujui')->where('status_presentasi','menunggu');
    $jadwal =[];
    $hari=[];

    // dd($konfirmasi_presentasi);

    foreach ($presentasi as $i => $data) {
        $jadwal[] = Carbon::parse($data->jadwal)->isoFormat('DD MMMM YYYY');
        $hari[] = Carbon::parse($data->jadwal)->isoFormat('dddd') ;
    }
        return response()->view('mentor.presentasi',compact('persetujuan_presentasi','konfirmasi_presentasi','jadwal','hari','historyPresentasi'));
    }
}
