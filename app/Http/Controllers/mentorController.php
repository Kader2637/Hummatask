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
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

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
        $roles = Role::all();
        $mentors = User::where('peran_id', 2)->get();
        $users = User::with('peran')->where('peran_id', 1)->get();
        $pengelolaMagang = new Collection();
        $bukanPengelolaMagang = new Collection();

        foreach ($roles as $peran) {
            $penggunaDenganPeran = User::whereHas('roles', function ($query) use ($peran) {
                $query->where('name', $peran->name);
            })->get();
            $pengelolaMagang = $pengelolaMagang->concat($penggunaDenganPeran);

            $bukanPengelolaMagang = User::whereDoesntHave('permissions', function ($query) use ($peran) {
                $query->where('name', $peran);
            })->get();
            $bukanPengelolaMagang = $bukanPengelolaMagang->concat($penggunaDenganPeran);
        }

        return response()->view('mentor.pengguna', compact('users', 'pengelolaMagang', 'bukanPengelolaMagang', 'mentors', 'roles'));
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
        $anggota = $projects->tim->user;
        $tema = $projects->tim->tema;

        $data = [
            'anggota' => $anggota,
            'tema' => $tema,
        ];

        return response()->view('mentor.detail-pengajuan', compact('projects'));
    }

    // Return view projek mentor
    protected function projekPage()
    {
        $projects = Project::with('tim.anggota', 'tema')
            ->where('status_project', 'approved')
            ->get();

        $projects = $projects->map(function ($project) {
            if ($project->type_project === 'solo') {
                $project->type_project = 'Solo Project';
            } elseif ($project->type_project === 'pre_mini') {
                $project->type_project = 'Pre Mini Project';
            }

            return $project;
        });


        $users = User::where('peran_id', 1)
            ->whereDoesntHave('tim', function ($query) {
                $query->where('kadaluwarsa', true);
            })
            ->get();

        $status_tim = StatusTim::whereNot('status', 'solo')->get();
        return response()->view('mentor.projek', compact('users', 'status_tim', 'projects'));
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
        $persetujuan_presentasi = $presentasi->where('status_pengajuan', 'menunggu');
        $konfirmasi_presentasi = $presentasi->where('status_pengajuan', 'disetujui')->where('status_presentasi', 'menunggu');
        $jadwal = [];
        $hari = [];
        foreach ($presentasi as $i => $data) {
            $jadwal[] = Carbon::parse($data->jadwal)->isoFormat('DD MMMM YYYY');
            $hari[] = Carbon::parse($data->jadwal)->isoFormat('dddd');
        }
        return response()->view('mentor.presentasi', compact('persetujuan_presentasi', 'konfirmasi_presentasi', 'jadwal', 'hari', 'historyPresentasi'));
    }
}
