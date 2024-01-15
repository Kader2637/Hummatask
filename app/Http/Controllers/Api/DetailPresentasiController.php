<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Anggota;
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
    public function index()
    {
        $presentasi = Presentasi::query()
            ->with('tim','divisi')
            ->get();
        $anggota = Anggota::query()
            ->with('user')
            ->get();
            return response()->json([
                'presentasi' => $presentasi,
                'anggota' => $anggota,
            ]);
    }
}
