<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class StatistikTimController extends Controller
{
    protected function getDataKontribusi($code,$uuid)
    {

        // $user = User::where('uuid', $uuid)->with(['tim' => function ($query) use ($code) {
        //     $query->where('code', $code)->with('tugas');
        // }])->first();
        $tugasTerkontribusi = User::where('uuid', $uuid)->first()->tim->where('code',$code)->first()->tugas;
        $tugasMendesak = $tugasTerkontribusi->where('prioritas','mendesak')->count();
        $tugasPenting = $tugasTerkontribusi->where('prioritas','penting')->count();
        $tugasBiasa = $tugasTerkontribusi->where('prioritas','biasa')->count();
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
