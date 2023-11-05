<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class timController extends Controller
{
    protected function boardPage($uuid)
    {
        $title = "Tim/board";
        $tim = Tim::where('code', $uuid)->firstOrFail();
        $anggota = $tim->user()->get();
        $tugas_baru = $tim->tugas()->where('status_tugas', 'tugas_baru')->get();
        $tugas_dikerjakan = $tim->tugas()->where('status_tugas', 'dikerjakan')->get();
        $tugas_revisi = $tim->tugas()->where('status_tugas', 'revisi')->get();
        $tugas_selesai = $tim->tugas()->where('status_tugas', 'selesai')->get();

        return view('siswa.tim.board', compact('title', 'tim', 'anggota', 'tugas_baru', 'tugas_dikerjakan', 'tugas_revisi', 'tugas_selesai'));
    }

    protected function kalenderPage($uuid)
    {
        $title = "Tim/kalender";
        $tim = Tim::where('code', $uuid)->firstOrFail();
        $anggota = $tim->user()->get();

        return view('siswa.tim.kalender', compact('title', 'tim', 'anggota',));
    }

    protected function projectPage($uuid)
    {
        $title = "Tim/project";
        $tim = Tim::where('code', $uuid)->firstOrFail();
        $anggota = $tim->anggota()->get();
        $project = $tim->project()->first();

        // dd($project->tema);

        return view('siswa.tim.project', compact('title', 'tim', 'anggota', 'project'));
    }

    protected function historyPage($uuid)
    {
        $title = "Tim/history";
        $tim = Tim::where('code', $uuid)->firstOrFail();
        $anggota = $tim->user()->get();

        return view('siswa.tim.history', compact('title', 'tim', 'anggota'));
    }

    protected function historyPresentasiPage($uuid)
    {
        $title = "Tim/presentasi";
        $tim = Tim::where('code', $uuid)->firstOrFail();
        $anggota = $tim->user()->get();
        $presentasi = $tim->presentasi()->get();
        $jadwal = [];
        foreach ($presentasi as $data) {
            $jadwal[] = Carbon::parse($data->jadwal)->isoFormat('DD MMMM YYYY');
        }

        return view('siswa.tim.history-presentasi', compact('title', 'tim', 'anggota', 'presentasi', 'jadwal'));
    }

    protected function catatanPage($uuid)
    {
        $title = "catatan";
        $tim = Tim::where('code', $uuid)->firstOrFail();
        $anggota = $tim->user()->get();

        return view('siswa.tim.catatan', compact('title', 'anggota', 'tim'));
    }

    protected function historyCatatanPage($uuid)
    {
        $title = "catatan history";
        $tim = Tim::where('code', $uuid)->firstOrFail();
        $anggota = $tim->user()->get();

        return view('siswa.tim.history-catatan', compact('title', 'anggota', 'tim'));
    }
}
