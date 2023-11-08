<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestBuatTugas;
use App\Http\Requests\StoreTugasRequest;
use App\Http\Requests\UpdateTugasRequest;
use App\Models\Anggota;
use App\Models\Tim;
use App\Models\Tugas;
use Illuminate\Support\Str;

class TugasController extends Controller
{

    protected function getData($code)
    {
        $tim = Tim::where('code', $code)->first();
        $tugas = $tim->tugas->get();
        return response()->json($tugas, $tim);
    }

    protected function buatTugas(RequestBuatTugas $request)
    {

        $tim = Tim::where('code', $request->tim_id)->first();

        $tugas = new Tugas;
        $tugas->tim_id = $tim->id;
        $tugas->uuid = Str::uuid();
        $tugas->nama = $request->nama;
        $tugas->save();

        return response()->json($tugas);
    }
}
