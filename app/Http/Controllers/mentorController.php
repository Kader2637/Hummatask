<?php

namespace App\Http\Controllers;

use App\Enums\DayEnum;
use App\Http\Requests\RequestCreateGalery;
use App\Http\Requests\RequestCreateLogo;
use App\Http\Requests\RequestEditGalery;
use App\Models\Galery;
use App\Models\HistoryPresentasi;
use App\Models\Notifikasi;
use App\Models\Anggota;
use App\Models\catatan;
use App\Models\CatatanDetail;
use App\Models\Divisi;
use App\Models\LimitPresentasiDevisi;
use App\Models\PenglolaMagang;
use App\Models\Presentasi;
use App\Models\PresentasiDivisi;
use App\Models\Project;
use App\Models\StatusTim;
use App\Models\TidakPresentasiMingguan;
use App\Models\Tim;
use App\Models\Tugas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class mentorController extends Controller
{
    // Return view dashboard mentor
    protected function dashboard(Request $request)
    {
        $jadwal = [];
        $hari = [];
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();
        $presentasi = Presentasi::with('tim')
            ->where('status_presentasi', 'selesai')
            ->whereDate('created_at', now())
            ->latest('created_at')
            ->take(5)
            ->get()
            ->reverse();
        foreach ($presentasi as $i => $data) {
            $jadwal[] = Carbon::parse($data->jadwal)->isoFormat('DD MMMM YYYY');
            $hari[] = Carbon::parse($data->jadwal)->isoFormat('dddd');
        }
        $jadwal = array_reverse($jadwal);
        $hari = array_reverse($hari);

        $user = User::where('status_kelulusan', 0)->get();

        foreach ($user as $data) {
            if ($data->tanggal_lulus <= Carbon::now()->isoFormat('YYYY-MM-DD')) {
                $data->status_kelulusan = 1;
                $data->save();
            }
        }

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $year = $request->input('year', $currentYear);
        $month = $request->input('month', $currentMonth);

        // grafik
        $users = User::select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), 'peran_id', DB::raw('count(*) as total'))
            ->whereIn('peran_id', ['1'])
            ->whereYear('created_at', $year)
            ->groupBy('year', 'month', 'peran_id')
            ->get();

        $tim = Tim::select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), 'status_tim', DB::raw('count(*) as total'))
            ->whereIn('status_tim', ['mini', 'pre_mini', 'big'])
            ->whereYear('created_at', $year)
            ->groupBy('year', 'month', 'status_tim')
            ->get();

        $processedData = [];
        for ($m = 1; $m <= 12; $m++) {
            $date = Carbon::createFromDate($year, $m, 1);
            $yearMonth = $date->isoFormat('MMMM');

            $color = $year == $currentYear && $m == $month ? 'blue' : 'blue';
            $colorwait = $year == $currentYear && $m == $month ? 'grey' : 'grey';
            $colors = $year == $currentYear && $m == $month ? 'red' : 'red';
            $piecolor = $year == $currentYear && $m == $month ? 'orange' : 'orange';

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
                'piecolor' => $piecolor,
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
            $query
                ->whereIn('status_tim', ['solo'])
                ->where('kadaluwarsa', '0')
                ->where('divisi_id', Auth::user()->divisi_id);
        })->count();

        $preMini = Tim::where(function ($query) {
            $query
                ->whereIn('status_tim', ['pre_mini'])
                ->where('kadaluwarsa', '0')
                ->where('divisi_id', Auth::user()->divisi_id);
        })->count();

        $mini = Tim::where(function ($query) {
            $query
                ->whereIn('status_tim', ['mini'])
                ->where('kadaluwarsa', '0')
                ->where('divisi_id', Auth::user()->divisi_id);
        })->count();

        $big = Tim::where(function ($query) {
            $query
                ->whereIn('status_tim', ['big'])
                ->where('kadaluwarsa', '0')
                ->where('divisi_id', Auth::user()->divisi_id);
        })->count();

        $chart = [['Jumlah', 'Data'], ['Jumlah Solo Projek', $solo], ['Jumlah Tim Premini Projek', $preMini], ['Jumlah Tim Mini Projek', $mini], ['Jumlah Tim Big Projek', $big]];

        $senin = PresentasiDivisi::query()
            ->with('limitPresentasiDivisis')
            ->where('day', DayEnum::MONDAY->value)
            ->where('divisi_id', auth()->user()->divisi_id)
            ->first();
        $selasa = PresentasiDivisi::query()
            ->with('limitPresentasiDivisis')
            ->where('day', DayEnum::TUESDAY->value)
            ->where('divisi_id', auth()->user()->divisi_id)
            ->first();
        $rabu = PresentasiDivisi::query()
            ->with('limitPresentasiDivisis')
            ->where('day', DayEnum::WEDNESDAY->value)
            ->where('divisi_id', auth()->user()->divisi_id)
            ->first();
        $kamis = PresentasiDivisi::query()
            ->with('limitPresentasiDivisis')
            ->where('day', DayEnum::THURSDAY->value)
            ->where('divisi_id', auth()->user()->divisi_id)
            ->first();
        $jumat = PresentasiDivisi::query()
            ->with('limitPresentasiDivisis')
            ->where('day', DayEnum::FRIDAY->value)
            ->where('divisi_id', auth()->user()->divisi_id)
            ->first();

        $day = $request->query('day');
        $divisiId = $request->query('divisi_id');

        $divisis = Divisi::all();

        $dataPresentasi = [];

        foreach ($divisis as $divisi) {
            $query = LimitPresentasiDevisi::whereHas('presentasiDivisi', function ($query) use ($divisiId, $day) {
                if ($divisiId) {
                    $query->where('divisi_id', $divisiId);
                }
                if ($day) {
                    $query->where('day', $day);
                }
            });

            $dataPresentasi[$divisi->id] = $query->get();
        }

        if (!$day && !$divisiId) {
            foreach ($divisis as $divisi) {
                $query = LimitPresentasiDevisi::whereHas('presentasiDivisi', function ($query) use ($divisi) {
                    $query->where('divisi_id', $divisi->id);
                });

                $dataPresentasi[$divisi->id] = $query->get();
            }
        }

        return response()->view('mentor.dashboard', compact('divisis', 'dataPresentasi', 'year', 'currentYear', 'processedData', 'presentasi', 'chartData', 'jadwal', 'hari', 'chart', 'notifikasi', 'senin', 'selasa', 'rabu', 'kamis', 'jumat'));
    }

    protected function pengguna()
    {
        $roles = Role::all();
        $mentors = User::where('peran_id', 2)->get();
        $users = User::with('peran')
            ->where('peran_id', 1)
            ->where('divisi_id', Auth::user()->divisi_id)
            ->get();
        $notifikasi = Notifikasi::where('user_id', Auth::user()->id)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();
        $pengelolaMagang = new Collection();
        $bukanPengelolaMagang = new Collection();
        $magang = PenglolaMagang::all();

        $bukanPengelolaMagang = User::whereDoesntHave('roles')
            ->whereDoesntHave('permissions')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('id', 1);
            })
            ->where('peran_id', 1)
            ->where('status_kelulusan', false)
            ->get();

        foreach ($users as $user) {
            $penglolaMagang = PenglolaMagang::where('user_id', $user->id)->first();

            if ($penglolaMagang && $penglolaMagang->akhir_menjabat < Carbon::now()) {
                PenglolaMagang::where('user_id', $user->id)->update(['masih_menjabat' => false]);

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
        $notifikasi = Notifikasi::where('user_id', $userID)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();
        $telatDeadline = Project::with('tim.anggota.user', 'tema')
            ->whereRelation('tim.divisi', 'id', '=', Auth::user()->divisi_id)
            ->where('deadline', '<', now())
            ->get();
        $presentasiSelesai = Presentasi::with('tim.anggota.user', 'tim.project.tema')
            ->whereRelation('tim.divisi', 'id', '=', Auth::user()->divisi_id)
            ->where('status_presentasi', 'selesai')
            ->whereHas('tim.project.tema')
            ->get();
        $timSolo = Tim::with('anggota.user', 'project.tema')
            ->where('divisi_id', Auth::user()->divisi_id)
            ->where('status_tim', 'solo')
            ->get();
        $timGroup = Tim::with('anggota.user', 'project.tema')
            ->where('divisi_id', Auth::user()->divisi_id)
            ->where('status_tim', '!=', 'solo')
            ->whereHas('project')
            ->get();

        $tidakPresentasiMingguan = TidakPresentasiMingguan::with('tim.ketuaTim', 'historyPresentasi')
            ->whereRelation('tim.divisi', 'id', '=', Auth::user()->divisi_id)
            ->get();

        return response()->view('mentor.history', compact('tidakPresentasiMingguan', 'telatDeadline', 'presentasiSelesai', 'timSolo', 'timGroup', 'notifikasi'));
    }

    // Return view pengajuan projek mentor
    protected function pengajuanProjekPage(Request $request)
    {
        $projectsQuery = Project::with('tim.anggota.user', 'tim.tema', 'anggota.jabatan', 'anggota.user')
            ->whereRelation('tim.divisi', 'id', '=', Auth::user()->divisi_id)
            ->where('status_project', 'notapproved');

        if ($request->has('status_tim')) {
            if ($request->status_tim != 'all' && $request->status_tim != null) {
                $projectsQuery->where('type_project', $request->status_tim);
            }
        }

        if ($request->has('nama_tim')) {
            if ($request->nama_tim != null) {
                $namaTim = $request->nama_tim;
                $projectsQuery->whereHas('tim', function ($query) use ($namaTim) {
                    $query->where('nama', 'like', "%$namaTim%");
                });
            }
        }

        $projects = $projectsQuery->paginate(12);

        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();

        return response()->view('mentor.pengajuan-projek', compact('projects', 'notifikasi'));
    }

    // Return view detail pengajuan projek mentor
    protected function detailPengajuan($code)
    {
        $projects = Project::where('code', $code)->firstOrFail();

        return response()->view('mentor.detail-pengajuan', compact('projects'));
    }

    // Return view projek mentor
    protected function projekPage(Request $request)
    {
        $notifikasi = Notifikasi::where('user_id', Auth::user()->id)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();

        $projectQuery = Project::with('tim.anggota', 'tema', 'tim.tugas')
            ->whereRelation('tim.divisi', 'id', '=', Auth::user()->divisi_id)
            ->where('status_project', 'approved')
            ->orderByRaw("FIELD(type_project, 'big', 'mini', 'pre_mini', 'solo')");

        if ($request->has('status_tim')) {
            if ($request->status_tim != 'all' && $request->status_tim != null) {
                $projectQuery->where('type_project', $request->status_tim);
            }
        }

        if ($request->has('nama_tim')) {
            $namaTim = $request->nama_tim;
            if ($namaTim != null) {
                $projectQuery->whereHas('tim', function ($query) use ($namaTim) {
                    $query->where('nama', 'like', "%$namaTim%");
                });
            }
        }

        $projects = $projectQuery->paginate(12);

        $users = User::where('peran_id', 1)
            ->whereDoesntHave('tim', function ($query) {
                $query->where('kadaluwarsa', true);
            })
            ->get();

        return response()->view('mentor.projek', compact('users', 'projects', 'notifikasi'));
    }

    protected function projekDetail($code)
    {
        $project = Project::where('code', $code)->firstOrFail();

        $catatan = catatan::where('code', $code)->get();

        $notifikasi = Notifikasi::where('user_id', Auth::user()->id)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();

        $tugas = $project->tim->tugas;

        $selesaiQuery = $tugas->where('status_tugas', 'selesai');
        $revisiQuery = $tugas->where('status_tugas', 'revisi');
        $tugasBaruQuery = $tugas->where('status_tugas', 'tugas_baru');
        $dikerjakanQuery = $tugas->where('status_tugas', 'dikerjakan');

        $chartData = [['Status Tugas', 'Jumlah'], ['Selesai', $selesaiQuery->count()], ['Revisi', $revisiQuery->count()], ['Dikerjakan', $dikerjakanQuery->count()], ['Tugas Baru', $tugasBaruQuery->count()]];

        $tanggalMulai = $project->tim->created_at->translatedFormat('Y-m-d');
        $deadline = \Carbon\Carbon::parse($project->deadline)->translatedFormat('Y-m-d');
        $totalDeadline = \Carbon\Carbon::parse($deadline)->diffInDays($tanggalMulai);
        $dayLeft = \Carbon\Carbon::parse($deadline)->diffInDays(\Carbon\Carbon::now()->startOfDay());
        $progressPercentage = $totalDeadline > 0 ? round(100 - ($dayLeft / $totalDeadline) * 100) : 0;

        $day = [
            'tanggalMulai' => $tanggalMulai,
            'deadline' => $deadline,
            'totalDeadline' => $totalDeadline,
            'dayleft' => $dayLeft,
            'progresspercent' => $progressPercentage,
        ];

        $board = [
            'boardTugasBaru' => $tugasBaruQuery,
            'boardRevisi' => $revisiQuery,
            'boardDikerjakan' => $dikerjakanQuery,
            'boardSelesai' => $selesaiQuery,
        ];

        return view('mentor.projekDetail', compact('project', 'notifikasi', 'catatan', 'chartData', 'day', 'board'));
    }

    protected function updateCatatanMentor(Request $request, $code)
    {
        $catatan = catatan::where('code', $code)->firstOrFail();

        if ($request->catatan_text) {
            foreach ($request->catatan_text as $index => $catatan_text) {
                $id_detail = $request->id[$index];
                if ($catatan_text) {
                    $tugas = Tugas::where('catatan_detail_id', $id_detail)->first();

                    $catatanDetail = CatatanDetail::updateOrCreate(
                        ['id' => $id_detail],
                        ['catatan_text' => $catatan_text, 'catatan_id' => $catatan->id]
                    );

                    if ($tugas) {
                        $tugas->update([
                            'tim_id' => $request->tim_id,
                            'code' => $tugas->code,
                            'nama' => $catatan_text,
                            'status_tugas' => 'tugas_baru',
                            'prioritas' => 'biasa'
                        ]);
                    } else {
                        Tugas::create([
                            'catatan_detail_id' => $catatanDetail->id,
                            'tim_id' => $request->tim_id,
                            'code' => Str::uuid(),
                            'nama' => $catatanDetail->catatan_text,
                            'status_tugas' => 'tugas_baru',
                            'prioritas' => 'biasa'
                        ]);
                    }
                } else {
                    $catatanDetail = CatatanDetail::find($id_detail);
                    if ($catatanDetail) {
                        $catatanDetail->delete();
                    }

                    $tugas = Tugas::where('catatan_detail_id', $id_detail)->first();
                    if ($tugas) {
                        $tugas->delete();
                    }
                }
            }

            return redirect()->back()->with('success', 'Catatan berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Anda tidak mengubah catatan apapun.');
        }
    }

    function updateDeadline($id, Request $request)
    {
        $projek = Project::findOrFail($id);
        $tglawal = $projek->created_at;
        $deadline = $request->input('xp');

        if (Carbon::parse($deadline)->lt($tglawal)) {
            return response()->json(['error' => 'Deadline harus setelah tanggal awal proyek'], 422);
        }

        $projek->deadline = $deadline;
        $projek->save();

        return response()->json(['success' => 'Berhasil update tim'], 200);
    }

    protected function pieproject($timId)
    {
        $tim = Tim::where('code', $timId)->first();

        $selesai = $tim->tugas->where('status_tugas', 'selesai')->count();

        $revisi = $tim->tugas->where('status_tugas', 'revisi')->count();

        $tugas_baru = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $dikerjakan = $tim->tugas->where('status_tugas', 'dikerjakan')->count();

        $chartData = [['Status Tugas', 'Jumlah'], ['Selesai', $selesai], ['Revisi', $revisi], ['Dikerjakan', $dikerjakan], ['Tugas Baru', $tugas_baru]];

        return response()->json(['selesai' => $selesai, 'revisi' => $revisi, 'tugas_baru' => $tugas_baru, 'chartData' => $chartData]);
    }

    protected function Project()
    {
        $users = User::query()
            ->where('peran_id', 1)
            ->where('divisi_id', Auth::user()->divisi_id)
            ->where('status_kelulusan', 0)
            ->where(function ($query) {
                $query
                    ->whereDoesntHave('tim', function ($query) {
                        $query->where('kadaluwarsa', false);
                    })
                    ->orWhereHas('tim', function ($query) {
                        $query->whereIn('status', ['kicked', 'expired']);
                    })
                    ->whereDoesntHave('anggota', function ($query) {
                        $query->where('status', 'active');
                    });
            })
            ->get();

        $status_tim = StatusTim::whereNot('status', 'solo')->get();
        return response()->json(['users' => $users, 'status_tim' => $status_tim]);
    }

    protected function timEdit($tim)
    {
        $ketuaId = Tim::where('id', $tim)
            ->with([
                'anggota' => function ($query) {
                    $query->where('jabatan_id', 1);
                },
            ])
            ->first()
            ->anggota->pluck('user_id');

        $ketua = User::where('peran_id', 1)
            ->where('status_kelulusan', 0)
            ->whereHas('tim', function ($query) use ($tim) {
                $query->where('id', $tim);
            })
            ->get();

        $users = Anggota::whereIn('status', ['kicked', 'expired'])
            ->where('tim_id', '!=', $tim)
            ->orWhere(function ($query) use ($tim) {
                $query->where('tim_id', $tim)->where('status', 'active');
            })
            // ->orderBy('jabatan_id')
            ->get();

        $usersArray = $users->pluck('user_id')->toArray();
        $uniqueUsersArray = array_unique($usersArray);

        $users1 = User::whereIn('id', $uniqueUsersArray)->get();

        $users2 = User::where('peran_id', 1)
            ->where('status_kelulusan', 0)
            ->where(function ($query) use ($tim) {
                $query->whereDoesntHave('tim', function ($subQuery) {
                    $subQuery->where('kadaluwarsa', false);
                });
            })
            ->get();

        $users = $users1->merge($users2);
        // dd($users);

        $status_tim = StatusTim::whereNot('status', 'solo')->get();
        return response()->json(['users' => $users, 'status_tim' => $status_tim, 'ketua' => $ketua, 'ketua_id' => $ketuaId]);
    }

    protected function tim(Request $request)
    {
        $timQuery = tim::query()
            ->where('divisi_id', Auth::user()->divisi_id)
            ->with('user', 'project')
            ->orderBy('kadaluwarsa');

        if ($request->has('status_tim') && $request->status_tim !== 'all') {
            $timQuery->where('status_tim', $request->status_tim);
        }

        if ($request->has('nama_tim') && $request->nama_tim !== null) {
            $query = $request->nama_tim;
            $timQuery->where('nama', 'like', "%$query%");
        }

        $tims = $timQuery->paginate(12);

        $notifikasi = Notifikasi::where('user_id', auth()->id())
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();
        $status_tim = StatusTim::whereNot('status', 'solo')->get();

        return response()->view('mentor.tim', compact('tims', 'status_tim', 'notifikasi'));
    }

    // Return view profile mentor
    protected function profilePage()
    {
        $user = Auth::user();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();
        return response()->view('mentor.profile-mentor', compact('user', 'notifikasi'));
    }

    // return view presentasi mentor
    protected function presentasi()
    {
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();
        $historyPresentasi = HistoryPresentasi::all()
            ->sortByDesc('created_at')
            ->where('divisi_id', Auth::user()->divisi_id)
            ->take(5);

        // dd($historyPresentasi);
        return response()->view('mentor.presentasi', compact('historyPresentasi', 'notifikasi'));
    }

    protected function laporanProgres()
    {
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();
        return response()->view('mentor.laporan-progres', compact('notifikasi'));
    }

    protected function galery()
    {
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();

        return response()->view('mentor.galery', compact('notifikasi'));
    }

    protected function getGalery()
    {
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();
        $galery = Galery::where('status', 'album')->paginate(8);
        $logo = Galery::where('status', 'logo')->paginate(8);

        return response()->json(['notifikasi' => $notifikasi, 'galery' => $galery, 'logo' => $logo]);
    }

    protected function createLogo(RequestCreateLogo $request)
    {
        $foto = $request->file('fotoLogo');
        $img = $foto->hashName();
        $foto->storeAs('logo', $img);

        $logo = new Galery([
            'judul' => $request->input('judulLogo'),
            'foto' => $img,
            'status' => 'logo',
        ]);

        $logo->save();

        return response()->json(['logo' => $logo]);
    }

    protected function createGalery(RequestCreateGalery $request)
    {
        $foto = $request->file('foto');
        $img = $foto->hashName();
        // Ganti cara penyimpanan file
        $foto->storeAs('logo', $img);

        $galery = new Galery([
            'judul' => $request->input('judul'),
            'keterangan' => $request->input('keterangan'),
            'foto' => $img,
            'status' => 'album',
        ]);

        $galery->save();

        return response()->json(['galery' => $galery]);
    }

    protected function updateGalery(RequestEditGalery $request, $id)
    {
        $foto = $request->file('foto');
        $galery = Galery::findOrFail($id);

        if ($foto) {
            Storage::delete('logo/' . $galery->foto);

            $img = $foto->hashName();
            $foto->storeAs('logo', $img);
            $galery->foto = $img;
        }
        $galery->judul = $request->input('judul');
        $galery->keterangan = $request->input('keterangan');
        $galery->status = 'album';
        $galery->save();

        return response()->json(['galery' => $galery]);
    }

    protected function updateLogo(RequestEditGalery $request, $id)
    {
        $foto = $request->file('foto');
        $logo = Galery::findOrFail($id);

        if ($foto) {
            Storage::delete('logo/' . $logo->foto);

            $img = $foto->hashName();
            $foto->storeAs('logo', $img);
            $logo->foto = $img;
        }
        $logo->judul = $request->input('judul');
        $logo->status = 'logo';
        $logo->save();

        return response()->json(['logo' => $logo]);
    }

    protected function deleteGalery($id)
    {
        $galery = Galery::findOrFail($id);
        Storage::delete('logo/' . $galery->foto);
        $galery->delete();

        return response()->json(['galery' => $galery]);
    }

    protected function siswaPresentasiPage()
    {
        $notifikasi = Notifikasi::where('user_id', Auth::user()->id)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();

        $historyPresentasi = HistoryPresentasi::query()
            ->latest()
            ->paginate(12);

        return response()->view('mentor.siswa-presentasi', compact('notifikasi', 'historyPresentasi'));
    }

    protected function detailPresentasiPage(string $code)
    {
        $notifikasi = Notifikasi::where('user_id', Auth::user()->id)
            ->whereHas('user', function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            })
            ->get();

        $history = HistoryPresentasi::with([
            'presentasi.tim.user',
            'presentasi.tim.project.tema',
            'presentasi.limitPresentasiDivisi.presentasiDivisi' => function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            },
        ])
            ->where('code', $code)
            ->first();

        $unconfirmedPresentasi = Presentasi::query()
            ->with(['tim.user', 'tim.project.tema', 'tim.presentasi'])
            ->where('history_presentasi_id', $history->id)
            ->whereHas('tim.divisi', function ($query) {
                $query->where('id', Auth::user()->divisi_id);
            })
            ->whereIn('status_presentasi', ['menunggu', 'sedang_presentasi'])
            ->orderByRaw("status_presentasi = 'sedang_presentasi' desc")
            ->orderBy('jadwal_ke', 'asc')
            ->get();

        $presentasiSenin = $unconfirmedPresentasi->where('hari', 'senin');

        $presentasiSelasa = $unconfirmedPresentasi->where('hari', 'selasa');

        $presentasiRabu = $unconfirmedPresentasi->where('hari', 'rabu');

        $presentasiKamis = $unconfirmedPresentasi->where('hari', 'kamis');

        $presentasiJumat = $unconfirmedPresentasi->where('hari', 'jumat');

        return response()->view('mentor.detail-presentasi', compact('history', 'presentasiSenin', 'presentasiSelasa', 'presentasiRabu', 'presentasiKamis', 'presentasiJumat', 'notifikasi'));
    }
}
