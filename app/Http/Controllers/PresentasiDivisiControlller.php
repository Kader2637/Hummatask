<?php

namespace App\Http\Controllers;

use App\Http\Requests\LimitPresentasiDivisiRequest;
use App\Http\Requests\PresentasiDivisiRequest;
use App\Models\LimitPresentasiDevisi;
use App\Models\PresentasiDivisi;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        $pDivisi = PresentasiDivisi::query()
            ->findOrFail($data['presentasi_divisi_id']);
        $pDivisi->limitPresentasiDivisis()->delete();
        for ($i = 0; $i < (int) $pDivisi->limit; $i++) {
            LimitPresentasiDevisi::query()
                ->create([
                    'presentasi_divisi_id' => $data['presentasi_divisi_id'],
                    'jadwal_ke' => $data['jadwal_ke'][$i],
                    'mulai' => $data['mulai'][$i],
                    'akhir' => $data['akhir'][$i]
                ]);
        }
        return redirect()->back()->with('success', 'Berhasil menambahkan jadwal');

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
