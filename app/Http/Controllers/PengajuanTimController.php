<?php

namespace App\Http\Controllers;

use App\Http\Requests\editProjectRequest;
use App\Http\Requests\RequestPembentukanTimProject;
use App\Http\Requests\RequestPembentukanTimProjectKetua;
use App\Http\Requests\RequestPengajuanSoloProject;
use App\Models\Anggota;
use App\Models\Notifikasi;
use App\Models\Project;
use App\Models\Tema;
use App\Models\Tim;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

// use Illuminate\Http\Request;

class PengajuanTimController extends Controller
{
    protected function pengajuanSoloProject(RequestPengajuanSoloProject $request)
    {

        // Kondisi dimana nama tim kosong atau foto kosong
        if ($request->nama === null || $request->logo === null) {
            return redirect()->back()->with('error', 'input Foto ataupun nama tim tidak boleh kosong');
        }

        $timDulu = User::find(Auth::user()->id)->tim->first();

        if (isset($timDulu)) {
            if ($timDulu->kadaluwarsa === 0) {
                return redirect()->back()->with('error', 'Kamu masih memiliki tim yang belum selesai');
            }
        }

        // menyimpan logo
        $logo = $request->logo->store('logo', 'public');

        // Membuat tim
        $tim = Tim::create([
            'code' => Str::uuid(),
            'nama' => $request->nama,
            'logo' => $logo,
            'repository' => $request->repository,
            'status_tim' => 'solo'
        ]);

        // Membuat anggota
        Anggota::create([
            'tim_id' => $tim->id,
            'jabatan_id' => 1,
            'user_id' => Auth::user()->id,
        ]);

        // Membuat tema
        $tema = Tema::create([
            'code' => $tim->code,
            'nama_tema' => $request->temaInput,
            'tim_id' => $tim->id,
        ]);

        // Membuat project
        Project::create([
            'code' => $tim->code,
            'tim_id' => $tim->id,
            'tema_id' => $tema->id,
            'status_project' => 'approved',
            'deadline' => Carbon::now()->addWeek(),
            'type_project' => 'solo'
        ]);

        return redirect()->back()->with('success', 'Berhasil membuat tim solo project');
    }

