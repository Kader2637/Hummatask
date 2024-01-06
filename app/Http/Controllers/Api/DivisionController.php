<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DivisiRequest;
use App\Models\Divisi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DivisionController extends Controller
{

    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $divisi = Divisi::query()
            ->get();
        return ResponseHelper::success($divisi);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(Divisi $request): JsonResponse
    {
        Divisi::query()
            ->create($request->validated());
        return ResponseHelper::success(null, 'Berhasil menambahkan divisi');
    }

    /**
     * update
     *
     * @param  mixed $divisi
     * @param  mixed $request
     * @return JsonResponse
     */
    public function update(Divisi $divisi, DivisiRequest $request): JsonResponse
    {
        $divisi
            ->update($request->validated());
        return ResponseHelper::success(null, 'Berhasil merubah divisi');
    }

    /**
     * destroy
     *
     * @param  mixed $divisi
     * @return JsonResponse
     */
    public function destroy(Divisi $divisi): JsonResponse
    {
        $divisi->delete();
        return ResponseHelper::success(null, 'Berhasil menghapus divisi');
    }
}
