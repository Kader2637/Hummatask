<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */ 
    public function rules(): array
    {
        return [
            'temaInput' => 'required',
            'repository' => 'required|url',
        ];
    }

    public function messages()
    {
        return [
            'temaInput.required' => 'Kolom Tema wajib diisi.',
            'repository.required' => 'Kolom Repository wajib diisi.',
            'repository.url' => 'Kolom Repository harus berisi URL yang valid.',
        ];
    }
}
