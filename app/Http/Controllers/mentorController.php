<?php

namespace App\Http\Controllers;

use App\Models\HistoriPengelola;
use App\Models\HistoryPresentasi;
use App\Models\PenglolaMagang;
use App\Models\Presentasi;
use App\Models\Project;
use App\Models\Tema;
use App\Models\StatusTim;
use App\Models\Tim;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
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

        $tim = Tim::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            'kadaluwarsa',
            DB::raw('count(*) as total')
        )
            ->whereIn('kadaluwarsa', ['1'])
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('year', 'month', 'kadaluwarsa')
            ->get();

        $processedData = [];
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($currentYear, $month, 1);
            $yearMonth = $date->isoFormat('MMMM');

            $color = ($month == $currentMonth) ? 'blue' : 'yellow';
            $colorwait = ($month == $currentMonth) ? 'grey' : 'pink';
            $colors = ($month == $currentMonth) ? 'red' : 'green';

            $processedData[$yearMonth] = [
                'month' => $yearMonth,
                'disetujui' => 0,
                '1' => 0,
                '2' => 0,
                'color' => $color,
                'colorwait' => $colorwait,
                'colors' => $colors
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
        foreach ($tim as $tims) {
            $yearMonth = Carbon::createFromDate($tims->year, $tims->month, 1)->isoFormat('MMMM');

            if (isset($processedData[$yearMonth])) {
                $processedData[$yearMonth]['2'] = $tims->total;
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
        $magang = PenglolaMagang::all();

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

        foreach ($penggunaDenganPeran as $pengguna) {
            if (!$pengguna->hasRole('ketua magang')) {
                HistoriPengelola::create([
                    'user_id' => $pengguna->id,
                    'action' => 'Diberikan peran Pengelola Magang',
                    'role' => 'ketua magang',
                    'name' => $pengguna->name,
                    'email' => $pengguna->email,
                ]);
            }
        }

        foreach ($users as $user) {
            $penglolaMagang = PenglolaMagang::where('user_id', $user->id)->first();

            if ($penglolaMagang && $penglolaMagang->akhir_menjabat < Carbon::now()) {
                PenglolaMagang::where('user_id', $user->id)
                    ->update(['masih_menjabat' => false]);

                $updatedPenglolaMagang = PenglolaMagang::where('user_id', $user->id)->first();

                if ($updatedPenglolaMagang && !$updatedPenglolaMagang->masih_menjabat) {
                    $user->removeRole('ketua magang');
                }
            }
        }

        return response()->view('mentor.pengguna', compact('users', 'pengelolaMagang', 'bukanPengelolaMagang', 'mentors', 'roles','magang'));
    }

    // Return view history mentor
    protected function history()
    {
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

        return response()->view('mentor.history', compact('telatDeadline', 'presentasiSelesai', 'timSolo', 'timGroup'));
    }

    // Return view pengajuan projek mentor
    protected function pengajuanProjekPage()
    {
        $projects = Project::with('tim.anggota.user', 'tim.tema', 'anggota.jabatan', 'anggota.user')->where('status_project', 'notapproved')->paginate(12);

        return response()->view('mentor.pengajuan-projek', compact('projects'));
    }

    // Return view detail pengajuan projek mentor
    protected function detailPengajuan($code)
    {
        $projects = Project::where('code', $code)->firstOrFail();

        return response()->view('mentor.detail-pengajuan', compact('projects'));
    }

    // Return view projek mentor
    protected function projekPage()
    {
        $pengajuan = Project::with('tim.anggota.user', 'tim.tema', 'anggota.jabatan', 'anggota.user')->where('status_project', 'notapproved')->paginate(5);
        $projects = Project::with('tim.anggota', 'tema')
            ->where('status_project', 'approved')
            ->paginate(5);

        $request = Request::instance();
        $code = $request->input('temaProjek');
        $projek = Tim::query();
        // dd($projects);
        if ($code === 'all') {
            // Tidak ada filter, tampilkan semua proyek
        } elseif ($code === 'solo') {
            $projek->where('status_tim', 'solo');
        } elseif ($code === 'pre_mini') {
            $projek->where('status_tim', 'pre_mini');
        } elseif ($code === 'mini') {
            $projek->where('status_tim', 'mini');
        } elseif ($code === 'big') {
            $projek->where('status_tim', 'big');
        }

        $projek = $projek->get();

        $users = User::where('peran_id', 1)
            ->whereDoesntHave('tim', function ($query) {
                $query->where('kadaluwarsa', true);
            })
            ->get();
        $tim = Tim::all();

        $status_tim = StatusTim::whereNot('status', 'solo')->get();
        $tims = Tim::with('user')->where('kadaluwarsa', '1')->paginate(5);
        $members = Tim::with('user')->where('kadaluwarsa', '1')->get();

        return response()->view('mentor.projek', compact('members', 'tims', 'pengajuan', 'projek', 'users', 'status_tim', 'projects', 'tim'));
    }

    protected function Project(Request $request)
    {
        $projects = Project::with('tim', 'tema')
            ->where('status_project', 'approved')
            ->get();

        $anggota = $projects->flatMap(function ($project) {
            return $project->tim->anggota;
        });

        $users = User::where('peran_id', 1)
            ->whereDoesntHave('tim', function ($query) {
                $query->where('kadaluwarsa', false);
            })
            ->get();
        $status_tim = StatusTim::whereNot('status', 'solo')->get();

        $request = Request::instance();
        $code = $request->input('temaProjek');
        $projects = Tim::query();

        if ($code === 'solo') {
            $projects->where('status_tim', 'solo');
        } elseif ($code === 'pre_mini') {
            $projects->where('status_tim', 'pre_mini');
        } elseif ($code === 'mini') {
            $projects->where('status_tim', 'mini');
        } elseif ($code === 'big') {
            $projects->where('status_tim', 'big');
        }

        $projects = $projects->get();

        return response()->json(['projects' => $projects, 'anggota' => $anggota, 'users' => $users, 'status_tim' => $status_tim]);
    }

    protected function tim()
    {
        $tims = tim::with('user')->paginate(2);
        $status_tim = StatusTim::whereNot('status', 'solo')->get();
        return response()->view('mentor.tim', compact('tims', 'status_tim'));
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
