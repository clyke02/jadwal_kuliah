<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMataKuliahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_mk' => [
                'required', 'string', 'max:255',
                Rule::unique('mata_kuliahs', 'kode_mk')->where('user_id', auth()->id()),
            ],
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
        ];
    }
}
