<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Tim;
use App\Models\Tugas;
use Illuminate\Http\Request;

class timController extends Controller
{
    protected function boardPage($uuid)
    {
        $title = "Tim/board";
        $tim = Tim::where('uuid', $uuid)->first();
        $anggota = $tim->user()->get();
        $tugas = Tugas::all();

        return view('siswa.tim.board', compact('title','tim','anggota','tugas_baru','tugas_dikerjakan','tugas_revisi','tugas_selesai'));
    }

    protected function kalenderPage($uuid)
    {
        $tim = Tim::where('uuid', $uuid)->first();
        $anggota = $tim->user()->get();

        $title = "Tim/kalender";
        return view('siswa.tim.kalender', compact('title','tim','anggota',));
    }

    protected function projectPage($uuid)
    {
        $tim = Tim::where('uuid', $uuid)->first();
        $anggota = $tim->user()->get();

        $title = "Tim/project";
        return view('siswa.tim.project', compact('title', 'tim', 'anggota'));
    }

    protected function historyPage($uuid)
    {
        $title = "Tim/history";

        $tim = Tim::where('uuid', $uuid)->first();
        $anggota = $tim->user()->get();


        return view('siswa.tim.history', compact('title', 'tim', 'anggota'));
    }

    protected function historyPresentasiPage($uuid)
    {
        $title = "Tim/presentasi";
        $tim = Tim::where('uuid', $uuid)->first();
        $anggota = $tim->user()->get();

        return view('siswa.tim.history-presentasi', compact('title', 'tim', 'anggota'));
    }

    protected function catatanPage($uuid)
    {
        $tim = Tim::where('uuid', $uuid)->first();
        $anggota = $tim->user()->get();

        $title = "catatan";
        return view('siswa.tim.catatan', compact('title', 'anggota', 'tim'));
    }

    protected function historyCatatanPage($uuid)
    {
        $tim = Tim::where('uuid', $uuid)->first();
        $anggota = $tim->user()->get();

        $title = "catatan history";
        return view('siswa.tim.history-catatan', compact('title', 'anggota', 'tim'));
    }
}
