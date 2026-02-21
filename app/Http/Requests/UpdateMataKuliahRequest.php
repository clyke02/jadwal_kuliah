<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMataKuliahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $mataKuliahId = $this->route('mata_kuliah');

        return [
            'kode_mk' => [
                'required', 'string', 'max:255',
                Rule::unique('mata_kuliahs', 'kode_mk')->where('user_id', auth()->id())->ignore($mataKuliahId),
            ],
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
        ];
    }
}
