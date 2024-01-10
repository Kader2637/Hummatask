<?php

namespace App\Http\Controllers;

use App\Http\Requests\LimitPresentasiDivisiRequest;
use App\Http\Requests\PresentasiDivisiRequest;
use App\Models\LimitPresentasiDevisi;
use App\Models\PresentasiDivisi;
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
        PresentasiDivisi::query()->updateOrCreate(['divisi_id' => $data['divisi_id'], 'day' => $data['day']], ['limit' => $data['limit']]);
        // $presentasiDivisi->limitPresentasiDivisis()->delete();
        // foreach ($data['mulai'] as $index => $dari) {
        //     LimitPresentasiDevisi::query()
        //         ->create([
        //             'presentasi_divisi_id' => $presentasiDivisi->id,
        //             'mulai' => $dari,
        //             'akhir' => $data['akhir'][$index]
        //         ]);
        // }
        return redirect()
            ->back()
            ->with('success', 'Berhasil menambahkan limit');
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
    
    /**
     * destroy
     *
     * @param  mixed $divisi
     * @return RedirectResponse
     */
    public function destroy(PresentasiDivisi $presentasi_divisi): RedirectResponse
    {
        $presentasi_divisi->delete();
        return redirect()
            ->back()
            ->with('success', 'Berhasil menghapus divisi');
    }
}
