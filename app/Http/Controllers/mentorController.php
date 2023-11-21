<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\HistoriPengelola;
use App\Models\HistoryPresentasi;
use App\Models\Notifikasi;
use App\Models\PenglolaMagang;
use App\Models\Presentasi;
use App\Models\Project;
use App\Models\Tema;
use App\Models\StatusTim;
use App\Models\TidakPresentasiMingguan;
use App\Models\Tim;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use Spatie\Permission\Models\Role;

class mentorController extends Controller
{
    // Return view dashboard mentor
    protected function dashboard()
    {
        $jadwal = [];
        $hari = [];
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        $presentasi = Presentasi::with('tim')->where('status_presentasi', 'selesai')->whereDate('created_at', now())->latest('created_at')->take(5)->get()->reverse();
        foreach ($presentasi as $i => $data) {
            $jadwal[] = Carbon::parse($data->jadwal)->isoFormat('DD MMMM YYYY');
            $hari[] = Carbon::parse($data->jadwal)->isoFormat('dddd');
        }
        $jadwal = array_reverse($jadwal);
        $hari = array_reverse($hari);

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
            'status_tim',
            DB::raw('count(*) as total')
        )
            ->whereIn('status_tim', ['mini', 'pre_mini', 'big'])
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('year', 'month', 'status_tim')
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
            $piecolor = ($month == $currentMonth) ? 'orange' : 'yellow';

