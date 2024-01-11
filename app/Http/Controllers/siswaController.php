<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\SiswaResource;
use App\Models\Anggota;
use App\Models\Comments;
use App\Models\Notifikasi;
use App\Models\Penugasan;
use App\Models\User;
use App\Models\Tim;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class siswaController extends Controller
{
    // Return view dashboard siswa
    protected function dashboard()
    {
        $title = "Dashboard";
        $tims = User::find(Auth::user()->id)->tim()->get();
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        // dd($tims->sortByDesc('created_at'));
        $timbaru = $tims->sortByDesc('created_at')->first();

        $tugas = User::find(Auth::user()->id)->tugas()->where('status_tugas', 'tugas_baru')->with('user', 'comments')->get()
            ->sortBy(function ($item) {
                $deadline = \Carbon\Carbon::parse($item->deadline);
                $created = \Carbon\Carbon::parse($item->created_at);
                return $deadline->diffInDays($created);
            });

        $tugas = $tugas->map(function ($item) {
            $deadline = \Carbon\Carbon::parse($item->deadline)->startOfDay();
            $created = \Carbon\Carbon::parse($item->created_at)->startOfDay();
            $item->dayleft = $deadline->diffInDays($created);
            $item->tim_code = $item->tim->code;
            return $item;
        })->loadCount('comments');

        $tugas = $tugas->take(3);

        $tugasBelum = User::find(Auth::user()->id)->tugas()->where(function ($query) use ($timbaru) {
            $query->where('status_tugas', 'revisi')
                ->orWhere('status_tugas', 'dikerjakan');

            if ($timbaru) {
                $query->where('tim_id', $timbaru->id);
            }
        })->with('user')->get()
            ->sortBy(function ($item) {
                $deadline = \Carbon\Carbon::parse($item->deadline);
                $created = \Carbon\Carbon::parse($item->created_at);
                return $deadline->diffInDays($created);
        });

        $user = User::where('status_kelulusan', 0)->get();

        foreach ($user as $data) {
            if ($data->tanggal_lulus <= Carbon::now()->isoFormat('YYYY-MM-DD')) {
                $data->status_kelulusan = 1;
                $data->save();
            }
        }

        $tugasBelum = $tugasBelum->map(function ($item) {
            $deadline = \Carbon\Carbon::parse($item->deadline)->startOfDay();
            $created = \Carbon\Carbon::parse($item->created_at)->startOfDay();
            $item->dayleft = $deadline->diffInDays($created);
            $item->tim_code = $item->tim->code;
            return $item;
        })->loadCount('comments');

        $tugasBelum = $tugasBelum->take(3);

        return response()->view('siswa.dashboard', compact('title', 'tims', 'tugas', 'tugasBelum', 'notifikasi'));
    }

    // Return view profile siswa
    protected function profilePage()
    {
        $title = 'Profile Siswa';
        $user = User::with('peran')->where('id', Auth::user()->id)->first();
        $tims = $user->tim()->get();
        // dd($tims);
        $notifikasi = Notifikasi::where('user_id', Auth::user()->id)->get();
        return response()->view('siswa.profile-siswa', compact('title', 'user', 'tims', 'notifikasi'));
    }

    public function list() : JsonResponse
    {
        $student = User::where('status_kelulusan', 0)->get();

        return ResponseHelper::success(SiswaResource::collection($student));
    }
}
