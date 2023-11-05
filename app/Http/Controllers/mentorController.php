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
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class mentorController extends Controller
{
    // Return view dashboard mentor
    protected function dashboard()
    {
        $jadwal = [];
        $hari = [];
        $presentasi = Presentasi::with('tim')->where('status_pengajuan', 'disetujui')->latest('created_at')->take(5)->get()->reverse();
        foreach ($presentasi as $i => $data) {
            $jadwal[] = Carbon::parse($data->jadwal)->isoFormat('DD MMMM YYYY');
            $hari[] = Carbon::parse($data->jadwal)->isoFormat('dddd');
        }
        $jadwal = array_reverse($jadwal);
        $hari = array_reverse($hari);

        $data = Presentasi::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            'status_pengajuan',
            DB::raw('count(*) as total')
        )
            ->whereIn('status_pengajuan', ['disetujui'])
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('year', 'month', 'status_pengajuan')
            ->get();

        $users = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            'peran_id',
            DB::raw('count(*) as total')
        )
            ->whereIn('peran_id', ['1'])
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('year', 'month', 'peran_id')
            ->get();

        $processedData = [];
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($currentYear, $month, 1);
            $yearMonth = $date->isoFormat('MMMM');

            $color = ($month == $currentMonth) ? 'blue' : 'yellow';
            $colorwait = ($month == $currentMonth) ? 'grey' : 'yellow';

            $processedData[$yearMonth] = [
                'month' => $yearMonth,
                'disetujui' => 0,
                '1' => 0,
                'color' => $color,
                'colorwait' => $colorwait
            ];
        }

        foreach ($data as $item) {
            $yearMonth = Carbon::createFromDate($item->year, $item->month, 1)->isoFormat('MMMM');

            if (isset($processedData[$yearMonth])) {
                $status_pengajuan = strtolower($item->status_pengajuan);
                $processedData[$yearMonth][$status_pengajuan] = $item->total;
            }
        }

        foreach ($users as $user) {
            $yearMonth = Carbon::createFromDate($user->year, $user->month, 1)->isoFormat('MMMM');

            if (isset($processedData[$yearMonth])) {
                $processedData[$yearMonth]['1'] = $user->total;
            }
        }

        $chartData = array_values($processedData);
        return response()->view('mentor.dashboard', compact('presentasi', 'chartData', 'jadwal', 'hari'));
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

    protected function Project()
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
        return response()->json(['projects' => $projects, 'anggota' => $anggota, 'users' => $users, 'status_tim' => $status_tim]);
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

        $dataPresentasi = Presentasi::where('jadwal',Carbon::now()->isoFormat('Y-M-DD'))->where('status_pengajuan','disetujui')->get()->count();
        
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
