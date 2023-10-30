<?php

namespace App\Http\Controllers;

use App\Models\Presentasi;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PresentasiController extends Controller
{
    protected function ajukanPresentasi(Request $request,$code)
    {

        $tim_id = Tim::pluck('id')->where('code',$code);

        $presentasi = new Presentasi;
        $presentasi->code = Str::uuid();
        $presentasi->judul = $request->judul;
        $presentasi->deskripsi = $request->deskripsi;
        $presentasi->jadwal = $request->jadwal;
        $presentasi->tim_id = $tim_id;
        $presentasi->save();

        dd($presentasi);
        // return response()->json($presentasi);

    }
}
