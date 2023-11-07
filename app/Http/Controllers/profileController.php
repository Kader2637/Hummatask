<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class profileController extends Controller
{
    protected function update(Request $request)
    {
        $validate = Validator::make(
            $request->only(['username', 'email', 'tlp', 'sekolah', 'deskripsi', 'avatar']),
            [
                'username' => 'nullable|string|max:50',
                'email' => 'nullable|email|unique:users,email',
                'tlp' => 'nullable|regex:/^\d+$/',
                'sekolah' => 'nullable|string|max:50',
                'deskripsi' => 'nullable|string|max:255',
                'avatar' => 'nullable|image',
            ],
            [
                'email.email' => 'Email harus dalam format yang benar.',
                'tlp.regex' => 'Nomor telepon harus berisi hanya angka.',
                'avatar' => 'Avatar harus diunggah.',
                'avatar.image' => 'Avatar harus berupa gambar.',
                'avatar.max' => 'Ukuran avatar tidak boleh lebih dari :max kilobita.',
            ],
        );

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        try {
            $user = User::find(Auth::user()->id);

            if ($request->hasFile('avatar')) {
                if (Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $nameImage = $request->avatar->store('avatars', 'public');
            }

            $user->update([
                'avatar' => $request->avatar ? $nameImage : $user->avatar,
                'username' => $request->username ? $request->username : $user->username,
                'email' => $request->email ? $request->email : $user->email,
                'tlp' => $request->tlp ? $request->tlp : $user->tlp,
                'sekolah' => $request->sekolah ? $request->sekolah : $user->sekolah,
                'deskripsi' => $request->deskripsi ? $request->deskripsi : $user->deskripsi
            ]);

            return redirect()->back()->with('success', 'Berhasil Update Profile');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal Update Profile');
        }
    }
}
