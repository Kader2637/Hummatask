<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use App\Models\User;


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
}
