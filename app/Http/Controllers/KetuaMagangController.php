<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tim;
use App\Models\Anggota;
use App\Models\HistoryPresentasi;
use App\Models\Notifikasi;
use App\Models\Presentasi;
use App\Models\StatusTim;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KetuaMagangController extends Controller
{

    protected function dashboardPage()
    {
        $title = "Dashboard Ketua Magang";
        $usercount = User::where('peran_id', 1)->count();
        $timcount = Tim::where('kadaluwarsa', 0)->count();
        $present = Presentasi::where('status_pengajuan', 'disetujui')->whereDate('created_at', now())->count();
        $tims = User::find(Auth::user()->id)->tim()->get();


        $presentasi = Presentasi::with('tim')->where('status_pengajuan', 'disetujui')->whereDate('created_at', now())->latest('created_at')->take(5)->get()->reverse();

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

        $processedData = [];
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($currentYear, $month, 1);
            $yearMonth = $date->isoFormat('MMMM');

            $color = ($month == $currentMonth) ? 'blue' : 'green';
            $colorwait = ($month == $currentMonth) ? 'grey' : 'green';

            $processedData[$yearMonth] = [
                'month' => $yearMonth,
                'disetujui' => 0,
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

        $chartData = array_values($processedData);
        $notifikasi = Notifikasi::where('user_id', Auth::user()->id)->get();
        return view('ketuaMagang.dashboard', compact('title', 'tims', 'usercount', 'timcount', 'chartData', 'presentasi', 'present','notifikasi'));
    }
    protected function presentasiPage()
    {
        $title = "Presentasi Ketua Magang";
        $presentasi = Presentasi::all();
        $historyPresentasi = HistoryPresentasi::all();
        $persetujuan_presentasi = $presentasi->where('status_pengajuan', 'menunggu');
        $konfirmasi_presentasi = $presentasi->where('status_pengajuan', 'disetujui')->where('status_presentasi', 'menunggu');
        $jadwal = [];
        $hari = [];
        $tims = User::find(Auth::user()->id)->tim()->get();
        foreach ($presentasi as $i => $data) {
            $jadwal[] = Carbon::parse($data->jadwal)->isoFormat('DD MMMM YYYY');
            $hari[] = Carbon::parse($data->jadwal)->isoFormat('dddd');
        }
        $notifikasi = Notifikasi::where('user_id', Auth::user()->id)->get();
        return response()->view('ketuaMagang.presentasi', compact('notifikasi','persetujuan_presentasi', 'konfirmasi_presentasi', 'jadwal', 'hari', 'historyPresentasi', 'title', 'tims'));
    }
    protected function projectPage()
    {
        $title = "Project Ketua Magang";
        $tims = User::find(Auth::user()->id)
            ->tim()
            ->get();
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

        // dd($projects);
        $users = User::where('peran_id', 1)
            ->whereDoesntHave('tim', function ($query) {
                $query->where('kadaluwarsa', true);
            })
            ->get();
        $status_tim = StatusTim::whereNot('status', 'solo')->get();
        $notifikasi = Notifikasi::where('user_id', Auth::user()->id)->get();
        return view('ketuaMagang.project', compact('notifikasi','title', 'tims', 'users', 'status_tim', 'projects'));
    }

    protected function projek()
    {
        $title = "Project Ketua Magang";
        $tims = User::find(Auth::user()->id)->tim()->get();
        $project = Project::with('tim', 'tema')->where('status_project', 'approved')->get();
        $users = User::where('peran_id', 1)
            ->whereDoesntHave('tim', function ($query) {
                $query->where('kadaluwarsa', true);
            })
            ->get();
        $status_tim = StatusTim::whereNot('status', 'solo')->get();

        return response()->json(['project' => $project, 'title' => $title, 'tims' => $tims, 'users' => $users, 'status_tim' => $status_tim]);
    }
    protected function detailProject($code)
    {
        $title = "Detail Project Ketua Magang";
        $tims = User::find(Auth::user()->id)->tim()->get();
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->anggota()->get();
        $project = $tim->project()->first();
        // $tims = Anggota::with('tim')->where('user_id', Auth::user()->id)->get();
        return view('ketuaMagang.project', compact('title', 'tims', 'tim', 'anggota', 'project'));
    }

    protected function historyPage()
    {
        $title = "History Ketua Magang";
        $tims = User::find(Auth::user()->id)->tim()->get();
        $telatDeadline = Project::with('tim.anggota.user', 'tema')
            ->where('deadline', '<', now())
            ->get();
        $presentasiSelesai = Presentasi::with('tim.anggota.user', 'tim.project.tema')
            ->where('status_presentasi', 'selesai')
            ->where('status_pengajuan', 'disetujui')
            ->whereHas('tim.project.tema')
            ->get();
        $timSolo = Tim::with('anggota.user', 'project.tema')
            ->where('status_tim', 'solo')
            ->get();
        $timGroup = Tim::with('anggota.user', 'project.tema')
            ->where('status_tim', '!=', 'solo')
            ->whereHas('project')
            ->get();

            $notifikasi = Notifikasi::where('user_id', Auth::user()->id)->get();

        return view('ketuaMagang.history', compact('notifikasi','title', 'tims', 'telatDeadline', 'presentasiSelesai', 'timSolo', 'timGroup'));
    }
}
