<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Tim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HistoryPresentation extends Controller
{
    /**
     * history
     *
     * @param  mixed $code
     * @return JsonResponse
     */
    public function history(string $code): JsonResponse
    {
        $tim = Tim::where('code', $code)->firstOrFail();
        $presentasi = $tim
            ->presentasi()
            ->orderBy('created_at', 'desc')
            ->get();

        return ResponseHelper::success($presentasi);

    }
}
