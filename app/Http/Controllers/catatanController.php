<?php

namespace App\Http\Controllers;

use App\Models\catatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class catatanController extends Controller
{
    protected function store(Request $request)
    {
        try {
            if (!$request->content) {
                return redirect()->back()->with('error', 'Isilah catatan terlebih dahulu!');
            }

            catatan::create([
                'code' => Str::uuid(),
                'user_id' => Auth::user()->id,
                'content' => $request->content
            ]);
            return redirect()->back()->with('success', 'Catatan berhasil dibuat!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Catatan gagal dibuat!');
        }
    }

    protected function update(Request $request, string $code)
    {
        dd($request->all());
    }

    protected function delete(string $code)
    {
        try {
            catatan::where('code', $code)->delete();
            return redirect()->back()->with('success', 'Catatan berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Catatan gagal dihapus!');
        }
    }
}
