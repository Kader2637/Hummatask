<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PenggunaRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PenggunaResource;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class PenggunaController extends Controller
{
        /**
     * index
     *
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        $pengguna = User::query()
           ->where('peran_id', 1)
            ->when($request->limit, function ($query) use ($request) {
                $query->take((int) $request->limit);
            })
            ->get();
        return ResponseHelper::success(PenggunaResource::collection($pengguna));
    }

     /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(PenggunaRequest $request)
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

      /**
     * UpdateDivisi
     *
     * @param  mixed $divisi
     * @return JsonResponse
     */

    public function UpdateDivisi(User $user, Request $request): JsonResponse
    {
        $user->divisi_id = $request->divisi_id;
        $user->save();
        return response()->json(['success']);
    }


    protected function storeCsv(Request $request)
    {
        DB::beginTransaction();

        try {
            $path = $request->import->getRealPath();
            $data = array_map('str_getcsv', file($path));
            array_shift($data);
            $data = array_filter($data, function ($item) {
                return !empty(trim(implode('', $item)));
            });


            // dd($data);
            foreach ($data as $row) {

                $inisial = strtoupper(implode('', array_map(fn ($name) => substr($name, 0, 1), array_slice(explode(' ', $row[0]), 0, 3))));
                $image = Image::canvas(200, 200, '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT));
                $image->text($inisial, 100, 100, function ($font) {
                    $font->file(public_path('assets/font/Poppins-Bold.ttf'));
                    $font->size(48);
                    $font->color('#ffffff');
                    $font->align('center');
                    $font->valign('middle');
                });
                $nameImage = 'avatars/' . Str::random(20) . '.jpg';
                Storage::disk('public')->put($nameImage, $image->stream());

                //     $user->tanggal_bergabung = date_format($date1, "Y-m-d");
                //     $user->tanggal_lulus = date_format($date2, "Y-m-d");

                User::create([
                    'uuid' => Str::uuid(),
                    'avatar' => $nameImage,
                    'username' => $row[0],
                    'email' => $row[1],
                    'password' => Hash::make('password'),
                    'sekolah' => $row[2],
                    'peran_id' => 1,
                    'tanggal_bergabung' => date_format(date_create_from_format("d/m/Y", $row[3]), 'Y-m-d'),
                    'tanggal_lulus' => date_format(date_create_from_format("d/m/Y", $row[4]), 'Y-m-d'),
                ]);
            }

            DB::commit();
            return response()->json(['success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => $e]);
        }
    }
}

