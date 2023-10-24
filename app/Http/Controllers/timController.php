<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class timController extends Controller
{
    //

    protected function boardPage()
    {
        $title = "Tim/board";
        return view('siswa.tim.board',compact('title'));
    }

    protected function kalenderPage()
    {
        $title = "Tim/kalender";
        return view('siswa.tim.kalender',compact('title'));
    }

    protected function projectPage()
    {
        $title = "Tim/project";
        return view('siswa.tim.project',compact('title'));
    }

    protected function historyPage()
    {
        $title = "Tim/history";
        return view('siswa.tim.history',compact('title'));
    }

    protected function historyPresentasiPage()
    {
        $title = "Tim/presentasi";
        return view('siswa.tim.history-presentasi',compact('title'));
    }

    protected function historyCatatanPage()
    {
        $title = "Tim/catatan";
        return view('siswa.tim.history-catatan',compact('title'));
    }
}
