<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Comments;
use App\Models\Tim;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('siswa.tim.board', compact('title', 'tim', 'anggota', 'tugas_baru', 'tugas_dikerjakan', 'tugas_revisi', 'tugas_selesai'));
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

    protected function hapusTugas(Request $request){
        $nameTask = $request->input('nama');
        $tugas = Tugas::where('nama', $nameTask)->first();

        if (!$tugas) {
            return redirect()->back()->with('error', 'Tugas tidak ditemukan');
        }

        $tugas->delete();
        return redirect()->back()->with('success', 'Tugas berhasil dihapus');
    }

    public function comments(Request $request) {
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

    public function viewComments(Request $request){
        $comments = Comments::where('tugas_id', $request->input('tugas_id'))->get();
        return response()->json($comments);
    }
    protected function kalenderPage($code)
    {
        $title = "Tim/kalender";
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->user()->get();

        return view('siswa.tim.kalender', compact('title', 'tim', 'anggota',));
    }

    protected function projectPage($code)
    {
        $title = "Tim/project";
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->anggota()->get();
        $project = $tim->project()->first();

        // dd($project->tema);

        return view('siswa.tim.project', compact('title', 'tim', 'anggota', 'project'));
    }

    protected function historyPage($code)
    {
        $title = "Tim/history";
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->user()->get();

        return view('siswa.tim.history', compact('title', 'tim', 'anggota'));
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

        return view('siswa.tim.history-presentasi', compact('title', 'tim', 'anggota', 'presentasi', 'jadwal'));
    }

    protected function catatanPage($code)
    {
        $title = "catatan";
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->user()->get();

        return view('siswa.tim.catatan', compact('title', 'anggota', 'tim'));
    }

    protected function historyCatatanPage($code)
    {
        $title = "catatan history";
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim->user()->get();

        return view('siswa.tim.history-catatan', compact('title', 'anggota', 'tim'));
    }
}
