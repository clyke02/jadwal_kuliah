<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJadwalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'dosen_id' => 'required|exists:dosens,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ];
    }
}