    protected function pembuatanTimProject(RequestPembentukanTimProject $request)
    {
        try {
            $daftarAnggota = $request->anggota;
            $daftarAnggota[] = $request->ketuaKelompok;
            $uniqueDaftarAnggota = array_unique($daftarAnggota);

            $existingAnggota = Anggota::whereIn('user_id', $uniqueDaftarAnggota)->first();
            if ($existingAnggota) {
                return back()->with('warning', 'Anggota telah masuk di tim lain.');
            }

            if ($request->status_tim == 2) {
                $namaTim = 'Pre-Mini Project Team';
            } else if ($request->status_tim == 3) {
                $namaTim = 'Mini Project Team';
            } else if ($request->status_tim == 4) {
                $namaTim = 'Big Project Team';
            }

            if ($namaTim == 'Pre-Mini Project Team') {
                $name = 'PreMini';
            } else if ($namaTim == 'Mini Project Team') {
                $name = 'Mini';
            } else if ($namaTim == 'Big Project Team') {
                $name = 'Big';
            }

            $backgroundHexColor = '#' . str_pad(dechex(mt_rand(0xAAAAAA, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            $image = ImageManagerStatic::canvas(200, 200, $backgroundHexColor);

            $image->text($name, 100, 100, function ($font) {
                $font->file(public_path('assets/font/Poppins-Bold.ttf'));
                $font->size(36);
                $font->color('#ffffff');
                $font->align('center');
                $font->valign('middle');
            });
            $nameImage = 'logo/' . Str::random(20) . '.jpg';
            Storage::disk('public')->put($nameImage, $image->stream());

            $tim = new Tim;
            $tim->code = Str::uuid();
            $tim->nama = $namaTim;
            $tim->status_tim = $request->status_tim;
            $tim->logo = $nameImage;
            $tim->kadaluwarsa = false;
            $tim->save();

            foreach ($uniqueDaftarAnggota as $anggota) {
                $anggotaModel = new Anggota;
                $anggotaModel->tim_id = $tim->id;
                if ($anggota === $request->ketuaKelompok) {
                    $anggotaModel->jabatan_id = '1';

                    $this->sendNotification($anggota, 'Anda Ditambahkan ke Tim', 'Anda telah ditambahkan sebagai Ketua Tim ' . $namaTim);
                } else if ($anggota === $request->ketuaProjek) {
                    $anggotaModel->jabatan_id = '2';
                } else {
                    $anggotaModel->jabatan_id = '3';

                    $this->sendNotification($anggota, 'Anda Ditambahkan ke Tim', 'Anda telah ditambahkan sebagai Anggota Tim ' . $namaTim);
                }

                if ($anggotaModel->jabatan_id === '2' && empty($anggota)) {
                    continue;
                }

                $anggotaModel->user_id = $anggota;
                $anggotaModel->save();
            }

            return back()->with('success', 'Berhasil membuat tim');
        } catch (QueryException $e) {
            // Tangani exception terkait query/database
            return back()->with('error', 'Gagal membentuk tim');
        }
    }
    protected function sendNotification($userId, $title, $message)
    {
        Notifikasi::create([
            'user_id' => $userId,
            'judul' => $title,
            'body' => $message,
            'status' => 'belum_dibaca',
        ]);
    }
    // membuat notif
    // $notifAnggota = $tim->user;
    // foreach ($notifAnggota as $user) {
    //     $notif = new Notifikasi;
    //     $notif->code = Str::uuid();
    //     $notif->judul = "Kamu bergabung dengan Tim Baru";
    //     $notif->body = "Kamu bergabung di Tim dengan status tim " . $tim->status_tim;
    //     $notif->url = "tim/project/" . $tim->code;
    //     $notif->user_id = $user->id;
    //     $notif->save();
    // }
    protected function pembuatanTimProjectKetua(RequestPembentukanTimProjectKetua $request)
    {
        try {
            // Memeriksa kesamaan nilai kolom ID
            $daftarAnggota = $request->anggota;
            $daftarAnggota[] = $request->ketuaKelompok;
            $daftarAnggota[] = $request->ketuaProjek;
            $uniqueDaftarAnggota = array_unique($daftarAnggota);
            if (count($daftarAnggota) !== count($uniqueDaftarAnggota)) {
                throw new \Exception('User sudah digunakan di opsi lain.');
            }
            $tim = new Tim;
            $tim->code = Str::uuid();
            $statusTim = is_array($request->status_tim) ? $request->status_tim : [$request->status_tim];
            $tim->status_tim = implode(',', $statusTim);
            $tim->kadaluwarsa = false;
            $tim->save();

            //membuat tim
            $daftarAnggota = $request->anggota;
            $daftarAnggota[] = $request->ketuaKelompok;
            $daftarAnggota[] = $request->ketuaProjek;
            $uniqueDaftarAnggota = array_unique($daftarAnggota);
            foreach ($uniqueDaftarAnggota as $anggota) {
                $anggotaModel = new Anggota;
                $anggotaModel->tim_id = $tim->id;
                if ($anggota === $request->ketuaKelompok) {
                    $anggotaModel->jabatan_id = '1';
                } else if ($anggota === $request->ketuaProjek) {
                    $anggotaModel->jabatan_id = '2';
                } else {
                    $anggotaModel->jabatan_id = '3';
                }

                if ($anggotaModel->jabatan_id === '2' && empty($anggota)) {
                    continue;
                }
                $anggotaModel->user_id = $anggota;
                $anggotaModel->save();
            }
            return response()->json(['message' => 'Berhasil membentuk tim'], 200);
        } catch (QueryException $e) {
            // Tangani exception terkait query/database
            return response()->json(['message' => 'Gagal membentuk tim. Terjadi kesalahan pada database.'], 500);
        } catch (\Exception $e) {
            // Tangani exception umum, termasuk kesalahan validasi
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    protected function editProject(editProjectRequest $request, $code)
    {
        try {
            $tim = Tim::where('code', $code)->firstOrFail();
            $validated = $request->validated();
            if ($request->hasFile('logo')) {
                Storage::disk('public')->delete($tim->logo);
                $tim->update(['logo' => $validated['logo']->store('logo', 'public')]);
            }
            if ($request->deskripsiInput != null) {
                Project::where('tim_id', $tim->id)->update(['deskripsi' => $validated['deskripsiInput']]);
            }
            if ($request->namaTimInput != null) {
                $tim->update(['nama' => $validated['namaTimInput']]);
            }
            return back()->with('success', 'Berhasil mengedit project');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
