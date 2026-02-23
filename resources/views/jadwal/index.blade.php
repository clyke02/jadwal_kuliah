<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Jadwal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('jadwal.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Jadwal
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($jadwals as $index => $jadwal)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $jadwals->firstItem() + $index }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $jadwal->mataKuliah->nama }}
                                            <span class="text-gray-500">({{ $jadwal->mataKuliah->kode_mk }})</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $jadwal->dosen->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $jadwal->ruangan->nama }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $jadwal->hari }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('jadwal.edit', $jadwal) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Belum ada data jadwal
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $jadwals->links() }}
                    </div>
                </div>
            </div>

            @php
            $btcItems = [
    [
        'badge' => 'PHP',
        'title' => 'JadwalController::index() — Eager Loading',
        'route' => 'GET /jadwal',
        'desc'  => '<code>with([...])</code> adalah Eager Loading — mengambil relasi dalam satu query tambahan, bukan N+1 query per baris tabel.',
        'file'  => 'app/Http/Controllers/JadwalController.php',
        'code'  => <<<'CODE'
public function index()
{
    $jadwals = auth()->user()
        ->jadwals()
        ->with(['mataKuliah', 'dosen', 'ruangan'])
        ->latest()
        ->paginate(10);

    return view('jadwal.index', compact('jadwals'));
}

// TANPA with() → 1 query + N query per baris (N+1 Problem)
// DENGAN with() → 1 query + 3 query relasi (Eager Loading)
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.018.02','J.620100.021.02','J.620100.022.02'],
    ],
    [
        'badge' => 'Eloquent',
        'title' => 'Jadwal BelongsTo — Relasi ke 3 tabel',
        'route' => '',
        'desc'  => 'Relasi <code>belongsTo</code> memungkinkan akses ke data terkait melalui properti seperti <code>$jadwal->dosen->name</code> di Blade.',
        'file'  => 'app/Models/Jadwal.php',
        'code'  => <<<'CODE'
class Jadwal extends Model
{
    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class);
    }
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }
    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class);
    }
}
CODE,
    ],
    [
        'badge' => 'SQL',
        'title' => 'Query SELECT + JOIN — daftar jadwal',
        'route' => '',
        'desc'  => 'Jadwal membutuhkan data dari 3 tabel lain (dosen, mata kuliah, ruangan). Eloquent <code>->with([...])</code> menggunakan Eager Loading untuk mencegah N+1 problem — hanya 4 query total, bukan 1+N.',
        'file'  => '-- Dieksekusi saat JadwalController::index()',
        'code'  => <<<'CODE'
-- Query 1: count untuk pagination
SELECT COUNT(*) AS aggregate
FROM `jadwals` WHERE `user_id` = 1;

-- Query 2: data jadwal
SELECT * FROM `jadwals`
WHERE `user_id` = 1
ORDER BY `created_at` DESC
LIMIT 10 OFFSET 0;

-- Query 3: eager load dosen (WHERE IN, bukan N+1)
SELECT * FROM `dosens`
WHERE `id` IN (1, 2, 3, ...);

-- Query 4 & 5: eager load matkul & ruangan (sama polanya)

-- ⚠ Tanpa with([...]), setiap baris jadwal
--   memicu 3 query tambahan → N*3 + 1 total queries!

-- Struktur tabel jadwals:
-- CREATE TABLE `jadwals` (
--   `id`              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
--   `user_id`         BIGINT UNSIGNED NOT NULL,
--   `dosen_id`        BIGINT UNSIGNED NOT NULL,
--   `mata_kuliah_id`  BIGINT UNSIGNED NOT NULL,
--   `ruangan_id`      BIGINT UNSIGNED NOT NULL,
--   `hari`            ENUM('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'),
--   `jam_mulai`       TIME NOT NULL,
--   `jam_selesai`     TIME NOT NULL,
--   `created_at`      TIMESTAMP NULL,
--   `updated_at`      TIMESTAMP NULL
-- );
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02','J.620100.022.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Jadwal" />
        </div>
    </div>
</x-app-layout>