<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestTambahSiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Excel;
use Intervention\Image\ImageManagerStatic as Image;
use App\Imports\CsvImport;
use App\Models\PenglolaMagang;
use App\Models\Tim;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class tambahUsersController extends Controller
{
    protected function storeCsv(Request $request)
    {
        try {
            $path = $request->import->getRealPath();
            $data = array_map('str_getcsv', file($path));

            foreach ($data as $row) {
                $inisial = strtoupper(implode('', array_map(fn ($name) => substr($name, 0, 1), array_slice(explode(' ', $row[0]), 0, 3))));
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
                    'username' => $row[0],
                    'email' => $row[1],
                    'password' => Hash::make('password'),
                    'sekolah' => $row[3],
                    'peran_id' => 1,
                    'deskripsi' => "none",
                    'tanggal_bergabung' => Carbon::parse($row[4])->toDateString(),
                ]);
            }

            return redirect()->back()->with('success', 'Data CSV berhasil disimpan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data CSV gagal disimpan!.');
        }
    }

    protected function store(Request $request)
    {
        $dates = explode(' to ', $request->masa_magang);
        $tanggalAwal = $dates[0];
        $tanggalAkhir = $dates[1];

        $requestData = [
            'username' => $request->username,
            'email' => $request->email,
            'sekolah' => $request->sekolah,
            'masa_magang_awal' => $tanggalAwal,
            'masa_magang_akhir' => $tanggalAkhir,
        ];

        $validator = Validator::make(
            $requestData,
            [
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'sekolah' => 'required|string|max:255',
                'masa_magang_awal' => 'required|date|after_or_equal:today',
                'masa_magang_akhir' => 'required|date|after_or_equal:masa_magang_awal',
            ],

            [
                'username.required' => 'Kolom Nama harus diisi.',
                'username.string' => 'Kolom Nama harus berupa teks.',
                'username.max' => 'Kolom Nama tidak boleh lebih dari :max karakter.',
                'email.required' => 'Kolom Email harus diisi.',
                'email.email' => 'Email harus berupa alamat email yang valid.',
                'email.unique' => 'Email sudah digunakan.',
                'sekolah.required' => 'Kolom Sekolah harus diisi.',
                'sekolah.string' => 'Kolom Sekolah harus berupa teks.',
                'sekolah.max' => 'Kolom Sekolah tidak boleh lebih dari :max karakter.',
                'masa_magang_awal.required' => 'Kolom Masa Magang Awal harus diisi.',
                'masa_magang_awal.date' => 'Format Masa Magang Awal harus tanggal yang valid.',
                'masa_magang_awal.after_or_equal' => 'Masa Magang Awal harus setelah atau sama dengan hari ini.',
                'masa_magang_akhir.required' => 'Kolom Masa Magang Akhir harus diisi.',
                'masa_magang_akhir.date' => 'Format Masa Magang Akhir harus tanggal yang valid.',
                'masa_magang_akhir.after_or_equal' => 'Masa Magang Akhir harus setelah atau sama dengan Masa Magang Awal.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
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
                'deskripsi' => "none",
                'tanggal_bergabung' => $tanggalAwal
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'User gagal disimpan!');
        }
        return redirect()->back()->with('success', 'User berhasil disimpan!');
    }

    protected function store_mentor(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
            ],
            [
                'username.required' => 'Kolom Nama harus diisi.',
                'username.string' => 'Kolom Nama harus berupa teks.',
                'username.max' => 'Kolom Nama tidak boleh lebih dari :max karakter.',
                'email.required' => 'Kolom Email harus diisi.',
                'email.email' => 'Email harus berupa alamat email yang valid.',
                'email.unique' => 'Email sudah digunakan.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
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
                'peran_id' => 2,
                'deskripsi' => "none"
            ]);
            return redirect()->back()->with('success', 'User berhasil disimpan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('success', 'User gagal disimpan!');
        }
    }

    protected function edit_mentor(Request $request, $uuid)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
        ]);

        $mentor = User::where('uuid', $uuid)->firstOrFail();

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

        $mentor->update([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'avatar' => $nameImage,
        ]);

        return redirect()->back()->with('success', 'Mentor berhasil diupdate');
    }

    protected function tambah_pengelola(Request $request)
    {
        try {
            $role = Role::find($request->role);
            $user = User::find($request->user);

            $user->assignRole($role);

            if ($role->name == 'ketua magang') {
                $awal_menjabat = Carbon::now();
                $akhir_menjabat = Carbon::now()->addMonth(); 


                PenglolaMagang::create([
                    'user_id' => $user->id,
                    'role_id' => $role->id,
                    'awal_menjabat' => $awal_menjabat,
                    'akhir_menjabat' => $akhir_menjabat,
                    'masih_menjabat' => true, 
                ]);
            }
        
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal memberikan hak akses!');
        }

        return redirect()->back()->with('success', 'Berhasil memberikan hak akses!');
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
            if (Storage::exists($user->avatar))
            {
                Storage::delete($user->avatar);
            }
            $user->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'User berhasil di hapus!');
        }
        return redirect()->back()->with('success', 'User berhasil di hapus!');
    }

    protected function delete_mentor(string $code)
    {
        try {
            $user = User::where('uuid', $code)->first();
            if ($user->avatar && Storage::disk('public')->exists($user->avatar))
            {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'User berhasil di hapus!');
        }
        return redirect()->back()->with('success', 'User berhasil di hapus!');
    }

    protected function delete_permisions(string $code)
{
    try {
        $user = User::where('uuid', $code)->first();

        if ($user->hasRole('ketua magang')) {
            PenglolaMagang::where('user_id', $user->id)
                ->update(['masih_menjabat' => false]);
        }

        $role = $user->getRoleNames()[0];
        $user->removeRole($role);
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'User berhasil dihapus!');
    }

    return redirect()->back()->with('success', 'User berhasil dihapus!');
}
}
