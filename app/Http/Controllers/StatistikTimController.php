<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use App\Models\User;
use Exception;


class StatistikTimController extends Controller
{
    protected function getDataKontribusi($code,$uuid)
    {

        // $user = User::where('uuid', $uuid)->with(['tim' => function ($query) use ($code) {
        //     $query->where('code', $code)->with('tugas');
        // }])->first();

        $user = Tim::where('code',$code)->first()->user->where('uuid',$uuid)->first();

        $tugasTerkontribusi = $user->tugas;
        $tugasMendesak = $user->tugas->where('prioritas','mendesak')->count();
        $tugasPenting = $user->tugas->where('prioritas','penting')->count();
        $tugasBiasa = $user->tugas->where('prioritas','biasa')->count();

        try {
            $presentaseTugasSelesai = ($tugasTerkontribusi->where('status_tugas', 'selesai')->count() / $tugasTerkontribusi->count()) * 100;
        } catch (\Throwable $th) {
            $presentaseTugasSelesai = 0;
        }

        $tugas =[
            "tugasMendesak" => $tugasMendesak,
            "tugasTerkontribusi" => $tugasTerkontribusi,
            "tugasPenting" => $tugasPenting,
            "tugasBiasa" => $tugasBiasa,
            "presentaseTugasSelesai" => $presentaseTugasSelesai,
        ];

        return response()->json($tugas);
    }

    protected function getProgres($codeTim){

            $tugas = Tim::where('code',$codeTim)->first()->tugas;

        
            $tugas_baru = $tugas->where('status_tugas','tugas_baru')->count();
            $tugas_dikerjakan = $tugas->where('status_tugas','dikerjakan')->count();
            $tugas_selesai = $tugas->where('status_tugas','selesai')->count();
            $tugas_direvisi = $tugas->where('status_tugas','revisi')->count();

            $presentase_tugas_baru = $tugas_baru !== 0 ? ($tugas_baru / $tugas->count())*100 : 0;
            $presentase_tugas_dikerjakan = $tugas_dikerjakan !== 0 ? ($tugas_dikerjakan / $tugas->count())*100 : 0;
            $presentase_tugas_selesai = $tugas_selesai !== 0 ? ($tugas_selesai / $tugas->count())*100 : 0;
            $presentase_tugas_direvisi = $tugas_direvisi !== 0 ? ($tugas_direvisi /$tugas->count())*100 : 0;


            return response()->json([
                "tugas_baru" => $tugas_baru,
                "tugas_direvisi" => $tugas_direvisi,
                "tugas_selesai" => $tugas_selesai,
                "tugas_dikerjakan" => $tugas_dikerjakan,
                "persentase_tugas_baru"=> $presentase_tugas_baru,
                "persentase_tugas_dikerjakan" => $presentase_tugas_dikerjakan,
                "persentase_tugas_selesai" => $presentase_tugas_selesai,
                "persentase_tugas_direvisi" => $presentase_tugas_direvisi,
            ]);


    }
}
