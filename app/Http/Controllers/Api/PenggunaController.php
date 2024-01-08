<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
    public function store(User $request): JsonResponse
    {
        $dates = explode(' to ', $request->masa_magang);

        if (count($dates) != 2) {
            return redirect()->back()
                ->with('error', 'Format Masa Magang harus berupa rentang dua tanggal (tanggal awal dan tanggal akhir)')
                ->withInput();
        }

        $tanggalAwal = $request->awal_magang;
        $tanggalAkhir = $request->akhir_magang;

        $requestData = [
            'username' => $request->username,
            'email' => $request->email,
            'sekolah' => $request->sekolah,
            'masa_magang_awal' => $tanggalAwal,
            'masa_magang_akhir' => $tanggalAkhir,
            'tlp' => $request->tlp,
        ];


        $validator = Validator::make(
            $requestData,
            [
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'sekolah' => 'required|string|max:255',
                'masa_magang_awal' => 'required|date',
                'masa_magang_akhir' => 'required|date|after_or_equal:masa_magang_awal',
            ],

            [
                'username.required' => 'Kolom Nama harus diisi',
                'username.string' => 'Kolom Nama harus berupa teks',
                'username.max' => 'Kolom Nama tidak boleh lebih dari :max karakter',
                'email.required' => 'Kolom Email harus diisi',
                'email.email' => 'Email harus berupa alamat email yang valid',
                'email.unique' => 'Email sudah digunakan',
                'sekolah.required' => 'Kolom Sekolah harus diisi',
                'sekolah.string' => 'Kolom Sekolah harus berupa teks',
                'sekolah.max' => 'Kolom Sekolah tidak boleh lebih dari :max karakter',
                'masa_magang_awal.required' => 'Kolom Masa Magang Awal harus diisi',
                'masa_magang_awal.date' => 'Format Masa Magang Awal harus tanggal yang valid',
                'masa_magang_akhir.required' => 'Kolom Masa Magang Akhir harus diisi',
                'masa_magang_akhir.date' => 'Format Masa Magang Akhir harus tanggal yang valid',
                'masa_magang_akhir.after_or_equal' => 'Masa Magang Akhir harus setelah atau sama dengan Masa Magang Awal',
            ]
        );


        if ($validator->fails()) {
            $errors = $validator->errors()->all();

            if (count($errors) > 1) {
                $errorMessage = implode(', ', $errors);
                return redirect()->back()
                    ->with('error', $errorMessage)
                    ->withInput();
            } else {
                return redirect()->back()
                    ->with('error', $errors[0])
                    ->withInput();
            }
        }

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
                'peran_id' => 1,
                'tanggal_bergabung' => $tanggalAwal,
                'tanggal_lulus' => $tanggalAkhir,
                'tlp' => $request->tlp,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'User gagal disimpan!');
        }
        return ResponseHelper::success(null, 'Berhasil menambahkan User');
    }

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
        return ResponseHelper::success(null, 'Berhasil menghapus divisi');
    }

}

