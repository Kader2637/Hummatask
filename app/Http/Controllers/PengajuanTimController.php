<?php

namespace App\Http\Controllers;

use App\Http\Requests\editProjectRequest;
use App\Http\Requests\RequestPembentukanTimProject;
use App\Http\Requests\RequestPembentukanTimProjectKetua;
use App\Http\Requests\RequestPengajuanSoloProject;
use App\Models\Anggota;
use App\Models\HistoryPresentasi;
use App\Models\Notifikasi;
use App\Models\Project;
use App\Models\Tema;
use App\Models\TidakPresentasiMingguan;
use App\Models\Tim;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

// use Illuminate\Http\Request;

class PengajuanTimController extends Controller
{
    protected function pengajuanSoloProject(RequestPengajuanSoloProject $request)
    {

        $userId = Auth::id();
        $user = User::find($userId);

        if ($user->status_kelulusan == 1) {
            return redirect()->back()->with('error', 'Kamu sudah lulus tidak bisa membuat tim');
        }
        // Kondisi dimana nama tim kosong atau foto kosong
        if ($request->nama === null || $request->logo === null) {
            return redirect()->back()->with('error', 'input Foto ataupun nama tim tidak boleh kosong');
        }


        try {
            $timDulu = User::find(Auth::user()->id)->anggota()->orderByDesc('created_at')->first()->status;
            //code...
        } catch (\Throwable $th) {
            $timDulu = null;
        }
        // dd($timDulu);

        if ($timDulu === 'active') {
            return redirect()->back()->with('error', 'Kamu masih memiliki tim yang belum selesai');
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

        $historyPresentasi = HistoryPresentasi::all()->sortByDesc('created_at')->first();
        if ($historyPresentasi) {
            TidakPresentasiMingguan::create([
                'tim_id' => $tim->id,
                "history_presentasi_id" => $historyPresentasi->id,
            ]);
        } else {
            $historyPresentasi = new HistoryPresentasi;
            $historyPresentasi->code = Str::uuid();

            $historyPresentasi->noMinggu = 1;
            $historyPresentasi->bulan = Carbon::now()->isoFormat("MMMM");
            $historyPresentasi->tahun = Carbon::now()->isoFormat("YYYY");
            $historyPresentasi->save();

            TidakPresentasiMingguan::create([
                'tim_id' => $tim->id,
                "history_presentasi_id" => $historyPresentasi->id,
            ]);
        }

        DB::table('labels')->insert([
            [
                'text' => 'Frontend',
                "tim_id" => $tim->id,
                "warna_bg" => "#DF826C",
                "warna_text" => "#FFFFFF"
            ],
            [
                'text' => 'Backend',
                "tim_id" => $tim->id,
                "warna_bg" => "#31304D",
                "warna_text" => "#FFFFFF"
            ],
            [
                'text' => 'UI',
                "tim_id" => $tim->id,
                "warna_bg" => "#6B240C",
                "warna_text" => "#FFFFFF"
            ],
            [
                'text' => 'UX',
                "tim_id" => $tim->id,
                "warna_bg" => "#860A35",
                "warna_text" => "#FFFFFF"
            ]
        ]);

        return redirect()->back()->with('success', 'Berhasil membuat tim solo project');
    }

    protected function pembuatanTimProject(RequestPembentukanTimProject $request)
    {
        try {
            $daftarAnggota = $request->anggota;
            $daftarAnggota[] = $request->ketuaKelompok;
            $uniqueDaftarAnggota = array_unique($daftarAnggota);

            $existingAnggota = Anggota::whereIn('user_id', $uniqueDaftarAnggota)->where('status', 'active')->first();
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

            DB::table('labels')->insert([
                [
                    'text' => 'Frontend',
                    "tim_id" => $tim->id,
                    "warna_bg" => "#DF826C",
                    "warna_text" => "#FFFFFF"
                ],
                [
                    'text' => 'Backend',
                    "tim_id" => $tim->id,
                    "warna_bg" => "#31304D",
                    "warna_text" => "#FFFFFF"
                ],
                [
                    'text' => 'UI',
                    "tim_id" => $tim->id,
                    "warna_bg" => "#6B240C",
                    "warna_text" => "#FFFFFF"
                ],
                [
                    'text' => 'UX',
                    "tim_id" => $tim->id,
                    "warna_bg" => "#860A35",
                    "warna_text" => "#FFFFFF"
                ]
            ]);

            $historyPresentasi = HistoryPresentasi::all()->sortByDesc('created_at')->first();
            if ($historyPresentasi) {
                TidakPresentasiMingguan::create([
                    'tim_id' => $tim->id,
                    "history_presentasi_id" => $historyPresentasi->id,
                ]);
            } else {
                $historyPresentasi = new HistoryPresentasi;
                $historyPresentasi->code = Str::uuid();

                $historyPresentasi->noMinggu = 1;
                $historyPresentasi->bulan = Carbon::now()->isoFormat("MMMM");
                $historyPresentasi->tahun = Carbon::now()->isoFormat("YYYY");
                $historyPresentasi->save();

                TidakPresentasiMingguan::create([
                    'tim_id' => $tim->id,
                    "history_presentasi_id" => $historyPresentasi->id,
                ]);
            }

            foreach ($uniqueDaftarAnggota as $anggota) {
                $anggotaModel = new Anggota;
                $anggotaModel->tim_id = $tim->id;
                if ($anggota === $request->ketuaKelompok) {
                    $anggotaModel->jabatan_id = '1';

                    $this->sendNotification($anggota, 'Anda Ditambahkan ke Tim', 'Anda telah ditambahkan sebagai Ketua Tim ' . $namaTim, 'info');
                } else if ($anggota === $request->ketuaProjek) {
                    $anggotaModel->jabatan_id = '2';
                } else {
                    $anggotaModel->jabatan_id = '3';

                    $this->sendNotification($anggota, 'Anda Ditambahkan ke Tim', 'Anda telah ditambahkan sebagai Anggota Tim ' . $namaTim, 'info');
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
    protected function sendNotification($userId, $title, $message, $jenisNotifikasi)
    {
        Notifikasi::create([
            'user_id' => $userId,
            'judul' => $title,
            'body' => $message,
            'status' => 'belum_dibaca',
            'jenis_notifikasi' => $jenisNotifikasi,
        ]);
    }

    function updateSolo($timId, Request $request)
    {
        $tim = Tim::findOrFail($timId);
        $kadaluwarsa = $request->input('kadaluwarsa');
        $anggota = $request->input('anggota');
        $tim->kadaluwarsa = $kadaluwarsa;

        if ($request->kadaluwarsa == "0") {
            $tim->anggota()
                ->whereIn('user_id', $anggota)
                ->update(['status' => 'active']);
        } elseif ($request->kadaluwarsa == "1") {
            $tim->anggota()
                ->whereIn('user_id', $anggota)
                ->update(['status' => 'expired']);
        }

        $tim->save();

        return response()->json(['success' => 'Berhasil update tim'], 200);
    }

    protected function updateTimProject(RequestPembentukanTimProject $request, Tim $timId)
    {
        $daftarAnggota = $request->anggota;
        $daftarAnggota[] = $request->ketuaKelompok;
        $uniqueDaftarAnggota = array_values(array_unique($daftarAnggota));
        $indexKetuaKelompok = array_search($request->ketuaKelompok, $uniqueDaftarAnggota);
        if ($indexKetuaKelompok !== false && $indexKetuaKelompok !== 0) {
            unset($uniqueDaftarAnggota[$indexKetuaKelompok]);
            array_unshift($uniqueDaftarAnggota, $request->ketuaKelompok);
        }

        $anggota = Anggota::whereIn('user_id', $uniqueDaftarAnggota);

        $existingAnggota = $anggota
        ->where('tim_id', '!=', $timId->id)
        ->where('status', 'active')
        ->first();

    if ($existingAnggota) {
        return response()->json(['errors' => ["Siswa {$existingAnggota->user->username} telah masuk di tim {$existingAnggota->tim->nama}"]], 422);
    }


        $timId->status_tim = $request->status_tim;
        $timId->kadaluwarsa = $request->kadaluwarsa;
        $tema = $request->input('tema');
        Tema::where('tim_id', $timId->id)
        ->where('nama_tema', '<>', null)
        ->update(['nama_tema' => $tema]);

        // $tema->nama_tema = $request->tema;
        $name = $timId->nama;
        if ($name == 'Pre-Mini Project Team') {
            $name = 'PreMini';
        } else if ($name == 'Mini Project Team') {
            $name = 'Mini';
        } else if ($name == 'Big Project Team') {
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

            $timId->logo = $nameImage;

        if ($request->kadaluwarsa == "0") {
            $timId->anggota()
                ->whereIn('user_id', $uniqueDaftarAnggota)
                ->update(['status' => 'active']);
        } elseif ($request->kadaluwarsa == "1") {
            $timId->anggota()
                ->whereIn('user_id', $uniqueDaftarAnggota)
                ->update(['status' => 'expired']);
        }

        $timId->save();

        $oldKickedAnggota = $timId->anggota()->where('status', 'kicked')->pluck('user_id')->toArray();

        $timId->anggota()
            ->whereNotIn('user_id', $uniqueDaftarAnggota)
            ->update([
                'status' => 'kicked',
                'jabatan_id' => 3,
            ]);

        $kickedAnggota = $timId->anggota->whereNotIn('user_id', array_merge($uniqueDaftarAnggota, $oldKickedAnggota));

        foreach ($kickedAnggota as $anggota) {
            $this->sendNotificationToMentor($anggota->user_id, 'Anda telah di-kick dari tim', 'Anda tidak lagi menjadi anggota tim.', 'deadline');
        }

        $iteration = 0;
        foreach ($uniqueDaftarAnggota as $anggota) {
            $existingAnggota = Anggota::where('tim_id', $timId->id)
                ->where('user_id', $anggota)
                ->first();

            if (isset($existingAnggota->user)) {
                if ($existingAnggota->user->status_kelulusan == 1) {
                    return response()->json(['errors' => ['Siswa telah lulus']], 422);
                }
            }

            if (!$existingAnggota) {
                $newAnggota = new Anggota();
                $newAnggota->user_id = $anggota;
                $newAnggota->tim_id = $timId->id;
                $newAnggota->jabatan_id = ($iteration === 0) ? 1 : 3;
                $newAnggota->save();
            } else {
                $existingAnggota->jabatan_id = ($iteration === 0) ? 1 : 3;
                $existingAnggota->save();
            }

            $iteration++;
        }

        return response()->json(['success' => 'Berhasil update tim'], 200);
    }

    protected function sendNotificationToMentor($mentorId, $title, $message, $jenisNotifikasi)
    {
        Notifikasi::create([
            'user_id' => $mentorId,
            'judul' => $title,
            'body' => $message,
            'status' => 'belum_dibaca',
            'jenis_notifikasi' => $jenisNotifikasi,
        ]);
    }

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
