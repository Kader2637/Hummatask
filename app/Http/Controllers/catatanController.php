<?php

namespace App\Http\Controllers;

use App\Models\catatan;
use App\Models\CatatanDetail;
use App\Models\Penugasan;
use App\Models\Tim;
use App\Models\Tugas;
use App\Models\User;
use Carbon\Carbon;
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

            if (!$request->catatan_text) {
                return redirect()->back()->with('error', 'Isilah catatan terlebih dahulu!');
            }

            $tims = Tim::findOrfail($request->tim_id);
            $tim = $tims->id;

            $checkResult = $this->checkTeam($tims);
            if ($checkResult) {
                return $checkResult;
            }

            $statusAnggota = $tims->anggota->where('user_id', auth()->id())->first()->status;
            if ($statusAnggota == 'kicked') {
                return redirect()->back()->with('error', 'Anda tidak dapat membuat catatan karena Anda telah di-kick dari tim!');
            }

            $catatan = new catatan();
            $catatan->code = $tims->code;
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

            $catatan->type_note = $request->type_note;
            $catatan->save();

            $tugasIds = [];

            foreach ($request->catatan_text as $item) {
                $catatanDetail = CatatanDetail::create([
                    'catatan_id' => $catatan->id,
                    'catatan_text' => $item
                ]);

                $tugas = Tugas::create([
                    'tim_id' => $tims->id,
                    'code' => Str::uuid(),
                    'nama' => $catatanDetail->catatan_text,
                    'catatan_detail_id' => $catatanDetail->id,
                    'status_tugas' => 'tugas_baru',
                    'prioritas' => 'biasa',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                $tugasIds[] = $tugas->id;

                if ($tims->status_tim === 'solo') {
                    $penugasan = new Penugasan();
                    $penugasan->tugas_id = $tugas->id;
                    $penugasan->user_id = Auth::user()->id;
                    $penugasan->save();
                }
            }

            return redirect()->back()->with('success', 'Catatan berhasil dibuat!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Catatan gagal dibuat!');
        }
    }

    protected function update(Request $request, $id)
    {
        try {
            $catatan = Catatan::findOrFail($id);
            $catatan->title = $request->titleUpdate;
            $catatan->type_note = $catatan->type_note;

            if (!$request->catatan_text || count($request->catatan_text) === 0) {
                return redirect()->back()->with('error', 'Catatan harus diisi!');
            }

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

                        if ($tugas->wasRecentlyCreated && $catatanDetail->tim->status_tim === 'solo') {
                            $penugasan = new Penugasan();
                            $penugasan->tugas_id = $tugas->id;
                            $penugasan->user_id = Auth::user()->id;
                            $penugasan->update();
                        }
                    } else {
                        $createdTugas = Tugas::create([
                            'catatan_detail_id' => $catatanDetail->id,
                            'tim_id' => $request->tim_id,
                            'code' => Str::uuid(),
                            'nama' => $catatanDetail->catatan_text,
                            'status_tugas' => 'tugas_baru',
                            'prioritas' => 'biasa'
                        ]);

                        if ($catatanDetail->tim->status_tim === 'solo') {
                            $penugasan = new Penugasan();
                            $penugasan->tugas_id = $createdTugas->id;
                            $penugasan->user_id = Auth::user()->id;
                            $penugasan->save();
                        }
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

            $catatan->save();

            return redirect()->back()->with('success', 'Catatan berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Catatan gagal diupdate!');
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

    protected function deleteInput($id)
    {
        try {
            $catatanDetail = CatatanDetail::find($id);

            if (!$catatanDetail) {
                return response()->json(['message' => 'Catatan detail not found.'], 404);
            }

            $catatanDetail->delete();

            return response()->json(['message' => 'Catatan detail deleted successfully.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error deleting catatan detail.'], 500);
        }
    }
}
