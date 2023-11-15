<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Penugasan;
use App\Models\Tim;
use App\Models\Tugas;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $tugas = $tim->tugas()->with('comments.user','user')->get();
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

    protected function buatTugas(Request $request)
    {

        $validator = validator($request->all(),
        [
            "nama" => "string|max:100"
        ],
        [
            "nama.string" => "Nama tugas harus berupa strinig",
            "nama.max:100" => "Nama tugas memiliki maksimal 100 karakter",
        ]
        );

        if($validator->fails()){
            return response()->json(
                [
                    "errors" => $validator->errors()
                ],422
                );
        }

        $tim = Tim::where('code', $request->tim_id)->first();
        $tugas = new Tugas;
        $tugas->tim_id = $tim->id;
        $tugas->code = Str::uuid();
        $tugas->nama = $request->nama;
        $tugas->save();

        if($tim->status_tim === "solo"){
            $penugasan = new Penugasan;
            $penugasan->tugas_id = $tugas->id;
            $penugasan->user_id = Auth::user()->id;
            $penugasan->save();
        }

        return response()->json($tugas->with(['user','comments'])->latest()->first());
    }

    protected function dataEditTugas($codeTugas)
    {
        try {
            //code...
            $tugas = Tugas::with('comments.user','user','tim.user')->where('code',$codeTugas)->first();


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

        $penugasan = $request->penugasan;
        $currentPenugasan = $tugas->user->pluck('uuid')->toArray();

        $userToAdd = array_diff($penugasan,$currentPenugasan);
        $userToRemove = array_diff($currentPenugasan,$penugasan);



        foreach ($userToAdd as $i => $data) {
            $user = User::where('uuid', $data)->first();
            if ($user) {
                $penugasan = new Penugasan;
                $penugasan->tugas_id = $tugas->id;
                $penugasan->user_id = $user->id;
                $penugasan->save();
            }
        }


        foreach ($userToRemove as $data) {
            $user = User::where('uuid', $data)->first();
            if ($user) {
                $penugasanTb = Penugasan::where('tugas_id', $tugas->id)->where('user_id', $user->id)->delete();

            }
        }


        $tugas->save();
        return response()->json("sukses");
    }

    protected function hapusTugas($codeTugas)
    {
        $tugas = Tugas::where('code',$codeTugas)->first();
        $tugas->delete();

        return response()->json(["success"=>"Berhasil menghapus tugas"]);
    }

    protected function tambahKomentar(Request $request)
    {

        if($request->komentar_id === 0){
            $tugas = Tugas::where("code",$request->tugas_code)->first();
            $komentar = new Comments;
            $komentar->user_id = Auth::user()->id;
            $komentar->tugas_id = $tugas->id;
            $komentar->text = $request->text;
            $komentar->save();

            return response()->json(["success"=>"Berhasil membuat komentar"]);
        }else{
            $komentar = Comments::where('id',$request->komentar_id)->first();
            $komentar->text = $request->text;
            $komentar->save();

            return response()->json(["success","Berhasil mengupdate komentar"]);
        }




    }

    protected function hapusKomentar($komentar_id)
    {

        $komentar = Comments::find($komentar_id);
        $komentar->delete();

        return response()->json(["success","Menghapus komentar"]);
    }


}
