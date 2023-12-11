<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class profileController extends Controller
{
    protected function update(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'username' => 'nullable|string|max:50',
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('users', 'email')->ignore(auth()->user()->id),
                ],
                'tlp' => 'nullable|regex:/^\d+$/|min:10|max:13',
                'sekolah' => 'nullable|string|max:50',
                'deskripsi' => 'nullable|string|max:100',
                'photo' => 'nullable|image',
            ],
            [
                'tlp.regex' => 'Nomor telepon harus berisi hanya angka.',
                'photo' => 'Avatar harus diunggah.',
                'photo.image' => 'Avatar harus berupa gambar.',
            ],
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
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
    public function updatePassword(Request $request)
    {
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ];

        $messages = [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'new_password.required' => 'Kata sandi baru wajib diisi.',
            'new_password.string' => 'Kata sandi baru harus berupa teks.',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            $passwordError = ['Kata sandi saat ini salah'];
            return response()->json(['errors' => ['current_password' => $passwordError], 'message' => 'Silakan periksa formulir untuk mengatasi kesalahan.'], 422);
        }
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray(), 'message' => 'Silakan periksa formulir untuk mengatasi kesalahan.'], 422);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json(['success' => 'Kata sandi berhasil diperbarui.']);
    }
}
