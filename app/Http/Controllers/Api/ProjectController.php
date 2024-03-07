<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectMemberResource;
use App\Models\Notifikasi;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($code)
    {
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim
            ->anggota()
            ->orderBy('jabatan_id')
            ->get();

        $project = $tim->project->first();

        return ResponseHelper::success([
            'name' => $tim->nama,
            'logo' => asset('storage/'.$tim->logo),
            'status_tim' => $tim->status_tim,
            'kadaluarsa' => $tim->kadaluwarsa,
            'repository' => $tim->repository,
            'tema' => $project->tema->nama_tema,
            'anggotas' =>  $anggota,
        ]);
    }

    public function anggota(string $code)
    {
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim
            ->anggota()
            ->orderBy('jabatan_id')
            ->get();
        return ResponseHelper::success(ProjectMemberResource::collection($anggota));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
