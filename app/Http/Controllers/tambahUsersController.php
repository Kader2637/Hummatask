<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestTambahSiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Excel;
use Intervention\Image\ImageManagerStatic as Image;
use App\Imports\CsvImport;
use App\Models\Anggota;
use App\Models\Divisi;
use App\Models\Notifikasi;
use App\Models\PenglolaMagang;
use App\Models\Tim;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class tambahUsersController extends Controller
{
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
            return redirect()->back()->with('success', 'Data CSV berhasil disimpan!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Data CSV gagal disimpan, tolong perhatikan format data dalam file!');
        }
    }

    protected function store(Request $request)
    {
        $dates = explode(' to ', $request->masa_magang);

        if (count($dates) != 2) {
            return redirect()->back()
                ->with('error', 'Format Masa Magang harus berupa rentang dua tanggal (tanggal awal dan tanggal akhir)')
                ->withInput();
        }

        $tanggalAwal = $dates[0];
        $tanggalAkhir = $dates[1];

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
                // If there are more than one error, display all errors in SweetAlert separated by commas
                $errorMessage = implode(', ', $errors);

                return redirect()->back()
                    ->with('error', $errorMessage)
                    ->withInput();
            } else {
                // If there is only one error, display it in SweetAlert
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
        return redirect()->back()->with('success', 'User berhasil disimpan!');
    }

    protected function get_mentor()
    {
        $mentors = User::query()
            ->with('divisi')
            ->where('peran_id', 2)
            ->whereHas('divisi')
            ->get();

        $divisis = Divisi::query()
            ->get();

        return response()->json([
            'mentors' => $mentors,
            'divisis' => $divisis
        ]);
    }

    protected function store_mentor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'Divisi' => 'required|unique:users,divisi_id'
        ], [
            'username.required' => 'Kolom Nama harus diisi.',
            'username.string' => 'Kolom Nama harus berupa teks.',
            'username.max' => 'Kolom Nama tidak boleh lebih dari :max karakter.',
            'email.required' => 'Kolom Email harus diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.unique' => 'Email sudah digunakan.',
            'Divisi.required' => 'Divisi harus di isi',
            'Divisi.unique' => 'Divisi sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Gagal menambah data']);
        }

        try {
            $inisial = strtoupper(implode('', array_map(fn ($name) => substr($name, 0, 1), array_slice(explode(' ', $request->username), 0, 3))));
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

            User::create([
                'uuid' => Str::uuid(),
                'avatar' => $nameImage,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make('password'),
                'peran_id' => 2,
                'divisi_id' => $request->Divisi,
            ]);

            return response()->json(['success' => 'Berhasil menambah data']);
        } catch (\Throwable $th) {
            return response()->json(['error', 'Gagal menambah data']);
        }
    }

    protected function edit_mentor(Request $request, $uuid)
    {
        $mentor = User::where('uuid', $uuid)->firstOrFail();

        $validatedData = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $mentor->id,
            'Divisi' => 'required'
        ]);

        $mentor->update([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'divisi_id' => $validatedData['Divisi']
        ]);

        return response()->json(['success' => 'Berhasil mengupdate data']);

    }

    protected function tambah_pengelola(Request $request)
    {
        try {
            $role = 1;
            $user = User::find($request->user);

            $user->assignRole($role);
            $awal_menjabat = Carbon::now();
            $akhir_menjabat = Carbon::now()->addMonth();

            PenglolaMagang::create([
                'user_id' => $user->id,
                'role_id' => $role,
                'awal_menjabat' => $awal_menjabat,
                'akhir_menjabat' => $akhir_menjabat,
                'masih_menjabat' => true,
            ]);

            $this->sendNotification($user->id, 'Selamat anda terpilih', 'Anda sekarang adalah ketua magang', 'info');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal memberikan hak akses!');
        }

        return redirect()->back()->with('success', 'Berhasil memberikan hak akses!');
    }

    protected function sendNotification($userId, $title, $message, $jenisNotifikasi)
    {
        $statusAnggota = Anggota::where('user_id', $userId)->value('status');

        if ($statusAnggota != ['kicked', 'expired']) {
            Notifikasi::create([
                'user_id' => $userId,
                'judul' => $title,
                'body' => $message,
                'status' => 'belum_dibaca',
                'jenis_notifikasi' => $jenisNotifikasi,
            ]);
        }
    }

    protected function tambah_role(Request $request)
    {
        try {
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
            $role = Role::create(['name' => $request->roles]);
            $role->givePermissionTo('kelola siswa');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menambah hak akses!');
        }
        return redirect()->back()->with('success', 'Berhasil menambah hak akses!');
    }

    protected function delete(string $code)
    {
        try {
            $user = User::where('uuid', $code)->first();
            if (Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            $user->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'User tidak bisa dihapus!');
        }
        return redirect()->back()->with('success', 'User berhasil di hapus!');
    }

    protected function delete_mentor(string $code)
    {
        try {
            $user = User::where('uuid', $code)->first();
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'User berhasil di hapus!');
        }
        return response()->json(['success' => 'Berhasil menghapus data']);
    }

    protected function delete_permisions(string $code)
    {
        try {

            $user = User::where('uuid', $code)->first();

            if ($user->hasRole('ketua magang')) {
                PenglolaMagang::where('user_id', $user->id)
                    ->update([
                        'masih_menjabat' => false,
                        'akhir_menjabat' => now()
                    ]);
            }

            $role = $user->getRoleNames()[0];
            $user->removeRole($role);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'User berhasil dihapus!');
        }

        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }

    protected function extends(Request $request)
    {
        $validate = $request->validate(
            [
                "tanggal_lulus" => "required|date|after_or_equal:today"
            ],
            [
                "tanggal_lulus.required" => "tanggal wajib diisi",
                "tanggal_lulus.date" => "Terdapat kesalahan format pada tanggal",
                "tanggal_lulus.after_or_equal" => "Tanggal tidak boleh hari kemarin"
            ]
        );


        $user = User::find($request->user_id);
        $user->status_kelulusan = 0;
        $user->tanggal_lulus = $request->tanggal_lulus;
        $user->save();



        // dd($request);
        return redirect()->back()->with("success", "Sukses memperpanjang masa pkl");
    }
}
