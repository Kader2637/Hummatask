<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LimitPresentasiDivisiRequest;
use App\Http\Requests\PresentasiDivisiRequest;
use App\Models\LimitPresentasiDevisi;
use App\Models\PresentasiDivisi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PresentasiDivisiController extends Controller
{
    /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(PresentasiDivisiRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['divisi_id'] = auth()->user()->divisi_id;
        PresentasiDivisi::query()
            ->updateOrCreate(['divisi_id' => $data['divisi_id'], 'day' => $data['day']], ['limit' => $data['limit']]);
        return ResponseHelper::success(null, 'Berhasil menambahkan limit');
    }

    /**
     * createJam
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function createJam(LimitPresentasiDivisiRequest $request): JsonResponse
    {
        $data = $request->validated();
        $pDivisi = PresentasiDivisi::query()
            ->findOrFail($data['presentasi_divisi_id']);
        $pDivisi->limitPresentasiDivisis()->delete();
        for ($i = 0; $i < (int) $pDivisi->limit; $i++) {
            LimitPresentasiDevisi::query()
                ->create([
                    'presentasi_divisi_id' => $data['presentasi_divisi_id'],
                    'jadwal_ke' => $data['jadwal_ke'][$i],
                    'mulai' => $data['mulai'][$i],
                    'akhir' => $data['akhir'][$i]
                ]);
        }
        return ResponseHelper::success(null, 'Berashil membuat jadwal');

    }
}
