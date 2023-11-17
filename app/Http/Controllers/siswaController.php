<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Notifikasi;
use App\Models\User;
use App\Models\Tim;
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

        $tugas = User::find(Auth::user()->id)->tugas()->where('status_tugas', 'tugas_baru')->get()
            ->sortBy(function ($item) {
                $deadline = \Carbon\Carbon::parse($item->deadline);
                $created = \Carbon\Carbon::parse($item->created_at);
                return $deadline->diffInDays($created);
            });
        $tugasBelum = User::find(Auth::user()->id)->tugas()->where(function ($query) {
            $query->where('status_tugas', 'revisi')
                ->OrWhere('status_tugas', 'dikerjakan');
        })->get()
            ->sortBy(function ($item) {
                $deadline = \Carbon\Carbon::parse($item->deadline);
                $created = \Carbon\Carbon::parse($item->created_at);
                return $deadline->diffInDays($created);
            });

        return response()->view('siswa.dashboard', compact('title', 'tims', 'tugas', 'tugasBelum', 'notifikasi'));
    }

    // Return view profile siswa
    protected function profilePage()
    {
        $title = 'Profile Siswa';
        $user = User::with('peran')->where('id', Auth::user()->id)->first();
        $tims = $user->tim()->get();
        $notifikasi = Notifikasi::where('user_id',Auth::user()->id)->get();
        return response()->view('siswa.profile-siswa', compact('title', 'user', 'tims','notifikasi'));
    }
}
