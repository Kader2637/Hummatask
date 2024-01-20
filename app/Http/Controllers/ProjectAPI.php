<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Tim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectAPI extends Controller
{
    public function getTeam(Request $request): JsonResponse
    {
        $filter = $request->input('filter');

        $query = Tim::query()
            ->with(['project', 'tema', 'tugas', 'catatans', 'divisi', 'user'])
            ->join('projects', 'projects.tim_id', '=', 'tim.id')
            ->where('projects.type_project', $filter);

        $data = $query->get();

        return ResponseHelper::success($data);
    }


    public function getTeamDetail(mixed $code)
    {
        $data = Tim::query()
            ->where('code', $code)
            ->with(['project', 'tema', 'tugas', 'catatans.catatanDetail', 'divisi', 'user', 'anggota'])
            ->get();

        return ResponseHelper::success($data);
    }
}
