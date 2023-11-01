<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAturJadwal;
use App\Http\Requests\RequestKonfirmasiPresentasi;
use App\Http\Requests\RequestPengajuanPresentasi;
use App\Http\Requests\RequestPenolakanPresentasi;
use App\Http\Requests\RequestPersetujuanPresentasi;
use App\Models\Presentasi;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Psy\VarDumper\Presenter;

class PresentasiController extends Controller
{
    protected function ajukanPresentasi(RequestPengajuanPresentasi $request, $code)
    {

        try {
            $tim_id = Tim::where('code', $code)->pluck('id')->first();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Timmu tidak ditemukan');
        }

        dd($request);
        
        $presentasi = new Presentasi;
        $presentasi->code = Str::uuid();
        $presentasi->judul = $request->judul;
        $presentasi->deskripsi = $request->deskripsi;
        $presentasi->jadwal = $request->jadwal;
        $presentasi->tim_id = $tim_id;
        $presentasi->save();

        return redirect()->back()->with('success', 'Berhasil mengajukan presentasi');
    }



    protected function persetujuanPresentasi(RequestPersetujuanPresentasi $request, $code)
    {

        $presentasi = Presentasi::where('code', $code)->first();
        $presentasi->status_pengajuan = 'disetujui';
        $presentasi->save();

        return response()->json(['message' => 'success']);
    }

    protected function penolakanPresentasi(RequestPenolakanPresentasi $request, $code)
    {
        $presentasi = Presentasi::where('code', $code)->first();
        $presentasi->status_pengajuan = 'ditolak';
        $presentasi->alasan = $request->alasan;
        $presentasi->save();

        return response()->json(['Message' => 'success']);
    }

    protected function konfirmasiPresentasi(RequestKonfirmasiPresentasi $request, $code)
    {
        $presentasi = Presentasi::where('code', $code)->first();
        $presentasi->status_pengajuan = 'disetujui';
        $presentasi->save();

        return response()->json(['message' => 'success']);
    }

    protected function aturJadwal(Request $request, $code)
    {
        $presentasi = Presentasi::where('code', $code)->first();
        $presentasi->jadwal = $request->jadwalBaru;
        $presentasi->save();

        $jadwal = Carbon::parse($presentasi->jadwal)->isoFormat('DD MMMM YYYY');
        $hari = Carbon::parse($presentasi->jadwal)->isoFormat('dddd');
        return response()->json([$jadwal, $hari]);
    }
}
