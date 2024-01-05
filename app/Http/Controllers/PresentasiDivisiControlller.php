<?php

namespace App\Http\Controllers;

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
        $presentasiDivisi = PresentasiDivisi::query()
            ->create($data);
        foreach ($data['dari'] as $index => $dari) {
            LimitPresentasiDevisi::query()
                ->create([
                    'presentasi_divisi_id' => $presentasiDivisi->id,
                    'dari' => $dari,
                    'sampai' => $data['sampai'][$index]
                ]);
        }
        return redirect()->back()->with('success', 'Berhasil menambahkan divisi');
    }

    /**
     * destroy
     *
     * @param  mixed $divisi
     * @return RedirectResponse
     */
    public function destroy(PresentasiDivisi $presentasiDivisi): RedirectResponse
    {
        $presentasiDivisi->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus divisi');
    }
}
