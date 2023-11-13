<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\catatan;
use App\Models\Comments;
use App\Models\Tim;
use App\Models\Tugas;
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
        $anggota = $tim->user()->get();
        $tugas_baru = $tim->tugas()->where('status_tugas', 'tugas_baru')->get();
        $tugas_dikerjakan = $tim->tugas()->where('status_tugas', 'dikerjakan')->get();
        $tugas_revisi = $tim->tugas()->where('status_tugas', 'revisi')->get();
        $tugas_selesai = $tim->tugas()->where('status_tugas', 'selesai')->get();

        $selesaiCount = $tim->tugas->where('status_t ugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $code = $tim->code;

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.board', compact('chartData','title', 'tim', 'anggota', 'tugas_baru', 'tugas_dikerjakan', 'tugas_revisi', 'tugas_selesai','code'));
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



    public function comments(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required', // Tambahkan aturan validasi tambahan jika diperlukan
            'text' => 'required', // Tambahkan aturan validasi tambahan jika diperlukan
        ]);

        $comments = new Comments;
        $comments->user_id = Auth::user()->id;
        $comments->tugas_id = $request->input('tugas_id');
        $comments->text = $request->input('text');
        $comments->save();

        return response()->json(['message' => 'Komentar berhasil ditambahkan']);
    }

    public function viewComments(Request $request)
    {
        $comments = Comments::where('tugas_id', $request->input('tugas_id'))->get();
        return response()->json($comments);
    }
    protected function kalenderPage($code)
    {
        $title = "Tim/kalender";
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->user()->get();
        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.kalender', compact('chartData','title', 'tim', 'anggota',));
    }

    protected function projectPage($code)
    {
        $title = "Tim/project";
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->anggota()->get();
        $project = $tim->project()->first();
        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.project', compact('chartData', 'title', 'tim', 'anggota', 'project'));

    }

    protected function historyPage($code)
    {
        $title = "Tim/history";
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->user()->get();
        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.history', compact('chartData','title', 'tim', 'anggota'));
    }

    protected function historyPresentasiPage($code)
    {
        $title = "Tim/presentasi";
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->user()->get();
        $presentasi = $tim->presentasi()->get();
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

        return view('siswa.tim.history-presentasi', compact('chartData','title', 'tim', 'anggota', 'presentasi', 'jadwal'));
    }

    protected function catatanPage($code)
    {
        $title = "catatan";
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->user()->get();
        $catatans = catatan::where('user_id', Auth::user()->id)->get();

        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.catatan', compact('chartData','title', 'anggota', 'tim','catatans'));
    }

    protected function historyCatatanPage($code)
    {
        $title = "catatan history";
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->user()->get();
        $catatans = catatan::where('user_id', Auth::user()->id)->get();
        // dd($catatans);
        $selesaiCount = $tim->tugas->where('status_tugas', 'selesai')->count();
        $revisiCount = $tim->tugas->where('status_tugas', 'revisi')->count();
        $tugasBaruCount = $tim->tugas->where('status_tugas', 'tugas_baru')->count();

        $chartData = [
            ['Status Tugas', 'Jumlah'],
            ['Selesai', $selesaiCount],
            ['Revisi', $revisiCount],
            ['Tugas Baru', $tugasBaruCount]
        ];

        return view('siswa.tim.history-catatan', compact('chartData','title', 'anggota', 'tim'));
    }


}
