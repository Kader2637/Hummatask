<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPengajuanSoloProject;
use App\Models\Anggota;
use App\Models\Project;
use App\Models\Tema;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Str;
// use Illuminate\Http\Request;

class PengajuanTimController extends Controller
{
    protected function pengajuanSoloProject(RequestPengajuanSoloProject $request)
    {

        // Kondisi dimana nama tim kosong atau foto kosong
        if ($request->nama === null || $request->logo === null) {
            return redirect()->back()->with('error', 'input Foto ataupun nama tim tidak boleh kosong');
        }

        // menyimpan logo
        $logo = $request->file('logo');
        $lokasiPenyimpanan = 'logo/';
        $namaLogo = $lokasiPenyimpanan . uniqid() . '.' . $logo->getClientOriginalExtension();
        $logo->storeAs($namaLogo);

        // membuat tim
        $tim = Tim::create([
            'code' => Str::uuid(),
            'nama' => $request->nama,
            'logo' => $namaLogo,
            'repository' => $request->repository,
            'status_tim' => 'solo'
        ]);

        // membuat anggota
        Anggota::create([
            'tim_id' => $tim->id,
            'jabatan_id' => 1,
            'user_id' => Auth::user()->id,
        ]);

        // membuat tema
        $tema = Tema::create([
            'code' => $tim->code,
            'nama_tema' => $request->temaInput,
            'tim_id' => $tim->id,
        ]);

        // membuat project
        $project = Project::create([
            'code' => $tim->code,
            'tim_id' => $tim->id,
            'tema_id' => $tema->id,
            'status_project' => 'approved',
            'deadline' => Carbon::now()->addWeek(),
            'type_project' => 'solo'
        ]);

        return redirect()->back()->with('success', 'Berhasil membuat tim solo project');
    }
}
