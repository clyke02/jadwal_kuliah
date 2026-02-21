<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@jadwal.test',
            'password' => Hash::make('password'),
        ]);

        $dosen1 = $user->dosens()->create([
            'nip' => '198501012010121001',
            'name' => 'Dr. Ahmad Fauzi, M.Kom',
        ]);

        $dosen2 = $user->dosens()->create([
            'nip' => '198702152011012002',
            'name' => 'Prof. Siti Nurhaliza, M.T',
        ]);

        $mk1 = $user->mataKuliahs()->create([
            'kode_mk' => 'IF101',
            'nama' => 'Pemrograman Dasar',
            'sks' => 3,
        ]);

        $mk2 = $user->mataKuliahs()->create([
            'kode_mk' => 'IF201',
            'nama' => 'Struktur Data',
            'sks' => 3,
        ]);

        $ruangan1 = $user->ruangans()->create([
            'nama' => 'R.101',
            'kapasitas' => 40,
        ]);

        $ruangan2 = $user->ruangans()->create([
            'nama' => 'R.102',
            'kapasitas' => 35,
        ]);

        $user->jadwals()->create([
            'mata_kuliah_id' => $mk1->id,
            'dosen_id' => $dosen1->id,
            'ruangan_id' => $ruangan1->id,
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:30',
        ]);

        $user->jadwals()->create([
            'mata_kuliah_id' => $mk2->id,
            'dosen_id' => $dosen2->id,
            'ruangan_id' => $ruangan2->id,
            'hari' => 'Rabu',
            'jam_mulai' => '13:00',
            'jam_selesai' => '15:30',
        ]);
    }
}
