<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Presentasi;
use App\Models\Tim;
use Carbon\Carbon;
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
        $customDateMingguan = $request->input('Mingguan');

        switch ($filterType) {
            case 'Mingguan':
                $startDate = Carbon::createFromFormat('Y-W', $customDateMingguan)->startOfWeek();
                $endDate = Carbon::createFromFormat('Y-W', $customDateMingguan)->endOfWeek();
                $presentasi->whereBetween('created_at', [$startDate, $endDate]);
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
