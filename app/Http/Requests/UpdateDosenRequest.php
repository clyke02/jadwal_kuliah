<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDosenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $dosenId = $this->route('dosen');

        return [
            'nip' => [
                'required', 'string', 'max:255',
                Rule::unique('dosens', 'nip')->where('user_id', auth()->id())->ignore($dosenId),
            ],
            'name' => 'required|string|max:255',
        ];
    }
}
