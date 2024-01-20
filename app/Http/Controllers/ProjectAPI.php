<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Tim;
use Illuminate\Http\JsonResponse;

class ProjectAPI extends Controller
{
    public function getTeam(): JsonResponse
    {
        $data = Tim::query()
            ->leftJoin('projects', 'tims.id', '=', 'projects.tim_id')
            ->with(['project', 'tema', 'tugas', 'catatans', 'divisi', 'user'])
            ->orderByRaw("FIELD(projects.type_project, 'big', 'mini', 'pre_mini', 'solo')")
            ->get();

        return ResponseHelper::success($data);
    }

    public function getTeamDetail(mixed $code)
    {
        $data = Tim::query()
            ->where('code', $code)
            ->with(['project', 'tema', 'tugas', 'catatans.catatanDetail', 'divisi', 'user', 'anggota'])
            ->orderByRaw("FIELD(anggota.jabatan_id, '1', '2', '3')")
            ->get();

        return ResponseHelper::success($data);
    }
}
