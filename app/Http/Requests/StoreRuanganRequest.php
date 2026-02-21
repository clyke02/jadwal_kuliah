<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRuanganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => [
                'required', 'string', 'max:255',
                Rule::unique('ruangans', 'nama')->where('user_id', auth()->id()),
            ],
            'kapasitas' => 'required|integer|min:1',
        ];
    }
}
