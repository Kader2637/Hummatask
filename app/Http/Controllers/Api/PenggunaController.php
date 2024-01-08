<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\PenggunaRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class PenggunaController extends Controller
{
        /**
     * index
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $pengguna = User::query()->get();
        return ResponseHelper::success($pengguna);
    }

     /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $tanggalAwal = $request->awal_magang;
        $tanggalAkhir = $request->akhir_magang;

        try {
            $inisial = strtoupper(implode('', array_map(fn ($name) => substr($name, 0, 1), array_slice(explode(' ', $request->username), 0, 3))));
            $image = Image::canvas(200, 200, '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT));
            $image->text($inisial, 100, 100, function ($font) {
                $font->file(public_path('assets/font/Poppins-Regular.ttf'));
                $font->size(48);
                $font->color('#ffffff');
                $font->align('center');
                $font->valign('middle');
            });
            $nameImage = 'avatars/' . Str::random(20) . '.jpg';
            Storage::disk('public')->put($nameImage, $image->stream());

            User::create([
                'uuid' => Str::uuid(),
                'avatar' => $nameImage,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make('password'),
                'sekolah' => $request->sekolah,
                'divisi_id' => $request->divisi_id,
                'peran_id' => 1,
                'tanggal_bergabung' => $tanggalAwal,
                'tanggal_lulus' => $tanggalAkhir,
                'tlp' => $request->tlp,
            ]);
        } catch (\Exception $e) {
            return ResponseHelper::success(null, 'User gagal disimpan!');
        }
        return ResponseHelper::success(null, 'Berhasil menambahkan User');
    }


    // public function storePengguna()

     /**
     * update
     *
     * @param  mixed $divisi
     * @param  mixed $request
     * @return JsonResponse
     */
    public function update(User $pengguna, UserRequest $request): JsonResponse
    {
        $pengguna
            ->update($request->validated());
        return ResponseHelper::success(null, 'Berhasil merubah divisi');
    }

     /**
     * destroy
     *
     * @param  mixed $divisi
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return ResponseHelper::success(null, "Berhasil menghapus pengguna");
    }

}

