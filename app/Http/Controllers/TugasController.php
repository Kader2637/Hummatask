<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestBuatTugas;
use App\Http\Requests\RequestEditTugas;
use App\Models\Penugasan;
use App\Models\Tim;
use App\Models\Tugas;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
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

        $tugas = $tim->tugas()->with('comments','user')->get();
        $dataTugas = [
            "tugas_baru" =>  $tugas->where('status_tugas','tugas_baru'),
            "tugas_dikerjakan" => $tugas->where('status_tugas','dikerjakan'),
            "tugas_direvisi" => $tugas->where('status_tugas','direvisi'),
            "tugas_selesai" => $tugas->where('status_tugas','selesai'),
        ];


        return response()->json([
            "tugas" => $tugas,
        ]);
    }

    protected function buatTugas(RequestBuatTugas $request)
    {
        $tim = Tim::where('code', $request->tim_id)->first();
        $tugas = new Tugas;
        $tugas->tim_id = $tim->id;
        $tugas->code = Str::uuid();
        $tugas->nama = $request->nama;
        $tugas->save();

        $pengugasan = new Penugasan;
        $pengugasan->tugas_id = $tugas->id;
        $pengugasan->save();

        return response()->json($tugas->with(['user','comments'])->latest()->first());
    }

    protected function dataEditTugas($codeTugas)
    {
        try {
            //code...
            $tugas = Tugas::with('comments','user','tim.user')->where('code',$codeTugas)->first();


            return response()->json(
                $tugas);

        } catch (Exception $th) {
            return response()->json("error",$th);
        }

    }

    protected function prosesEditTugas(Request $request)
    {
        $tugas = Tugas::where('code',$request->codeTugas)->first();

        $tugas->nama = $request->nama;
        $tugas->prioritas = $request->prioritas;
        $tugas->deadline = $request->deadline;
        $tugas->status_tugas = $request->status_tugas;
        $tugas->save();
        
        $penugasan = $request->penugasan;
        foreach ($penugasan as $i => $data) {
            $tbPenugasan = new Penugasan;
            $tbPenugasan->tugas_id = $tugas->id;
            $user = User::where('uuid',$data)->first();
            $tbPenugasan->user_id = $user->id;
            $tbPenugasan->save();
        }

       


        return response()->json("sukses");
    }
}
