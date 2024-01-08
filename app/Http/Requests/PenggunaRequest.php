<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenggunaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required',
            'email' => 'required',
            'sekolah' => 'required',
            'awal_magang' => 'required',
            'akhir_magang' => 'required',
            'tlp' => 'required',
            'divisi_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Kolom Nama harus diisi',
            'username.string' => 'Kolom Nama harus berupa teks',
            'username.max' => 'Kolom Nama tidak boleh lebih dari :max karakter',
            'email.required' => 'Kolom Email harus diisi',
            'email.email' => 'Email harus berupa alamat email yang valid',
            'email.unique' => 'Email sudah digunakan',
            'sekolah.required' => 'Kolom Sekolah harus diisi',
            'sekolah.string' => 'Kolom Sekolah harus berupa teks',
            'sekolah.max' => 'Kolom Sekolah tidak boleh lebih dari :max karakter',
            'masa_magang_awal.required' => 'Kolom Masa Magang Awal harus diisi',
            'masa_magang_awal.date' => 'Format Masa Magang Awal harus tanggal yang valid',
            'masa_magang_akhir.required' => 'Kolom Masa Magang Akhir harus diisi',
            'masa_magang_akhir.date' => 'Format Masa Magang Akhir harus tanggal yang valid',
            'masa_magang_akhir.after_or_equal' => 'Masa Magang Akhir harus setelah atau sama dengan Masa Magang Awal',
        ];
    }
}
