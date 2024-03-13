<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\TimResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TimController extends Controller
{
    public function index(): JsonResponse
    {
        $tims = User::findOrFail(auth()->user()->id)->tim()
            ->latest()
            ->orderBy('status', 'desc')
            ->get();
        return ResponseHelper::success(TimResource::collection($tims));
    }

    /**
     * activeTeam
     *
     * @return JsonResponse
     */
    public function activeTeam(): JsonResponse
    {
        return ResponseHelper::success(User::find(auth()->user()->id)->tim()->where('kadaluwarsa', 0)->first());
    }
}
