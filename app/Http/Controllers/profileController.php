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
            $request->all(),
            [
                'username' => 'nullable|string|max:50',
                'email' => 'nullable|email|unique:users,email',
                'tlp' => 'nullable|regex:/^\d+$/',
                'sekolah' => 'nullable|string|max:50',
                'deskripsi' => 'nullable|string|max:255',
                'photo' => 'nullable|image',
            ],
            [
                'email.email' => 'Email harus dalam format yang benar.',
                'tlp.regex' => 'Nomor telepon harus berisi hanya angka.',
                'photo' => 'Avatar harus diunggah.',
                'photo.image' => 'Avatar harus berupa gambar.',
            ],
        );

        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 422);
        }

        try {
            $user = User::find(Auth::user()->id);

            if ($request->hasFile('photo')) {
                // Menghapus avatar lama jika ada
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }

                $nameImage = $request->photo->store('avatars', 'public');
            }

            $user->update([
                'avatar' => $request->hasFile('photo') ? $nameImage : $user->avatar,
                'username' => $request->username ?: $user->username,
                'email' => $request->email ?: $user->email,
                'tlp' => $request->tlp ?: $user->tlp,
                'sekolah' => $request->sekolah ?: $user->sekolah,
                'deskripsi' => $request->deskripsi ?: $user->deskripsi
            ]);

            return response()->json(['success' => 'Berhasil Update Profile']);
        } catch (\Throwable $th) {
            // Menangkap dan menampilkan pesan kesalahan
            return response()->json(['error' => 'Gagal Update Profile', 'message' => $th->getMessage()], 500);
        }
    }
}
