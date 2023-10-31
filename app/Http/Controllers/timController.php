<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Project;
use App\Models\Tim;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $tim = Tim::where('code', $uuid)->firstOrFail();
        $anggota = $tim->user()->get();

        $title = "catatan";
        return view('siswa.tim.catatan', compact('title', 'anggota', 'tim'));
    }

    protected function historyCatatanPage($uuid)
    {
        $tim = Tim::where('code', $uuid)->firstOrFail();
        $anggota = $tim->user()->get();

        $title = "catatan history";
        return view('siswa.tim.history-catatan', compact('title', 'anggota', 'tim'));
    }
}
