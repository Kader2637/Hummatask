<?php

namespace App\Http\Controllers;

use App\Http\Requests\DivisiRequest;
use App\Models\Divisi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        $divisis = Divisi::query()
            ->get();
        return view('', compact('divisis'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(DivisiRequest $request): RedirectResponse
    {
        Divisi::query()
            ->create($request->validated());
        return redirect()->back()->with('success', 'Berhasil menambahkan divisi');
    }

    /**
     * update
     *
     * @param  mixed $divisi
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function update(Divisi $divisi, DivisiRequest $request): RedirectResponse
    {
        $divisi
            ->update($request->validated());
        return redirect()->back()->with('success', 'Berhasil merubah divisi');
    }

    /**
     * destroy
     *
     * @param  mixed $divisi
     * @return RedirectResponse
     */
    public function destroy(Divisi $divisi):  RedirectResponse
    {
        $divisi->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus divisi');
    }
}
