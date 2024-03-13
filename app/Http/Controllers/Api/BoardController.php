<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\catatan;
use App\Models\Tim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
