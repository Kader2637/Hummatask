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
    public function index(Request $request)
    {
        $presentasi = Presentasi::query();
        $tim = Tim::query()->get();

        $filterType = $request->input('filter_type');
        $customDate = $request->input('Harian');

        switch ($filterType) {
            case 'Mingguan':
                
                break;

            case 'Bulanan':
                
                break;

            case 'Harian':
                $presentasi->whereDate('created_at', $customDate);
                break;

            default:
        }

        $presentasiFilter = $presentasi->with('tim', 'divisi', 'tim.user')->get();

        return response()->json([
            'presentasi' => $presentasiFilter,
            'tim' => $tim,
        ]);
    }
}
