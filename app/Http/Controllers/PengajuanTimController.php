<?php

namespace App\Http\Controllers;


use App\Http\Requests\RequestPembentukanTimProject;
use App\Http\Requests\RequestPembentukanTimProjectKetua;
use App\Http\Requests\RequestPengajuanSoloProject;
use App\Models\Anggota;
use App\Models\Project;
use App\Models\Tema;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;

class PengajuanTimController extends Controller
{
    protected function pengajuanSoloProject(RequestPengajuanSoloProject $request)
    {

        // Kondisi dimana nama tim kosong atau foto kosong
        if ($request->nama === null || $request->logo === null) {
            return redirect()->back()->with('error', 'input Foto ataupun nama tim tidak boleh kosong');
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
            $tim = new Tim;
            $tim->code = Str::uuid();
            // $tim->nama = $request->nama;
            $statusTim = is_array($request->status_tim) ? $request->status_tim : [$request->status_tim];
            $tim->status_tim = implode(',', $statusTim);
            $tim->kadaluwarsa = true;
            $tim->save();

            // membuat anggota

            $daftarAnggota = $request->anggota;
            array_push($daftarAnggota, $request->ketuaKelompok, $request->ketuaProjek);
            $interval = 2 + count($daftarAnggota);
            for ($i = 0; $i < $interval; $i++) {
                $anggota = new Anggota;
                $anggota->tim_id = $tim->id;
                if ($daftarAnggota[$i] === $request->ketuaKelompok) {
                    $anggota->jabatan_id = '1';
                } else if ($daftarAnggota[$i] === $request->ketuaProjek) {
                    $anggota->jabatan_id = '2';
                } else {
                    $anggota->jabatan_id = '3';
                }
                $anggota->user_id = $daftarAnggota[$i];
                $anggota->save();

            }
            return redirect()->back()->with('success', 'Berhasil membentuk tim');
        } catch (QueryException $e) {
            // Tangani exception terkait query/database
            return redirect()->back()->with('error', 'Gagal membentuk tim. Terjadi kesalahan pada database.');
        } catch (\Exception $e) {
            // Tangani exception umum
            return redirect()->back()->with('error', 'Gagal membentuk tim. Terjadi kesalahan.');
        }
    }

    protected function pembuatanTimProjectKetua(RequestPembentukanTimProjectKetua $request)
    {
        try {
            $tim = new Tim;
            $tim->code = Str::uuid();
            $statusTim = is_array($request->status_tim) ? $request->status_tim : [$request->status_tim];
            $tim->status_tim = implode(',', $statusTim);
            $tim->kadaluwarsa = true;
            $tim->save();

            //membuat tim
            $daftarAnggota = $request->anggota;
            array_push($daftarAnggota, $request->ketuaKelompok, $request->ketuaProjek);
            $interval = 2 + count($daftarAnggota);
            for ($i = 0; $i < $interval; $i++) {
                $anggota = new Anggota;
                $anggota->tim_id = $tim->id;
                if ($daftarAnggota[$i] === $request->ketuaKelompok) {
                    $anggota->jabatan_id = '1';
                } else if ($daftarAnggota[$i] === $request->ketuaProjek) {
                    $anggota->jabatan_id = '2';
                } else {
                    $anggota->jabatan_id = '3';
                }
                $anggota->user_id = $daftarAnggota[$i];
                $anggota->save();
            }
            return redirect()->back()->with('success', 'Berhasil Membuat Tim');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gagal membentuk tim. Terjadi kesalahan pada database');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membentuk tim . Terjadi Kesalahan');
        }
    }
}