            $processedData[$yearMonth] = [
                'month' => $yearMonth,
                'disetujui' => 0,
                '1' => 0,
                'mini' => 0,
                'pre_mini' => 0,
                'big' => 0,
                'color' => $color,
                'colorwait' => $colorwait,
                'colors' => $colors,
                'piecolor' => $piecolor
            ];
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
                $status_tim = strtolower($tims->status_tim);
                $processedData[$yearMonth][$status_tim] = $tims->total;
            }
        }

        $chartData = array_values($processedData);

        $solo = Tim::where(function ($query) {
            $query->whereIn('status_tim', ['solo'])
            ->where('kadaluwarsa', '0');
        })->count();
        $preMini = Tim::where(function ($query) {
            $query->whereIn('status_tim', ['pre_mini'])
                ->where('kadaluwarsa', '0');
        })->count();
        $mini = Tim::where(function ($query) {
            $query->whereIn('status_tim',['mini'])
            ->where('kadaluwarsa','0');
        })->count();
        $big = Tim::where(function ($query) {
            $query->whereIn('status_tim',['big'])
            ->where('kadaluwarsa','0');
        })->count();

        $chart = [
            ['Jumlah', 'Data'],
            ['Jumlah Solo Projek', $solo],
            ['Jumlah Tim Premini Projek', $preMini],
            ['Jumlah Tim Mini Projek', $mini],
            ['Jumlah Tim Big Projek', $big]
        ];
        return response()->view('mentor.dashboard', compact('presentasi', 'chartData', 'jadwal', 'hari', 'chart', 'notifikasi'));
    }

    // Return view pengguna mentor
    protected function pengguna()
    {
        $roles = Role::all();
        $mentors = User::where('peran_id', 2)->get();
        $users = User::with('peran')->where('peran_id', 1)->get();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
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

        return response()->view('mentor.pengguna', compact('users', 'pengelolaMagang', 'bukanPengelolaMagang', 'mentors', 'roles', 'magang', 'notifikasi'));
    }

    // Return view history mentor
    protected function history()
    {
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();

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




        $tidakPresentasiMingguan = TidakPresentasiMingguan::with('tim.ketuaTim')->get();

        return response()->view('mentor.history', compact('tidakPresentasiMingguan', 'telatDeadline', 'presentasiSelesai', 'timSolo', 'timGroup', 'notifikasi'));
    }

    // Return view pengajuan projek mentor
    protected function pengajuanProjekPage(Request $request)
    {
        $projectsQuery = Project::with('tim.anggota.user', 'tim.tema', 'anggota.jabatan', 'anggota.user')
            ->where('status_project', 'notapproved');

        if ($request->has('status_tim')) {
            $projectsQuery->where('type_project', $request->status_tim);
        }

        if ($request->has('nama_tim')) {
            $namaTim = $request->nama_tim;
            $projectsQuery->whereHas('tim', function ($query) use ($namaTim) {
                $query->where('nama', 'like', "%$namaTim%");
            });
        }

        $projects = $projectsQuery->paginate(12);

        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        return response()->view('mentor.pengajuan-projek', compact('projects', 'notifikasi'));
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
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        $projects = Project::with('tim.anggota', 'tema', 'tim.tugas')
            ->where('status_project', 'approved')
            ->paginate(5);

        $users = User::where('peran_id', 1)
            ->whereDoesntHave('tim', function ($query) {
                $query->where('kadaluwarsa', true);
            })
            ->get();

        return response()->view('mentor.projek', compact('users', 'projects', 'notifikasi'));
    }

    protected function pieproject($timId)
    {

        $tim = Tim::where('code', $timId)->first();

        $selesai = $tim->tugas->where('status_tugas', 'selesai')->count();

        $revisi = $tim->tugas->where('status_tugas', 'revisi')->count();

        $tugas_baru = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesai],
            ['Revisi', $revisi],
            ['Tugas Baru', $tugas_baru]
        ];

        return response()->json(['selesai' => $selesai, 'revisi' => $revisi, 'tugas_baru' => $tugas_baru, 'chartData' => $chartData]);
    }

    protected function Project()
    {
        $users = User::where('peran_id', 1)
            ->where(function ($query) {
                $query->whereDoesntHave('tim', function ($query) {
                    $query->where('kadaluwarsa', false);
                })->orWhereHas('tim', function ($query) {
                    $query->whereIn('status', ['kicked', 'expired']);
                });
            })
            ->get();
        $status_tim = StatusTim::whereNot('status', 'solo')->get();
        return response()->json(['users' => $users, 'status_tim' => $status_tim]);
    }

    protected function
    timEdit($tim)
    {

        $ketuaId = Tim::where('id', $tim)
            ->with(['anggota' => function ($query) {
                $query->where('jabatan_id', 1);
            }])
            ->first()
            ->anggota
            ->pluck('user_id');


        $ketua = User::where('peran_id', 1)
            ->whereHas('tim', function ($query) use ($tim) {
                $query->where('id', $tim);
            })
            ->get();
        $users = User::where('peran_id', 1)
            ->where(function ($query) use ($tim) {
                $query->whereDoesntHave('tim', function ($subQuery) {
                    $subQuery->where('kadaluwarsa', false);
                })
                    ->orWhere(function ($subQuery) use ($tim) {
                        $subQuery->whereHas('tim', function ($innerSubQuery) use ($tim) {
                            $innerSubQuery->where('id', $tim);
                        });
                    });
            })
            ->get();

        $status_tim = StatusTim::whereNot('status', 'solo')->get();
        return response()->json(['users' => $users, 'status_tim' => $status_tim, 'ketua' => $ketua, 'ketua_id' => $ketuaId]);
    }



    protected function tim()
    {
        $tims = tim::with('user')->paginate(12);
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        $status_tim = StatusTim::whereNot('status', 'solo')->get();


        return response()->view('mentor.tim', compact('tims', 'status_tim', 'notifikasi'));
    }

    public function filter(Request $request)
    {
        $requestData = $request->all();
        // dd($requestData);
        $status = $request->input('status_tim');
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        if ($status === 'all') {
            $tims = Tim::with('user')->paginate(12);
        } elseif ($status === 'solo') {
            $tims = Tim::with('user')->where('status_tim', 'solo')->paginate(12);
        } elseif ($status === 'pre_mini') {
            $tims = Tim::with('user')->where('status_tim', 'pre_mini')->paginate(12);
        } elseif ($status === 'mini') {
            $tims = Tim::with('user')->where('status_tim', 'mini')->paginate(12);
        } elseif ($status === 'big') {
            $tims = Tim::with('user')->where('status_tim', 'big')->paginate(12);
        } else {
            $tims = Tim::with('user')->paginate(12);
        }

        $status_tim = StatusTim::whereNot('status', 'solo')->get();

        return view('mentor.tim', compact('tims', 'status_tim', 'notifikasi'));
    }

    public function cari(Request $request)
    {
        $namaTim = $request->input('nama_tim');
        $statusTim = $request->input('status_tim');
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        $query = Tim::query();

        if (!empty($namaTim)) {
            $query->where('nama', 'like', '%' . $namaTim . '%');
        }

        if (!empty($statusTim) && $statusTim !== 'all') {
            $query->where('status_tim', $statusTim);
        } else {
            $query->whereIn('status_tim', ['pre_mini', 'big', 'solo', 'mini']);
        }

        $tims = $query->paginate(99999);
        $status_tim = StatusTim::whereNot('status', 'solo')->get();
        // dd($tims);
        return view('mentor.tim', compact('tims', 'status_tim', 'notifikasi'));
    }

    protected function detailProjekPage($code)
    {
        $tim = Tim::where('code', $code)->firstOrFail();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        $anggota = $tim->anggota()->get();
        $project = $tim->project()->first();

        $selesai = $tim->tugas()->where('status_tugas', 'selesai')->count();
        $revisi = $tim->tugas()->where('status_tugas', 'revisi')->count();
        $tugas_baru = $tim->tugas()->where('status_tugas', 'tugas_baru')->count();

        $code = $tim->code;

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesai],
            ['Revisi', $revisi],
            ['Tugas Baru', $tugas_baru]
        ];

        return response()->view('mentor.detail-projek', compact('tim', 'anggota', 'project', 'chartData', 'notifikasi'));
    }

    // Return view profile mentor
    protected function profilePage()
    {
        $user = Auth::user();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        return response()->view('mentor.profile-mentor', compact('user', 'notifikasi'));
    }

    // return view presentasi mentor
    protected function presentasi()
    {
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();


        $historyPresentasi = HistoryPresentasi::whereMonth('created_at', Carbon::now()->month)->get();

        return response()->view('mentor.presentasi', compact('historyPresentasi', 'notifikasi'));
    }

    protected function laporanProgres()
    {
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        return response()->view('mentor.laporan-progres', compact('notifikasi'));
    }
}
