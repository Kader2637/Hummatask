<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPresentasi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PengajuanPresentasiController extends Controller
{
    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validated(
            [
                'name' => 'required|max:255',
                'description' => 'required',
                'limit_presentasi_devisi_id' => 'required|exists:limit_presentasi_devisis,id',
            ],
        );

        PengajuanPresentasi::query()
            ->create($data);
        return redirect()->back()->with('success', 'Berhasil membuat mengajukan presentasi');
    }

    /**
     * update
     *
     * @param  mixed $pengajuan_presentasi
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function update(PengajuanPresentasi $pengajuan_presentasi, Request $request): RedirectResponse
    {
        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required',
                'limit_presentasi_devisi_id' => 'required|exists:limit_presentasi_devisis,id',
            ],
        );
        $pengajuan_presentasi->update($data);
        return redirect()->back()->with('success', 'Berhasil merubah pengajuan presentasi');
    }

    /**
     * destroy
     *
     * @param  mixed $pengajuan_presentasi
     * @return RedirectResponse
     */
    public function destroy(PengajuanPresentasi $pengajuan_presentasi): RedirectResponse
    {
        $pengajuan_presentasi->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus pengajuan presentasi');
    }
}
