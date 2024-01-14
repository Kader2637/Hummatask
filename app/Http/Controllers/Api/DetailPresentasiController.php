<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Presentasi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DetailPresentasiController extends Controller
{

    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $presentasi = Presentasi::query()
            ->get();
        return ResponseHelper::success($presentasi);
    }
}
