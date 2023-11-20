<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\catatan;
use App\Models\Comments;
use App\Models\Project;
use App\Models\Notifikasi;
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
        $title = "Tim/board";
        $tim = Tim::where('code', $code)->firstOrFail();
        $userID = Auth::user()->id;

        $anggota = Anggota::all();

        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        $project = $tim->project->first();
        if ($project->deskripsi === null) {
            return back()->with('tolak', 'Tolong lengkapi deskripsi proyek terlebih dahulu');
        }

        $anggota = $tim->user()->get();
        $tugas_baru = $tim->tugas()->where('status_tugas', 'tugas_baru')->get();
        $tugas_dikerjakan = $tim->tugas()->where('status_tugas', 'dikerjakan')->get();
        $tugas_revisi = $tim->tugas()->where('status_tugas', 'revisi')->get();
        $tugas_selesai = $tim->tugas()->where('status_tugas', 'selesai')->get();

        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $code = $tim->code;

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.board', compact('chartData', 'title', 'tim', 'anggota', 'tugas_baru', 'tugas_dikerjakan', 'tugas_revisi', 'tugas_selesai', 'project', 'notifikasi', 'code'));
    }

    protected function ubahStatus(Request $request)
    {
        $namaTugas = $request->input('nama');
        $tugas = Tugas::where('nama', $namaTugas)->first();

        if (!$tugas) {
            return redirect()->back()->with('error', 'Tugas tidak ditemukan');
        }

        $newStatus = $request->input('newStatus');
        $newPriority = $request->input('newPriority');
        $deadline = $request->input('deadline');


        $tugas->status_tugas = $newStatus;
        $tugas->prioritas = $newPriority;
        $tugas->deadline = $deadline;
        $tugas->save();

        return redirect()->back()->with('success', 'Status tugas berhasil diperbarui');
    }

    protected function hapusTugas(Request $request)
    {
        $nameTask = $request->input('nama');
        $tugas = Tugas::where('nama', $nameTask)->first();

        if (!$tugas) {
            return redirect()->back()->with('error', 'Tugas tidak ditemukan');
        }

        $tugas->delete();
        return redirect()->back()->with('success', 'Tugas berhasil dihapus');
    }

    protected function kalenderPage($code)
    {
        $title = "Tim/kalender";
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
        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.kalender', compact('chartData', 'title', 'tim', 'anggota', 'hasProjectRelation', 'project', 'notifikasi'));
    }

    protected function projectPage($code)
    {
        $title = "Tim/project";
        $tim = Tim::where('code', $code)->firstOrFail();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        $anggota = $tim->anggota()->get();
        $project = $tim->project->first();

        $hasProjectRelation = $tim->project()->exists();
        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();
        $totalTugas = $tim->tugas->count();
        $persentase = $totalTugas > 0 ? ($tugasBaruCount / $totalTugas) * 100 : 0;
        $tgl = $tim->project->pluck('created_at')->toArray();
        $deadline = $tim->project->pluck('deadline')->toArray();

        $tanggal = collect($tgl)->map(function ($tglItem, $index) use ($deadline) {
            $tglItem = Carbon::parse($tglItem);
            $deadlineItem = Carbon::parse($deadline[$index]);
            return $tglItem->diffInHours($deadlineItem);
        })->toArray();

        $days = collect($tgl)->map(function ($tglDay, $index) use ($deadline) {
            $tglDay = Carbon::parse($tglDay);
            $deadlineItem = Carbon::parse($deadline[$index]);
            return $tglDay->diffInDays($deadlineItem);
        })->toArray();

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.project', compact('hasProjectRelation', 'days', 'tanggal', 'persentase', 'selesaiCount', 'revisiCount', 'chartData', 'title', 'tim', 'anggota', 'project', 'notifikasi',));
    }

    protected function statistikPage($code)
    {
        $title = "Tim/Statistik";
        $tim = Tim::with('anggota.jabatan')->where('code', $code)->firstOrFail();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        $project = $tim->project->first();
        if ($project->deskripsi === null) {
            return back()->with('tolak', 'Tolong lengkapi deskripsi proyek terlebih dahulu');
        }
        $anggota = $tim->user;
        $jabatan=[];

        foreach ($anggota as $data) {
           $jabatan[] = $data->anggota->jabatan->nama_jabatan;
        }

        $project = $tim->project->first();

        $hasProjectRelation = $tim->project()->exists();
        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.statistik', compact('jabatan','chartData', 'title', 'tim', 'anggota', 'hasProjectRelation', 'project', 'notifikasi', 'project'));
    }

    protected function historyPresentasiPage($code)
    {
        $title = "Tim/presentasi";
        $tim = Tim::where('code', $code)->firstOrFail();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        $project = $tim->project->first();
        if ($project->deskripsi === null) {
            return back()->with('tolak', 'Tolong lengkapi deskripsi proyek terlebih dahulu');
        }
        $anggota = $tim->user()->get();
        $presentasi = $tim->presentasi()->orderBy('created_at', 'desc')->get();
        // dd($presentasi);
        $project = $tim->project->first();

        $hasProjectRelation = $tim->project()->exists();
        $jadwal = [];
        foreach ($presentasi as $data) {
            $jadwal[] = Carbon::parse($data->jadwal)->isoFormat('DD MMMM YYYY');
        }
        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.history-presentasi', compact('chartData', 'title', 'tim', 'anggota', 'presentasi', 'jadwal', 'hasProjectRelation', 'project', 'notifikasi', 'project'));
    }

    protected function catatanPage($code)
    {
        $title = "catatan";
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

        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.catatan', compact('chartData', 'title', 'anggota', 'tim', 'catatans', 'project', 'notifikasi'));
    }

    protected function historyCatatanPage($code)
    {
        $title = "catatan history";
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
