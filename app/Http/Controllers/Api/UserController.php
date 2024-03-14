<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * user
     *
     * @return JsonResponse
     */
    public function user(): JsonResponse
    {
        return ResponseHelper::success(UserResource::make(auth()->user()));
    }

    public function updateProfile(Request $request): JsonResponse
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

                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $nameImage = 'avatars/' . $imageName;

                $img = Image::make($image->getRealPath());
                $img->fit(500, 500); // Sesuaikan ukuran sesuai kebutuhan, misalnya 400x400

                // Simpan gambar yang telah dimanipulasi
                Storage::disk('public')->put($nameImage, (string)$img->encode());
            }

            $user->update([
                'avatar' => $request->hasFile('photo') ? $nameImage : $user->avatar,
                'username' => $request->username ?: $user->username,
                'email' => $request->email ?: $user->email,
                'tlp' => $request->tlp ?: $user->tlp,
                'sekolah' => $request->sekolah ?: $user->sekolah,
            ]);

            return ResponseHelper::success(null, "Berhasil update");
        } catch (\Throwable $th) {
            // Menangkap dan menampilkan pesan kesalahan
            return ResponseHelper::error(null, "Gagal Update Profile");
        }
    }
}
