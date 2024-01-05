<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DivisiRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:divisis,name,' . $this->divisi->id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal :max karakter',
            'name.unique' => 'Nama sudah digunakan',
        ];
    }
}
