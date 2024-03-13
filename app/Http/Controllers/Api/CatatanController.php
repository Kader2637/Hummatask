<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\catatan;
use App\Models\Notifikasi;
use App\Models\Tim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    public function index(string $code): JsonResponse
    {
        $tim = Tim::where('code', $code)->firstOrFail();
        $catatans = catatan::where('tim_id', $tim->id)->get();
        $userID = auth()->user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        $project = $tim->project->first();
        if ($project->deskripsi === null) {
            return back()->with('tolak', 'Tolong lengkapi deskripsi proyek terlebih dahulu');
        }
        $anggota = $tim->user()->get();
        $project = $tim->project->first();

        $hasProjectRelation = $tim->project()->exists();

        $catatanTeam = catatan::whereHas('CatatanDetail', function ($query) {
            $query->whereColumn('catatan_details.catatan_id', 'catatans.id');
        })
        ->with('catatanDetail')
        ->get();

        return ResponseHelper::success($catatans);
    }
}
