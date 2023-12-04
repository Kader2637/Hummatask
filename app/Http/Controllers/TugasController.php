<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Label;
use App\Models\LabelTugas;
use App\Models\Notifikasi;
use App\Models\Penugasan;
use App\Models\Tim;
use App\Models\Tugas;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TugasController extends Controller
{
    protected function checkTeam(Tim $tim)
    {
        if ($tim->kadaluwarsa == 1) {
            return response()->json(
                [
                    "errors" => [
                        "message" => "Tim anda sudah kadaluwarsa"
                    ]
                ],
                422
            );
        }
    }

    protected function getData($code)
    {
        try {
            //code...
            $tim = Tim::where('code', $code)->first();
        $user = $tim->user->where('id',Auth::user()->id)->first();


        } catch (\Throwable $th) {
            return response()->json(['error' => 'Tim tidak dapat ditemukan']);
        }

        $tugas = $tim->tugas()->with('comments.user', 'user','label')->get();
        $dataTugas = [
            "tugas_baru" =>  $tugas->where('status_tugas', 'tugas_baru'),
            "tugas_dikerjakan" => $tugas->where('status_tugas', 'dikerjakan'),
            "tugas_direvisi" => $tugas->where('status_tugas', 'direvisi'),
            "tugas_selesai" => $tugas->where('status_tugas', 'selesai'),
        ];

        // dd($tugas);

        return response()->json([
            "tugas" => $tugas,
            "status_keanggotaan" => $user->anggota->status,
        ]);
    }

    protected function buatTugas(Request $request)
    {


        $tim = Tim::where('code', $request->tim_id)->first();
        $user = $tim->user->where('id',Auth::user()->id)->first();

        if ($user->anggota->status !== "active") {
            return response()->json([
                "errors" => ["Anda sudah bukan menjadi bagian dari tim"]
            ],422);
        }

        $checkResult = $this->checkTeam($tim);


        if ($checkResult) {
            return $checkResult;
        }

        $validator = validator(
            $request->all(),
            [
                "nama" => "required|string|max:50"
            ],
            [
                "nama.required" => "Nama tugas wajib diisi",
                "nama.string" => "Nama tugas harus berupa string",
                "nama.max" => "Nama tugas memiliki maksimal 50 karakter",
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    "errors" => $validator->errors()
                ],
                422
            );
        }

        $tugas = new Tugas;
        $tugas->tim_id = $tim->id;
        $tugas->code = Str::uuid();
        $tugas->nama = $request->nama;
        $tugas->save();
        $this->sendNotificationToTeamMembers($tim->anggota, 'Tugas Baru', 'Anggota tim telah membuat tugas baru : ' . $tugas->nama , 'info');

        if ($tim->status_tim === "solo") {
            $penugasan = new Penugasan;
            $penugasan->tugas_id = $tugas->id;
            $penugasan->user_id = Auth::user()->id;
            $penugasan->save();
        }

        return response()->json($tugas->with(['user', 'comments'])->latest()->first());
    }

    protected function sendNotificationToTeamMembers($teamMembers, $title, $message, $jenisNotifikasi)
    {
        foreach ($teamMembers as $member) {
            $statusAnggota = $member->status;

            if ($statusAnggota !== 'kicked') {
                Notifikasi::create([
                    'user_id' => $member->user_id,
                    'judul' => $title,
                    'body' => $message,
                    'status' => 'belum_dibaca',
                    'jenis_notifikasi' => $jenisNotifikasi,
                ]);
            }
        }
    }

    protected function dataEditTugas($codeTugas)
    {


        try {
            $tugass = Tugas::with(['comments.user','label', 'user', 'tim.user'=> function($query){
                $query->wherePivot('status','active');
            }])->where('code', $codeTugas)->first();

            $jadwal = [];
            foreach ($tugass->comments as $data) {
                if (Carbon::parse($data->created_at)->isoFormat("Y-M-DD") === Carbon::now()->isoFormat("Y-M-DD")) {
                    $jadwal[] = "Today " . Carbon::parse($data->created_at)->format("h:i A");
                } else {
                    $tanggal1 = Carbon::parse($data->created_at);
                    $tanggal2 = Carbon::now();
                    $jadwal[] = $tanggal2->diffInDays($tanggal1);
                }
            }

            $label = Label::where('tim_id',$tugass->tim_id)->get();

            $tugas = [
                "tugas" => $tugass,
                "komentarTerbuat" => $jadwal,
                "labels" => $label,
            ];

            // dd($label);

            return response()->json(
                $tugas
            );
        } catch (Exception $th) {
            return response()->json("error", $th);
        }
    }

    protected function prosesEditTugas(Request $request)
    {
        $tugas = Tugas::where('code', $request->codeTugas)->first();

        // dd($request->labels);


        $tim = $tugas->tim;
        $checkResult = $this->checkTeam($tim);

        if ($checkResult) {
            return $checkResult;
        }

        $validator = validator(
            $request->all(),
            [
                'nama' => '|max:50',
                'deadline' => 'required|date|after_or_equal:today',
                'status_tugas' => 'in:tugas_baru,dikerjakan,revisi,selesai',
                'prioritas' => 'in:mendesak,penting,biasa,tambahan,opsional',
            ],
            [
                'nama.max:50' => ' Nama tugas tidak boleh lebih dari 50 karakter',
                'deadline.required' => 'Wajib mengisi deadline',
                'deadline.date' => 'Format tanggal Deadline tidak valid.',
                'deadline.after_or_equal' => 'Tanggal tidak boleh hari kemarin',
                'status_tugas.required' => 'Kolom Status Tugas wajib diisi.',
                'status_tugas.in' => 'Status Tugas tidak valid.',
                'prioritas.required' => 'Kolom Prioritas wajib diisi.',
                'prioritas.in' => 'Prioritas tidak valid.'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    "errors" => $validator->errors()
                ],
                422
            );
        }

        $tugas->nama = $request->nama;
        $tugas->prioritas = $request->prioritas;
        $tugas->deadline = $request->deadline;
        $tugas->status_tugas = $request->status_tugas;

        if ($tugas->status_tugas === 'selesai') {
            $teamMembers = $tugas->tim->user;
            foreach ($teamMembers as $member) {
                $this->sendNotificationToUser($member, 'Tugas Selesai', 'Tugas "' . $tugas->nama . '" telah selesai.', 'pemberitahuan');
            }
        }



        if ($tugas->tim->status_tim !== "solo") {
            $penugasan = $request->penugasan;
            $currentPenugasan = $tugas->user->pluck('uuid')->toArray();

            $userToAdd = array_diff($penugasan, $currentPenugasan);
            $userToRemove = array_diff($currentPenugasan, $penugasan);



            foreach ($userToAdd as $i => $data) {

                if (!($tugas->tim->user->contains("uuid", $data))) {
                    return response()->json(["errors" => "User yang ditambahkan bukan dari anggota tim"], 422);
                }


                $user = User::where('uuid', $data)->first();
                if ($tugas->tim->user->where('uuid',$data)->first()->anggota->status !== "active") {
                    return response()->json(["errors" => ["User yang ditambahkan sudah bukan anggota tim"]], 422);
                }

                if ($user) {
                    $penugasan = new Penugasan;
                    $penugasan->tugas_id = $tugas->id;
                    $penugasan->user_id = $user->id;
                    $penugasan->save();

                    $this->sendNotificationToUser($user, 'Anda Diberi Tugas Baru', 'Anda telah diberi tugas baru "' . $tugas->nama . '" dengan prioritas ' . $tugas->prioritas, 'info');
                }
            }


            foreach ($userToRemove as $data) {
                $user = User::where('uuid', $data)->first();
                if ($user) {
                    $penugasanTb = Penugasan::where('tugas_id', $tugas->id)->where('user_id', $user->id)->delete();
                }
            }






        }



        $tugas->save();


        $labels = $request->labels;
        $currentLabels = $tugas->label->pluck('id')->toArray();

        $labelToAdd = array_diff($labels, $currentLabels);
        $labelToRemove = array_diff($currentLabels, $labels);

        foreach ($labelToRemove as $data) {
           LabelTugas::where('tugas_id', $tugas->id)->where('label_id', $data)->delete();
        }

        foreach($labelToAdd as $data )
        {
            $label = new LabelTugas;
            $label->tugas_id = $tugas->id;
            $label->label_id = $data;
            $label->save();
        }




        return response()->json("sukses");
    }

    protected function sendNotificationToUser($user, $title, $message, $jenisNotifikasi)
    {
        $statusAnggota = $user->anggota->status;


        if ($statusAnggota !== 'kicked') {
            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => $title,
                'body' => $message,
                'status' => 'belum_dibaca',
                'jenis_notifikasi' => $jenisNotifikasi,
            ]);
        }
    }

    protected function hapusTugas($codeTugas)
{
    $tugas = Tugas::where('code', $codeTugas)->first();

    $tim = $tugas->tim;
    $checkResult = $this->checkTeam($tim);

    if ($checkResult) {
        return $checkResult;
    }

    $judulTugas = $tugas->nama;
    $jenisNotifikasi = 'info';
    $penggunaPenghapus = Auth::user();

    $teamMembers = $tugas->tim->user;

    $tugas->delete();

    foreach ($teamMembers as $member) {
        $pesanNotifikasi = "Tugas '{$judulTugas}' telah dihapus oleh {$penggunaPenghapus->username}.";
        $this->sendNotificationToUser($member, 'Tugas Dihapus', $pesanNotifikasi, $jenisNotifikasi);
    }

    return response()->json(["success" => "Berhasil menghapus tugas"]);
}

    protected function tambahKomentar(Request $request)
    {

        $tugas = Tugas::where('code', $request->tugas_code)->first();
        $tim = $tugas->tim;
        $checkResult = $this->checkTeam($tim);

        if ($checkResult) {
            return $checkResult;
        }

        $validator = Validator(
            $request->all(),
            [
                "text" => "required|string|max:244"
            ],
            [
                "text.required" => "Komentar wajin diisi",
                "text.string" => "Komentar harus berupa string",
                "text.max" => "Komentar tidak boleh lebih dari 244 karakter",
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    "errors" => $validator->errors()
                ],
                422
            );
        }

        if ($request->komentar_id === 0) {
            $tugas = Tugas::where("code", $request->tugas_code)->first();
            $komentar = new Comments;
            $komentar->user_id = Auth::user()->id;
            $komentar->tugas_id = $tugas->id;
            $komentar->text = $request->text;
            $komentar->save();

            return response()->json(["success" => "Berhasil membuat komentar"]);
        } else {
            $komentar = Comments::where('id', $request->komentar_id)->first();
            $komentar->text = $request->text;
            $komentar->save();

            return response()->json(["success", "Berhasil mengupdate komentar"]);
        }
    }

    protected function hapusKomentar($komentar_id)
    {
        $komentar = Comments::find($komentar_id);
        $tugas = $komentar->tugas->first();
        $tim = $tugas->tim;
        $checkResult = $this->checkTeam($tim);

        if ($checkResult) {
            return $checkResult;
        }

        $komentar->delete();

        return response()->json(["success", "Menghapus komentar"]);
    }
}
