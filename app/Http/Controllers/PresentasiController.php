<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAturJadwal;
use App\Http\Requests\RequestKonfirmasiPresentasi;
use App\Http\Requests\RequestPengajuanPresentasi;
use App\Http\Requests\RequestPenolakanPresentasi;
use App\Http\Requests\RequestPersetujuanPresentasi;
use App\Models\HistoryPresentasi;
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
            //code...
            $tim= Tim::where('code',$code)->first();
            $validasiSatuKaliPresentasi = $tim->presentasi->where('jadwal',Carbon::now())->first();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Timmu tidak ditemukan');
        }

        if(Str::length($request->judul) > 50){
            return back()->with('error','Judul presentasi tidak boleh melebihi 50 karakter');
        }

        if(Str::length($request->deskripsi) > 700){
            return back()->with('error','Deskripsi presentasi tidak boleh melebihi 700 karakter');
        }

        // dd($validasiSatuKaliPresentasi);
        // if($validasiSatuKaliPresentasi === null){
        //     return back()->with('error','Kamu sudah memiliki jadwal presentasi hari ini');
        // }

        $history = HistoryPresentasi::latest()->pluck('id')->first();

        if($history === null){
            HistoryPresentasi::create([
                'code' => Str::uuid(),
            ]);
        }


        // dd($history);

        $presentasi = new Presentasi;
        $presentasi->code = Str::uuid();
        $presentasi->judul = $request->judul;
        $presentasi->deskripsi = $request->deskripsi;
        $presentasi->jadwal = Carbon::now();
        $presentasi->tim_id = $tim->id;
        $presentasi->status_presentasi_mingguan = true;
        $presentasi->history_presentasi_id = $history;
        $presentasi->save();


        return redirect()->back()->with('success','Berhasil mengajukan presentasi');

    }



    protected function persetujuanPresentasi(RequestPersetujuanPresentasi $request, $code)
    {

        $dataPresentasi = Presentasi::where('jadwal',Carbon::now()->isoFormat('Y-M-DD'))->where('status_pengajuan','disetujui')->get();
        $urutan = count($dataPresentasi);
        $presentasi = Presentasi::with('tim.project.tema')->where('code', $code)->first();
        $presentasi->urutan = $urutan + 1;
        $presentasi->status_pengajuan = 'disetujui';
        $presentasi->save();
        return response()->json($presentasi);
    }

    protected function penolakanPresentasi(RequestPenolakanPresentasi $request, $code)
    {
        $presentasi = Presentasi::where('code', $code)->first();
        $presentasi->status_pengajuan = 'ditolak';
        $presentasi->feedback = $request->alasan;
        $presentasi->save();

        return response()->json($presentasi);
    }

    protected function konfirmasiPresentasi(RequestKonfirmasiPresentasi $request, $code)
    {
        $presentasi = Presentasi::where('code',$code)->first();
        $presentasi->status_presentasi = $request->persetujuan;
        $presentasi->status_revisi = $request->status_revisi;
        $presentasi->feedback = $request->feedback;
        $presentasi->save();
        return response()->json($presentasi);
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

    protected function tampilkanDetailPresentasi(Request $request,$code)
    {
        $history = HistoryPresentasi::with('presentasi.tim.user','presentasi.tim.project.tema')->where('code',$code)->first();
        $presentasi = $history->presentasi->where('status_pengajuan','menunggu');
        $konfirmasi_presentasi = $history->presentasi->where('status_pengajuan','disetujui')->where('status_presentasi','menunggu');
        $tim_belum_presentasi = Tim::with('user','project.tema')->doesntHave('presentasi')->get();
        $telat_presentasi = $history->presentasi->where('status_presentasi','telat');

        $data = [
            'presentasi' => $presentasi,
            'konfirmasi' => $konfirmasi_presentasi,
            'belum_presentasi' => $tim_belum_presentasi,
            'telat_presentasi' => $telat_presentasi,
        ];

        return response()->json($data);
    }



}
