<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editProjectRequest extends FormRequest
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
            'logo' => 'nullable|image',
            'namaTimInput' => 'nullable|string|max:50',
            'deskripsiInput' => 'nullable|string|max:250',
            'repoInput' => 'nullable|string|max:250|url',
        ];
    }

    public function messages(): array
    {
        return [
            'logo.image' => 'Logo harus berupa gambar.',
            'namaTimInput.string' => 'Nama tim harus berupa teks.',
            'namaTimInput.max' => 'Nama tim maksimal 50 karakter.',
            'deskripsiInput.string' => 'Deskripsi harus berupa teks.',
            'deskripsiInput.max' => 'Deskripsi maksimal 250 karakter.',
            'repoInput.string' => 'URL repository harus berupa teks.',
            'repoInput.url' => 'URL repository harus berupa URL yang valid.',
            'repoInput.max' => 'URL repository maksimal 250 karakter.',
        ];
    }
}
