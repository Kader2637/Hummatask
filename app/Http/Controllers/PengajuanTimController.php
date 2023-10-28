<?php

namespace App\Http\Controllers;
use App\Http\Requests\RequestPengajuanSoloProject;
use App\Models\Anggota;
use App\Models\Tim;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Str;
// use Illuminate\Http\Request;

class PengajuanTimController extends Controller
{
    protected function pengajuanSoloProject(RequestPengajuanSoloProject $request){


        // Kondisi dimana nama tim kosong atau foto kosong
        if($request->nama === null || $request->logo === null){
            return redirect()->back()->with('error','input Foto ataupun nama tim tidak boleh kosong');
        }

        // menyimpan logo
        $logo = $request->file('logo');
        $lokasiPenyimpanan = 'logo/';
        $namaLogo = $lokasiPenyimpanan . uniqid() . '.' . $logo->getClientOriginalExtension();
        $logo->storeAs($namaLogo);

        // membuat tim
        $tim = new Tim;
        $tim->uuid = Str::uuid();
        $tim->nama = $request->nama;
        $tim->logo = $namaLogo;
        $tim->repository = $request->repository;
        $tim->status_tim = 'solo';
        $tim->save();

        // membuat anggota
        $anggota = new Anggota;
        $anggota->tim_id = $tim->id;
        $anggota->jabatan = 'ketua_tim';
        $anggota->user_id = Auth::user()->id;
        $anggota->save();

        // hilangkan komentar dibawah ini untuk debugging
        // dd($request,$tim,$anggota);

        return redirect()->back()->with('success','Berhasil membuat tim solo project');

    }
}
