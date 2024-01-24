<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Http\Requests\LimitPresentasiDivisiRequest;
use App\Http\Requests\PresentasiDivisiRequest;
use App\Models\Anggota;
use App\Models\LimitPresentasiDevisi;
use App\Models\PresentasiDivisi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PresentasiDivisiControlller extends Controller
{

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(PresentasiDivisiRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['divisi_id'] = auth()->user()->divisi_id;
        $now = Carbon::now();
        $currentWeekStart = $now->startOfWeek();
        $previousWeekStart = $currentWeekStart->copy()->subWeek();
        $nextWeekStart = $currentWeekStart->copy()->addWeek();
        $presentasiDivisi = PresentasiDivisi::whereBetween('created_at', [$currentWeekStart, $currentWeekStart->copy()->endOfWeek()])->where('day', $data['day'])->where('divisi_id', $data['divisi_id'])->get();
        if (strtolower($data['day']) !== strtolower(Carbon::now()->format('l'))) {
            return redirect()->back()->with('error', 'Mentor hanya dapat mengajukan presentasi pada hari ini.')->withErrors(['day' => 'Mentor hanya dapat mengajukan presentasi pada hari ini.']);
        }

        if ($now->isSameWeek($currentWeekStart) && $presentasiDivisi->count() == 0) {
            PresentasiDivisi::query()->create([
                'divisi_id' => $data['divisi_id'],
                'day' => $data['day'],
                'limit' => $data['limit']
            ]);

            $Siswa = User::query()
                ->where('divisi_id', auth()->user()->divisi_id)
                ->where('peran_id', 1)
                ->get();

            foreach ($Siswa as $member) {
                $userId = $member->user_id;
                $statusAnggota = Anggota::where('user_id', $userId)->value('status');
                if ($statusAnggota !== ['kicked', 'expired']) {
                    if ($member->jabatan_id === 1) {
                        $this->sendNotificationToTeamMembers($userId, 'Jadwal Baru', 'Mentor sudah menambahkan Jadwal hari ini', 'info');
                    }
                }
            }

            return redirect()->back()->with('success', 'Berhasil menambah jadwal');
        } elseif ($now->isSameWeek($currentWeekStart) && $presentasiDivisi->count() > 0) {
            PresentasiDivisi::query()
                ->where([
                    'divisi_id' => $data['divisi_id'],
                    'day' => $data['day'],
                ])
                ->latest()
                ->update(['divisi_id' => $data['divisi_id'], 'day' => $data['day'], 'limit' => $data['limit']]);

            return redirect()->back()->with('success', 'Berhasil Mengedit jadwal');
        } elseif ($now->isSameWeek($nextWeekStart)) {
            PresentasiDivisi::query()
                ->create(['divisi_id' => $data['divisi_id'], 'day' => $data['day'], 'limit' => $data['limit']]);

            return redirect()->back()->with('success', 'Berhasil menambahkan limit baru untuk minggu depan');
        } else {
            return redirect()->back()->with('error', 'Tidak dapat membuat atau mengupdate limit pada minggu selanjutnya');
        }
    }

    /**
     * createJam
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function createJam(LimitPresentasiDivisiRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $now = Carbon::now();
        $currentWeekStart = $now->startOfWeek();
        $pDivisi = PresentasiDivisi::query()
            ->findOrFail($data['presentasi_divisi_id']);
        // dd($data);
        for ($i = 0; $i < (int) $pDivisi->limit; $i++) {
            $existingSchedule = LimitPresentasiDevisi::query()
                ->whereHas('presentasiDivisi', function ($query) use ($request) {
                    $query->where('day', $request['day'])
                        ->whereNot('divisi_id', Auth()->user()->divisi_id);
                })
                ->whereBetween('created_at', [$currentWeekStart, $currentWeekStart->copy()->endOfWeek()])
                ->where(function ($query) use ($data, $i) {
                    $query->whereBetween('mulai', [$data['mulai'][$i], $data['akhir'][$i]])
                        ->orWhereBetween('akhir', [$data['mulai'][$i], $data['akhir'][$i]]);
                })
                ->first();
            // dd($existingSchedule);
            if ($existingSchedule) {
                return redirect()->back()->with('error', 'Jadwal bertabrakan dengan jadwal yang sudah ada');
            }
        }

        $pDivisi = PresentasiDivisi::query()->findOrFail($data['presentasi_divisi_id']);
        $existingLimitPresentasiIds = $pDivisi->limitPresentasiDivisis()->pluck('id')->toArray();

        $inputCount = min((int) $pDivisi->limit, count($data['mulai']));

        for ($i = 0; $i < $inputCount; $i++) {
            $limitPresentasi = [
                'presentasi_divisi_id' => $data['presentasi_divisi_id'],
                'mulai' => $data['mulai'][$i],
                'akhir' => $data['akhir'][$i]
            ];

            if (isset($existingLimitPresentasiIds[$i])) {
                LimitPresentasiDevisi::query()
                    ->where('id', $existingLimitPresentasiIds[$i])
                    ->update($limitPresentasi);
            } else {
                LimitPresentasiDevisi::query()->create($limitPresentasi);
            }
        }

        // Hapus entri yang berlebih jika ada
        if (count($existingLimitPresentasiIds) > $inputCount) {
            LimitPresentasiDevisi::query()
                ->whereIn('id', array_slice($existingLimitPresentasiIds, $inputCount))
                ->delete();
        }

        return redirect()->back()->with('success', 'Berhasil menambahkan jadwal');
    }

    protected function sendNotificationToTeamMembers($userId, $title, $message, $jenisNotifikasi)
    {
        Notifikasi::create([
            'user_id' => $userId,
            'judul' => $title,
            'body' => $message,
            'status' => 'belum_dibaca',
            'jenis_notifikasi' => $jenisNotifikasi,
        ]);
    }


    /**
     * destroy
     *
     * @param  mixed $divisi
     * @return RedirectResponse
     */
    public function destroy(PresentasiDivisi $presentasi_divisi): RedirectResponse
    {
        $presentasi_divisi->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus divisi');
    }
}
