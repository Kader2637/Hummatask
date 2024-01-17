<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PresentasiDivisiRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'day' => 'required',
            'limit' => 'required|numeric|min:1|max:10',
            // 'mulai' => 'required|array',
            // 'mulai.*' => 'required',
            // 'akhir' => 'array',
            // 'akhir.*' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'day.required' => 'Kolom hari diperlukan.',
            'limit.required' => 'Limit tidak boleh kosong',
            'limit.min' => 'Limit harus lebih dari 1',
            'limit.max' => 'Limit maksimal 10',
            'mulai.required' => 'Setiap nilai di kolom mulai diperlukan.',
            'mulai.*.required' => 'Setiap nilai di kolom mulai harus diisi.',
            'akhir.required' => 'Setiap nilai di kolom dari diperlukan.',
            'akhir.*.required' => 'Setiap nilai di kolom dari harus diisi.',
        ];
    }
}
