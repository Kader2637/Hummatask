<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Presentasi;
use App\Models\Tim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DetailPresentasiController extends Controller
{

    /**
     * index
     *
     * @return JsonResponse
     */
    public function index()
    {
        $presentasi = Presentasi::query()
            ->with('tim','divisi','tim.user')
            ->get();

        $tim = Tim::query()
            ->get();
            return response()->json([
                'presentasi' => $presentasi,
                'tim' => $tim,
            ]);
    }
}
