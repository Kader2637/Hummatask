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
    /**
     * dashboard
     *
     * @return void
     */
    protected function dashboard()
    {
        $title = 'Dashboard';

        $userID = Auth::user()->id;
        $tims = User::find($userID)
            ->tim()
            ->latest()
            ->orderBy('status', 'desc')
            ->get();

        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        $timbaru = $tims->sortByDesc('created_at')->first();

        $tugas = User::find($userID)
            ->tugas()
            ->where('status_tugas', 'tugas_baru')
            ->with('user', 'comments')
            ->get()
            ->sortBy(function ($item) {
                $deadline = \Carbon\Carbon::parse($item->deadline);
                $created = \Carbon\Carbon::parse($item->created_at);
                return $deadline->diffInDays($created);
            })
            ->map(function ($item) {
                $deadline = \Carbon\Carbon::parse($item->deadline)->startOfDay();
                $created = \Carbon\Carbon::parse($item->created_at)->startOfDay();
                $item->dayleft = $deadline->diffInDays($created);
                $item->tim_code = $item->tim->code;
                return $item;
            })
            ->loadCount('comments')
            ->take(3);

        $tugasBelum = User::find($userID)
            ->tugas()
            ->where(function ($query) use ($timbaru) {
                $query->where('status_tugas', 'revisi')->orWhere('status_tugas', 'dikerjakan');
                if ($timbaru) {
                    $query->where('tim_id', $timbaru->id);
                }
            })
            ->with('user')
            ->get()
            ->sortBy(function ($item) {
                $deadline = \Carbon\Carbon::parse($item->deadline);
                $created = \Carbon\Carbon::parse($item->created_at);
                return $deadline->diffInDays($created);
            })
            ->map(function ($item) {
                $deadline = \Carbon\Carbon::parse($item->deadline)->startOfDay();
                $created = \Carbon\Carbon::parse($item->created_at)->startOfDay();
                $item->dayleft = $deadline->diffInDays($created);
                $item->tim_code = $item->tim->code;
                return $item;
            })
            ->loadCount('comments')
            ->take(3);

        $user = User::where('status_kelulusan', 0)->get();

        foreach ($user as $data) {
            if ($data->tanggal_lulus <= Carbon::now()->isoFormat('YYYY-MM-DD')) {
                $data->status_kelulusan = 1;
                $data->save();
            }
        }

        return response()->view('siswa.dashboard', compact('title', 'tims', 'tugas', 'tugasBelum', 'notifikasi'));
    }

    /**
     * profilePage
     *
     * @return void
     */
    protected function profilePage()
    {
        $title = 'Profile Siswa';

        $userID = Auth::user()->id;
        $user = User::with('peran')
            ->findOrFail($userID);

        $tims = $user->tim()->get();
        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        return response()->view('siswa.profile-siswa', compact('title', 'user', 'tims', 'notifikasi'));
    }

    /**
     * list
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $student = User::where('status_kelulusan', 0)->get();

        return ResponseHelper::success(SiswaResource::collection($student));
    }
}
