<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Comments;
use App\Models\Notifikasi;
use App\Models\Penugasan;
use App\Models\User;
use App\Models\Tim;
use App\Models\Tugas;
use Illuminate\Http\Request;
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

        $tugasBelum = User::find(Auth::user()->id)->tugas()->where(function ($query) {
            $query->where('status_tugas', 'revisi')
                ->OrWhere('status_tugas', 'dikerjakan');
        })->with('user')->get()
            ->sortBy(function ($item) {
                $deadline = \Carbon\Carbon::parse($item->deadline);
                $created = \Carbon\Carbon::parse($item->created_at);
                return $deadline->diffInDays($created);
            });

        $tugasBelum = $tugasBelum->map(function ($item) {
            $deadline = \Carbon\Carbon::parse($item->deadline)->startOfDay();
            $created = \Carbon\Carbon::parse($item->created_at)->startOfDay();
            $item->dayleft = $deadline->diffInDays($created);
            $item->tim_code = $item->tim->code;
            return $item;
        })->loadCount('comments');

        return response()->view('siswa.dashboard', compact('title', 'tims', 'tugas', 'tugasBelum', 'notifikasi'));
    }

    // Return view profile siswa
    protected function profilePage()
    {
        $title = 'Profile Siswa';
        $user = User::with('peran')->where('id', Auth::user()->id)->first();
        $tims = $user->tim()->get();
        $notifikasi = Notifikasi::where('user_id', Auth::user()->id)->get();
        return response()->view('siswa.profile-siswa', compact('title', 'user', 'tims', 'notifikasi'));
    }
}
