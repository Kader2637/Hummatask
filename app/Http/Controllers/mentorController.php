<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Presentasi;
use App\Models\Project;
use App\Models\Tema;
use App\Models\Tim;
use Carbon\Carbon;
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
        $project = Project::with('tim', 'tema')->where('status_project', 'approved')->get();
        return response()->view('mentor.projek', compact('project', 'project'));
    }

    // Return view detail projek mentor
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
        $presentasi = Presentasi::where('status_pengajuan', 'menunggu')->get();
        $jadwal = [];
        $hari = [];

        foreach ($presentasi as $i => $data) {
            $jadwal[] = Carbon::parse($data->jadwal)->isoFormat('DD MMMM YYYY');
            $hari[] = Carbon::parse($data->jadwal)->isoFormat('dddd');
        }

        // dd($hari);

        // dd($presentasi[0]->tim()->first()->ketuaMagang()->first());
        return response()->view('mentor.presentasi', compact('presentasi', 'jadwal', 'hari'));
    }
}
