<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRuanganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $ruanganId = $this->route('ruangan');

        return [
            'nama' => [
                'required', 'string', 'max:255',
                Rule::unique('ruangans', 'nama')->where('user_id', auth()->id())->ignore($ruanganId),
            ],
            'kapasitas' => 'required|integer|min:1',
        ];
    }
}
