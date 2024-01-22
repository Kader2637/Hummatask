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
use Carbon\CarbonImmutable;

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
        $customDateMingguan = $request->input('Mingguan');

        switch ($filterType) {
            case 'Mingguan':
                $yearWeekArray = explode('-W', trim($customDateMingguan));

                if (count($yearWeekArray) == 2) {
                    $year = $yearWeekArray[0];
                    $week = $yearWeekArray[1];

                    $startOfWeek = CarbonImmutable::now()->setISODate($year, $week, 1)->startOfWeek();
                    $endOfWeek = CarbonImmutable::now()->setISODate($year, $week, 7)->endOfWeek();

                    $presentasi->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                }
                break;

            case 'Bulanan':
                $customDateBulanan = $request->input('Bulanan');
                $parsedDate = Carbon::parse($customDateBulanan);
                $presentasi->whereYear('created_at', $parsedDate->year);
                $presentasi->whereMonth('created_at', $parsedDate->month);
                break;

            case 'Semua':
                break;

            default:
                $presentasi->whereDate('created_at', today());
                break;
        }

        $presentasiFilter = $presentasi->with('tim', 'divisi', 'tim.user')
            ->get();

        return response()->json([
            'presentasi' => $presentasiFilter,
            'tim' => $tim,
        ]);
    }
}
