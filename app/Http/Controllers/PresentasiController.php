<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPengajuanPresentasi;
use App\Http\Requests\RequestPersetujuanPresentasi;
use App\Models\Presentasi;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PresentasiController extends Controller
{
    protected function ajukanPresentasi(RequestPengajuanPresentasi $request,$code)
    {

        try {
            //code...
            $tim_id = Tim::where('code',$code)->pluck('id')->first();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Timmu tidak ditemukan');
        }


        $presentasi = new Presentasi;
        $presentasi->code = Str::uuid();
        $presentasi->judul = $request->judul;
        $presentasi->deskripsi = $request->deskripsi;
        $presentasi->jadwal = $request->jadwal;
        $presentasi->tim_id = $tim_id;
        $presentasi->save();

        return redirect()->back()->with('success','Berhasil mengajukan presentasi');

    }



    protected function persetujuanPresentasi(RequestPersetujuanPresentasi $request, Presentasi $presentasi)
    {

        dd($request,$presentasi);

    }


}
