<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Project;
use App\Models\Tim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectAPI extends Controller
{
    public function getTeam(): JsonResponse
    {
        $data = Tim::query()
            ->leftJoin('projects', 'tims.id', '=', 'projects.tim_id')
            ->with(['project', 'tema', 'tugas', 'catatans', 'divisi', 'user'])
            ->orderByRaw("FIELD(projects.type_project, 'big', 'mini', 'pre_mini', 'solo')")
            ->orderBy('status_tim', 'desc')
            ->get();

        return ResponseHelper::success($data);
    }

    public function getTeamDetail(mixed $code)
    {
        $data = Tim::query()
            ->where('tims.code', $code)
            ->leftJoin('projects', 'tims.id', '=', 'projects.tim_id')
            ->with(['project', 'tema', 'tugas', 'catatans', 'divisi', 'user'])
            ->orderByRaw("FIELD(projects.type_project, 'big', 'mini', 'pre_mini', 'solo')")
            ->orderBy('status_tim', 'desc')
            ->get();

        return ResponseHelper::success($data);
    }
}
