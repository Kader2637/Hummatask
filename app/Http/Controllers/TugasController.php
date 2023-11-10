<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestBuatTugas;
use App\Models\Penugasan;
use App\Models\Tim;
use App\Models\Tugas;
use Illuminate\Support\Str;


class TugasController extends Controller
{

    protected function getData($code)
    {
        try {
            //code...
            $tim = Tim::where('code', $code)->first();
        } catch (\Throwable $th) {
            return response()->json(['error'=>'Tim tidak dapat ditemukan']);
        }

        $tugas = $tim->tugas()->with('comments')->get();
        $dataTugas = [
            "tugas_baru" =>  $tugas->where('status_tugas','tugas_baru'),
            "tugas_dikerjakan" => $tugas->where('status_tugas','dikerjakan'),
            "tugas_direvisi" => $tugas->where('status_tugas','direvisi'),
            "tugas_selesai" => $tugas->where('status_tugas','selesai'),
        ];


        return response()->json([
            "tugas" => $dataTugas,
        ]);
    }

    protected function buatTugas(RequestBuatTugas $request)
    {
        $tim = Tim::where('code', $request->tim_id)->first();
        $tugas = new Tugas;
        $tugas->tim_id = $tim->id;
        $tugas->uuid = Str::uuid();
        $tugas->nama = $request->nama;
        $tugas->save();

        $pengugasan = new Penugasan;
        $pengugasan->tugas_id = $tugas->id;
        $pengugasan->save();



        return response()->json($tugas->with(['user','comments'])->latest()->first());
    }
}
