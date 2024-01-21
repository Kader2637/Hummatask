<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Tim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProjectAPI extends Controller
{
    public function getTeam(Request $request): JsonResponse
    {
        $filter = $request->input('filter');
        $nama_tim = $request->input('nama_tim');

        $query = Tim::query()
            ->with(['project', 'tema', 'tugas', 'catatans', 'divisi', 'user']);

        if ($filter && $filter !== 'all') {
            $query->where('status_tim', $filter);
        }

        if ($nama_tim) {
            $query->where('nama', 'like', '%' . $nama_tim . '%');
        }

        $perPage = $request->input('perPage', 10);
        $currentPage = $request->input('page', 1);

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $data = $query->paginate($perPage);

        return ResponseHelper::success($data);
    }

    public function getTeamDetail(mixed $code)
    {
        $data = Tim::query()
            ->where('code', $code)
            ->with(['project', 'tema', 'tugas.subPenugasan', 'catatans.catatanDetail', 'divisi', 'user', 'anggota', 'tugas.labelTugas.label'])
            ->get();

        return ResponseHelper::success($data);
    }
}
