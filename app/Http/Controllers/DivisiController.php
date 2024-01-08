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
    public function index()
    {
        $divisis = Divisi::query()->get();
        return response()->json(['divisis' => $divisis]);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(DivisiRequest $request)
    {
        Divisi::create($request->validated());
        return response()->json(['success' => 'Berhasil Menambahkan divisi']);
    }

    /**
     * update
     *
     * @param  mixed $divisi
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function update(Divisi $divisi, DivisiRequest $request)
    {
        $divisi
            ->update($request->validated());
        return response()->json(['success' => 'Berhasil Merubah divisi']);
    }

    /**
     * destroy
     *
     * @param  mixed $divisi
     * @return RedirectResponse
     */
    public function destroy(Divisi $divisi)
    {
        $divisi->delete();
        return response()->json(['success' => 'Berhasil Menghapus divisi']);
    }
}
