<?php

namespace App\Http\Controllers;

use App\Enums\DayEnum;
use App\Models\Anggota;
use App\Models\catatan;
use App\Models\Comments;
use App\Models\LimitPresentasiDevisi;
use App\Models\Project;
use App\Models\Notifikasi;
use App\Models\Presentasi;
use App\Models\PresentasiDivisi;
use App\Models\Tim;
use App\Models\Tugas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class timController extends Controller
{
    protected function boardPage($code)
    {
        $title = 'Tim/board';
        $tim = Tim::where('code', $code)->firstOrFail();
        $userID = Auth::user()->id;
        $catatan = catatan::where('code', $code)->get();

        $anggota = Anggota::all();

        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        $project = $tim->project->first();
        if ($project->deskripsi === null) {
            return back()->with('tolak', 'Tolong lengkapi deskripsi proyek terlebih dahulu');
        }

        $anggota = $tim->user()->get();
        $tugas_baru = $tim
            ->tugas()
            ->where('status_tugas', 'tugas_baru')
            ->get();
        $tugas_dikerjakan = $tim
            ->tugas()
            ->where('status_tugas', 'dikerjakan')
            ->get();
        $tugas_revisi = $tim
            ->tugas()
            ->where('status_tugas', 'revisi')
            ->get();
        $tugas_selesai = $tim
            ->tugas()
            ->where('status_tugas', 'selesai')
            ->get();
        $code = $tim->code;

        return view('siswa.tim.board', compact('catatan', 'title', 'tim', 'anggota', 'tugas_baru', 'tugas_dikerjakan', 'tugas_revisi', 'tugas_selesai', 'project', 'notifikasi', 'code'));
    }

    protected function ubahStatus(Request $request)
    {
        $namaTugas = $request->input('nama');
        $tugas = Tugas::where('nama', $namaTugas)->first();

        if (!$tugas) {
            return redirect()
                ->back()
                ->with('error', 'Tugas tidak ditemukan');
        }

        $newStatus = $request->input('newStatus');
        $newPriority = $request->input('newPriority');
        $deadline = $request->input('deadline');

        $tugas->status_tugas = $newStatus;
        $tugas->prioritas = $newPriority;
        $tugas->deadline = $deadline;
        $tugas->save();

        return redirect()
            ->back()
            ->with('success', 'Status tugas berhasil diperbarui');
    }

    protected function hapusTugas(Request $request)
    {
        $nameTask = $request->input('nama');
        $tugas = Tugas::where('nama', $nameTask)->first();

        if (!$tugas) {
            return redirect()
                ->back()
                ->with('error', 'Tugas tidak ditemukan');
        }

        $tugas->delete();
        return redirect()
            ->back()
            ->with('success', 'Tugas berhasil dihapus');
    }

    protected function kalenderPage($code)
    {
        $title = 'Tim/kalender';
        $tim = Tim::where('code', $code)->firstOrFail();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        $project = $tim->project->first();
        if ($project->deskripsi === null) {
            return back()->with('tolak', 'Tolong lengkapi deskripsi proyek terlebih dahulu');
        }
        $anggota = $tim->user()->get();
        $project = $tim->project->first();

        $hasProjectRelation = $tim->project()->exists();

        return view('siswa.tim.kalender', compact('title', 'tim', 'anggota', 'hasProjectRelation', 'project', 'notifikasi'));
    }

    protected function projectPage($code)
    {
        $title = 'Tim/project';
        $tim = Tim::where('code', $code)->firstOrFail();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        $anggota = $tim
            ->anggota()
            ->orderBy('jabatan_id')
            ->get();

        $project = $tim->project->first();

        $hasProjectRelation = $tim->project()->exists();
        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();
        $dikerjakanCount = $tim->tugas->where('status_tugas', 'dikerjakan')->count();
        $totalTugas = $tim->tugas->count();
        $persentase = $totalTugas > 0 ? ($tugasBaruCount / $totalTugas) * 100 : 0;
        $tgl = $tim->project->pluck('created_at')->toArray();
        $deadline = $tim->project->pluck('deadline')->toArray();

        $tanggal = collect($tgl)
            ->map(function ($tglItem, $index) use ($deadline) {
                $tglItem = Carbon::parse($tglItem);
                $deadlineItem = Carbon::parse($deadline[$index]);
                return $tglItem->diffInHours($deadlineItem);
            })
            ->toArray();

        $days = collect($tgl)
            ->map(function ($tglDay, $index) use ($deadline) {
                $tglDay = Carbon::parse($tglDay);
                $deadlineItem = Carbon::parse($deadline[$index]);
                return $tglDay->diffInDays($deadlineItem);
            })
            ->toArray();

        $chartData = [['Status Tugas', 'Jumlah'], ['Selesai', $selesaiCount], ['Revisi', $revisiCount], ['Dikerjakan', $dikerjakanCount], ['Tugas Baru', $tugasBaruCount]];

        return view('siswa.tim.project', compact('hasProjectRelation', 'days', 'tanggal', 'persentase', 'selesaiCount', 'revisiCount', 'chartData', 'title', 'tim', 'anggota', 'project', 'notifikasi'));
    }

    protected function statistikPage($code)
    {
        $title = 'Tim/Statistik';
        $tim = Tim::with('anggota.jabatan')
            ->where('code', $code)
            ->firstOrFail();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        $project = $tim->project->first();
        if ($project->deskripsi === null) {
            return back()->with('tolak', 'Tolong lengkapi deskripsi proyek terlebih dahulu');
        }
        $anggota = $tim->user;
        $jabatan = [];

        foreach ($anggota as $data) {
            if (
                $data->anggotaReal
                ->where('tim_id', $tim->id)
                ->sortByDesc('created_at')
                ->first()->status !== 'active'
            ) {
                $jabatan[] = 'Mantan Anggota';
            } else {
                $jabatan[] = $data->anggotaReal
                    ->where('tim_id', $tim->id)
                    ->sortByDesc('created_at')
                    ->first()->jabatan->nama_jabatan;
            }
        }

        $project = $tim->project->first();

        $hasProjectRelation = $tim->project()->exists();

        return view('siswa.tim.statistik', compact('jabatan', 'title', 'tim', 'anggota', 'hasProjectRelation', 'project', 'notifikasi', 'project'));
    }

    protected function historyPresentasiPage($code)
    {

        $title = 'Tim/presentasi';
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        $tim = Tim::where('code', $code)->firstOrFail();
        $tim_id = $tim->id;
        $user = User::find(Auth::user()->id);

        $now = Carbon::now();
        $startofweek = $now->startOfWeek();
        $seninThisWeek = $now->startOfWeek()->format('Y-m-d');
        $selasaThisWeek = $startofweek->copy()->addDays(1)->format('Y-m-d');
        $rabuThisWeek = $startofweek->copy()->addDays(2)->format('Y-m-d');
        $kamisThisWeek = $startofweek->copy()->addDays(3)->format('Y-m-d');
        $jumatThisWeek = $startofweek->copy()->addDays(4)->format('Y-m-d');

        $allSessions = LimitPresentasiDevisi::query()
            ->whereRelation('presentasiDivisi', 'divisi_id', '=', Auth::user()->divisi_id)
            ->with('presentasiDivisi')
            ->get();

        $sesi_senin = $allSessions
            ->filter(function ($session) {
                return $session->presentasiDivisi->day === DayEnum::MONDAY->value;
            })
            ->sortBy('mulai');
        $cekJadwalSenin = null;
        foreach ($sesi_senin as $senin) {
            $cekJadwalSenin = Presentasi::where('presentasi_divisi_id', $senin->presentasi_divisi_id)
                ->where('tim_id', $user->anggota()->latest()->first()->tim_id)
                ->where('divisi_id', auth()->user()->divisi_id)
                ->whereHas('tim.anggota', function ($query) {
                    $query->where('status', 'active');
                })
                ->whereDate('jadwal', $seninThisWeek)
                ->first();
        }

        $sesi_selasa = $allSessions
            ->filter(function ($session) {
                return $session->presentasiDivisi->day === DayEnum::TUESDAY->value;
            })
            ->sortBy('mulai');
        $cekJadwalSelasa = null;
        foreach ($sesi_selasa as $selasa) {
            $cekJadwalSelasa = Presentasi::where('presentasi_divisi_id', $selasa->presentasi_divisi_id)
                ->where('tim_id', $user->anggota()->latest()->first()->tim_id)
                ->where('divisi_id', auth()->user()->divisi_id)
                ->whereHas('tim.anggota', function ($query) {
                    $query->where('status', 'active');
                })
                ->whereDate('jadwal', $selasaThisWeek)
                ->first();
        }

        $sesi_rabu = $allSessions
            ->filter(function ($session) {
                return $session->presentasiDivisi->day === DayEnum::WEDNESDAY->value;
            })
            ->sortBy('mulai');
        $cekJadwalRabu = null;
        foreach ($sesi_rabu as $rabu) {
            $cekJadwalRabu = Presentasi::where('presentasi_divisi_id', $rabu->presentasi_divisi_id)
                ->where('divisi_id', auth()->user()->divisi_id)
                ->where('tim_id', $user->anggota()->latest()->first()->tim_id)
                ->whereHas('tim.anggota', function ($query) {
                    $query->where('status', 'active');
                })
                ->whereDate('jadwal', $rabuThisWeek)
                ->first();
        }

        $sesi_kamis = $allSessions
            ->filter(function ($session) {
                return $session->presentasiDivisi->day === DayEnum::THURSDAY->value;
            })
            ->sortBy('mulai');
        $cekJadwalKamis = null;
        foreach ($sesi_kamis as $kamis) {
            $cekJadwalKamis = Presentasi::where('presentasi_divisi_id', $kamis->presentasi_divisi_id)
                ->where('divisi_id', auth()->user()->divisi_id)
                ->where('tim_id', $user->anggota()->latest()->first()->tim_id)
                ->whereHas('tim.anggota', function ($query) {
                    $query->where('status', 'active');
                })
                ->whereDate('jadwal', $kamisThisWeek)
                ->first();
        }

        $sesi_jumat = $allSessions
            ->filter(function ($session) {
                return $session->presentasiDivisi->day === DayEnum::FRIDAY->value;
            })
            ->sortBy('mulai');
        $cekJadwalJumat = null;
        foreach ($sesi_jumat as $jumat) {
            $cekJadwalJumat = Presentasi::where('presentasi_divisi_id', $jumat->presentasi_divisi_id)
                ->where('divisi_id', auth()->user()->divisi_id)
                ->where('tim_id', $user->anggota()->latest()->first()->tim_id)
                ->whereHas('tim.anggota', function ($query) {
                    $query->where('status', 'active');
                })
                ->whereDate('jadwal', $jumatThisWeek)
                ->first();
        }

        $cek_present = Presentasi::query()
            ->whereDate('jadwal', now())
            ->where('divisi_id', auth()->user()->divisi_id)
            ->get();

        $validasiPersetujuan = $tim->presentasi->sortByDesc('created_at')->first();

        $project = $tim->project->first();
        if ($project->deskripsi === null) {
            return back()->with('tolak', 'Tolong lengkapi deskripsi proyek terlebih dahulu');
        }
        // $anggota = $tim->user()->where('id',$userID)->first()->anggota->status;
        $anggota = Anggota::where('tim_id', $tim_id)
            ->where('user_id', $userID)
            ->first()->status;
        $jabatan = $tim
            ->user()
            ->where('id', $userID)
            ->first()->anggota->jabatan_id;
        $presentasi = $tim
            ->presentasi()
            ->orderBy('created_at', 'desc')
            ->get();
        $project = $tim->project->first();

        $presentasiID = Presentasi::all();
        $latestPresentasi = $tim->presentasi()->latest()->first();

        if ($latestPresentasi) {
            $presentID = $latestPresentasi->id;
        } else {
            $presentID = null;
        }
        $hasProjectRelation = $tim->project()->exists();
        $jadwal = [];
        foreach ($presentasi as $data) {
            $jadwal[] = Carbon::parse($data->jadwal)->isoFormat('DD MMMM YYYY');
        }

        return view('siswa.tim.history-presentasi', compact('cek_present', 'presentID', 'presentasiID', 'validasiPersetujuan', 'cekJadwalSenin', 'cekJadwalSelasa', 'cekJadwalRabu', 'cekJadwalKamis', 'cekJadwalJumat', 'jabatan', 'title', 'tim', 'anggota', 'presentasi', 'jadwal', 'hasProjectRelation', 'project', 'notifikasi', 'project', 'sesi_senin', 'sesi_selasa', 'sesi_rabu', 'sesi_kamis', 'sesi_jumat'));
    }

    protected function catatanPage($code)
    {
        $title = 'catatan';
        $tim = Tim::where('code', $code)->firstOrFail();
        $catatans = catatan::where('tim_id', $tim->id)->get();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        $project = $tim->project->first();
        if ($project->deskripsi === null) {
            return back()->with('tolak', 'Tolong lengkapi deskripsi proyek terlebih dahulu');
        }
        $anggota = $tim->user()->get();
        $project = $tim->project->first();

        $hasProjectRelation = $tim->project()->exists();

        $catatanTeam = Catatan::whereHas('CatatanDetail', function ($query) {
            $query->whereColumn('catatan_details.catatan_id', 'catatans.id');
        })
            ->with('catatanDetail')
            ->get();

        return view('siswa.tim.catatan', compact('catatanTeam', 'title', 'anggota', 'tim', 'catatans', 'project', 'notifikasi'));
    }

    protected function historyCatatanPage($code)
    {
        $title = 'catatan history';
        $tim = Tim::where('code', $code)->firstOrFail();

        $project = $tim->project->first();
        if ($project->deskripsi === null) {
            return back()->with('tolak', 'Tolong lengkapi deskripsi proyek terlebih dahulu');
        }
        $anggota = $tim->user()->get();
        $catatans = catatan::where('user_id', Auth::user()->id)->get();
        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        return view('siswa.tim.history-catatan', compact('title', 'anggota', 'tim'));
    }
}
