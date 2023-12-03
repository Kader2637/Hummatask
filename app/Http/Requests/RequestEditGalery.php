<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestEditGalery extends FormRequest
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
           'judul' => 'required|max:20',
           'keterangan' => 'required|max:255',
           'foto' => 'required|mimes:png,jpg,jpeg,gif'
        ];
    }
}
