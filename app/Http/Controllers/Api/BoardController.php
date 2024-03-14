<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Aktifitas;
use Illuminate\Support\Str;
use App\Models\Tim;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    public function index(string $code): JsonResponse
    {
        $tim = Tim::where('code', $code)->firstOrFail();

        $project = $tim->project->first();
        if ($project->deskripsi === null) {
            return back()->with('tolak', 'Tolong lengkapi deskripsi proyek terlebih dahulu');
        }
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

        $dataResponse = [
            'tugas_baru' => $tugas_baru,
            'tugas_dikerjakan' => $tugas_dikerjakan,
            'tugas_revisi' => $tugas_revisi,
            'tugas_selesai' => $tugas_selesai,
        ];
        return ResponseHelper::success($dataResponse);
    }

    /**
     * createTask
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function createTask(Request $request, string $code): JsonResponse
    {
        $tim = Tim::where('code', $code)->first();
        $user = User::where('id', Auth::user()->id)->first();
        $tugas = new Tugas();
        $tugas->tim_id = $tim->id;
        $tugas->code = Str::uuid();
        $tugas->nama = $request->nama;

        $tugas->catatan_detail_id = null;
        $tugas->save();
        Aktifitas::create([
            'tugas_id' => $tugas->id,
            'pelaku_id' => Auth::user()->id,
            'judul' => $tugas->nama,
            'status_tugas' => 'tugas_baru',
            'prioritas' => 'biasa',
            'status' => 'create',
        ]);

        return ResponseHelper::success(null, "Berhasil menambah");
    }
}
