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
        if($request->judul === null){
            return back()->with('error','Judul presentasi tidak boleh kosong');
        }

        if($request->deskripsi === null){
            return back()->with('error','Deskripsi presentasi tidak boleh kosong');
        }


        if(Str::length($request->judul) > 50){
            return back()->with('error','Judul presentasi tidak boleh melebihi 50 karakter');
        }

        if(Str::length($request->deskripsi) > 700){
            return back()->with('error','Deskripsi presentasi tidak boleh melebihi 700 karakter');
        }

        // if(Carbon::now()->isoFormat('HH:m:ss') < "08:00:00" ){
        //     return back()->with('error','Pengajuan Presentasi dimulai pukul 08:00');
        // }

        // if(Carbon::now()->isoFormat('HH:m:ss') > "15:00:00" ){
        //     return back()->with('error','Pengajuan Presentasi tidak boleh lebih dari pukul 15:00');
        // }


        $history = HistoryPresentasi::latest()->pluck('id')->first();

        if($history === null){
            HistoryPresentasi::create([
                'code' => Str::uuid(),
            ]);
        }

        try {
            //code...
            $tim = Tim::where('code',$code)->first();

            // $validasi = $tim->presentasi->where('jadwal',Carbon::now()->isoFormat('YYYY-M-DD'))->first();


            // if( $validasi != null ){
            //     return back()->with('error','Pengajuan presentasi dalam sehari hanya boleh 1 kali');
            // }

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Timmu tidak ditemukan');
        }

        $presentasi = new Presentasi;
        $presentasi->code = Str::uuid();
        $presentasi->judul = $request->judul;
        $presentasi->deskripsi = $request->deskripsi;
        $presentasi->jadwal = Carbon::now()->isoFormat('Y-M-DD');
        $presentasi->tim_id = $tim->id;
        $presentasi->status_presentasi_mingguan = true;
        $presentasi->history_presentasi_id = $history;
        $presentasi->save();


        return redirect()->back()->with('success','Berhasil mengajukan presentasi');

    }



    protected function persetujuanPresentasi(RequestPersetujuanPresentasi $request, $code)
    {
        $dataPresentasi = Presentasi::where('jadwal',Carbon::now()->isoFormat('Y-M-DD'))->where('status_pengajuan','disetujui')->get()->count();
        $presentasi = Presentasi::with('tim.project.tema')->where('code', $code)->first();
        $presentasi->urutan = ($dataPresentasi === null ) ?  1   :  ++$dataPresentasi ;
        $presentasi->status_pengajuan = 'disetujui';
        $presentasi->save();
        return response()->json($presentasi);
    }

    protected function penolakanPresentasi(RequestPenolakanPresentasi $request, $code)
    {

        if($request->feedback === null){
            return  response()->json(["error"=>"Alasan penolakan tidak boleh kosong"]);
        }


        $presentasi = Presentasi::where('code', $code)->first();
        $presentasi->status_pengajuan = 'ditolak';
        $presentasi->feedback = $request->alasan;
        $presentasi->save();

        return response()->json(['success'=>'Berhasil Memberikan Penolakan']);
    }

    protected function konfirmasiPresentasi(Request $request, $code)
    {

        if($request->status_revisi === null){
            return response()->json(['success'=>'Status revisi tidak boleh kosong']);
        }

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
        $history = HistoryPresentasi::with(['presentasi.tim.user','presentasi.tim.project.tema'])->where('code',$code)->first();
        $presentasi = $history->presentasi->where('status_pengajuan','menunggu');
        $konfirmasi_presentasi = $history->presentasi->where('status_pengajuan','disetujui')->where('status_presentasi','menunggu')->sortByDesc('urutan');
        $tim_belum_presentasi = Tim::with('user','project.tema')->where('sudah_presentasi',false)->get();
        $telat_presentasi = $history->presentasi->where('status_presentasi','telat');
        $urutanPresentasi = $history->presentasi->where('status_presentasi','menunggu')->where('status_pengajuan','disetujui')->where('jadwal',Carbon::now()->isoFormat('Y-M-DD'));


        $data = [
            'presentasi' => $presentasi,
            'konfirmasi' => $konfirmasi_presentasi,
            'belum_presentasi' => $tim_belum_presentasi,
            'telat_presentasi' => $telat_presentasi,
            'urutanPresentasi' => $urutanPresentasi
        ];

        return response()->json($data);
    }

    protected function gantiUrutan(Request $request, $code)
    {
        $presentasi = Presentasi::where('status_presentasi', 'menunggu')
            ->where('status_pengajuan', 'disetujui')
            ->where('jadwal', Carbon::now()->isoFormat('Y-M-DD'))
            ->orderBy('urutan', 'asc')
            ->get();

        $urutanTergantikan = $request->urutanTergantikan;

        // Temukan presentasi yang akan digantikan
        $pengganti = $presentasi->where('code', $code)->first();

       foreach ($presentasi as $data) {
            if($data->urutan >= $urutanTergantikan){
                if($data->urutan === $pengganti->urutan){
                    $pengganti->urutan = $urutanTergantikan;
                    $pengganti->save();
                }else{
                    $data->urutan += 1;
                    $data->save();

                }
            }
       }


        return response()->json($pengganti);
    }


}
