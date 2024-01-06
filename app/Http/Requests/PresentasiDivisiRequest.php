<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PresentasiDivisiRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'day' => 'required',
            'mulai' => 'array',
            'mulai.*' => 'nullable',
            'akhir' => 'array',
            'akhir.*' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'day.required' => 'Kolom hari diperlukan.',
            'mulai.required' => 'Setiap nilai di kolom mulai diperlukan.',
            'mulai.*.required' => 'Setiap nilai di kolom mulai harus diisi.',
            'akhir.required' => 'Setiap nilai di kolom dari diperlukan.',
            'akhir.*.required' => 'Setiap nilai di kolom dari harus diisi.',
        ];
    }
}
