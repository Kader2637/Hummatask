<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectAPI extends Controller
{
    public function getProject(): JsonResponse
    {
        $data = Project::query()
            ->with('tim.divisi', 'tim.user')
            ->get();

        return ResponseHelper::success($data);
    }
}
