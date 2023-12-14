<?php

namespace App\Http\Controllers;

use App\Models\catatan;
use App\Models\Tim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class catatanController extends Controller
{
    protected function checkTeam(Tim $tim)
    {
        if ($tim->kadaluwarsa == 1) {
            return back()->with('error', 'Tim anda sudah kadaluwarsa');
        }
    }

    protected function store(Request $request)
    {
        try {
            if (!$request->contentCreate) {
                return redirect()->back()->with('error', 'Isilah catatan terlebih dahulu!');
            }

            $user = User::find(auth()->id());
            $tim = $user->tim()->latest()->first()->id;
            $tims = Tim::where('id', $tim)->first();

            $checkResult = $this->checkTeam($tims);
            if ($checkResult) {
                return $checkResult;
            }

            $statusAnggota = $tims->anggota->first()->status;
            if ($statusAnggota == 'kicked') {
                return redirect()->back()->with('error', 'Anda tidak dapat membuat catatan karena Anda telah di-kick dari tim!');
            }

            $catatan = new catatan();
            $catatan->code = Str::uuid();
            $catatan->tim_id = $tim;

            if ($request->type_note == 'private') {
                if ($request->titleCreate != null) {
                    $catatan->title = $request->titleCreate;
                } else {
                    $jumlahCatatan = catatan::where('tim_id', $tim)->where('type_note', 'private')->count();
                    $catatan->title = 'Catatan Tim ' . ($jumlahCatatan + 1);
                }
            } else if ($request->type_note == 'revisi') {
                if ($request->titleCreate != null) {
                    $catatan->title = $request->titleCreate;
                } else {
                    $jumlahCatatan = catatan::where('tim_id', $tim)->where('type_note', 'revisi')->count();
                    $catatan->title = 'Catatan Revisi ' . ($jumlahCatatan + 1);
                }
            }

            $catatan->content = $request->contentCreate;
            $catatan->type_note = $request->type_note;
            $catatan->save();

            return redirect()->back()->with('success', 'Catatan berhasil dibuat!');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Catatan gagal dibuat!');
        }
    }

    protected function update(Request $request, string $code)
    {
        try {
            $catatan = catatan::where('code', $code)->firstOrFail();
            $tim = $catatan->tim;

            $checkResult = $this->checkTeam($tim);
            if ($checkResult) {
                return $checkResult;
            }

            if ($catatan->type_note == 'revisi') {
                return back()->with('warning', 'Jenis catatan ini tidak bisa di edit');
            }

            if ($request->contentEdit == null || $request->contentEdit == '<p><br></p>' && $request->title === null) {
                $catatan->update([
                    'title' => $catatan->title,
                    'content' => $catatan->content,
                ]);
            } else {
                $catatan->update([
                    'title' => $request->titleEdit,
                    'content' => $request->contentEdit,
                ]);
            }

            return back()->with('success', 'Berhasil mengedit catatan!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal mengedit catatan!');
        }
    }

    protected function delete(string $code)
    {
        try {
            $catatan = catatan::where('code', $code)->firstOrFail();
            $tim = $catatan->tim;

            $checkResult = $this->checkTeam($tim);
            if ($checkResult) {
                return $checkResult;
            }

            if ($catatan->type_note == 'revisi') {
                return back()->with('error', 'Jenis catatan ini tidak bisa di hapus');
            } else {
                $catatan->delete();
            }
            return redirect()->back()->with('success', 'Catatan berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Catatan gagal dihapus!');
        }
    }
}
