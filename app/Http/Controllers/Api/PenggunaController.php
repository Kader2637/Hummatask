<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class PenggunaController extends Controller
{
        /**
     * index
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $pengguna = User::query()->get();
        return ResponseHelper::success($pengguna);
    }

     /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(User $request): JsonResponse
    {
        User::query()
            ->create($request->validated());
        return ResponseHelper::success(null, 'Berhasil menambahkan User');
    }

     /**
     * update
     *
     * @param  mixed $divisi
     * @param  mixed $request
     * @return JsonResponse
     */
    public function update(User $pengguna, UserRequest $request): JsonResponse
    {
        $pengguna
            ->update($request->validated());
        return ResponseHelper::success(null, 'Berhasil merubah divisi');
    }

     /**
     * destroy
     *
     * @param  mixed $divisi
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return ResponseHelper::success(null, 'Berhasil menghapus divisi');
    }

}

