<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LimitPresentasiDivisiRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'presentasi_divisi_id' => 'required|exists:presentasi_divisis,id',
            'mulai' => 'required|array',
            'mulai.*' => 'required',
            'akhir' => 'array',
            'akhir.*' => 'required',
            'jadwal_ke' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'jadwal_web.required' => 'Tidak boleh kosong.',
            'mulai.required' => 'Setiap nilai di kolom mulai diperlukan.',
            'mulai.*.required' => 'Setiap nilai di kolom mulai harus diisi.',
            'akhir.required' => 'Setiap nilai di kolom dari diperlukan.',
            'akhir.*.required' => 'Setiap nilai di kolom dari harus diisi.',
        ];
    }
}
