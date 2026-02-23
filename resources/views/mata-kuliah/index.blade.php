<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Mata Kuliah
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
                        <a href="{{ route('mata-kuliah.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Mata Kuliah
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode MK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($mataKuliahs as $index => $mataKuliah)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $mataKuliahs->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $mataKuliah->kode_mk }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $mataKuliah->nama }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $mataKuliah->sks }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('mata-kuliah.edit', $mataKuliah) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('mata-kuliah.destroy', $mataKuliah) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Belum ada data mata kuliah
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $mataKuliahs->links() }}
                    </div>
                </div>
            </div>

            @php
            $btcItems = [
    [
        'badge' => 'PHP',
        'title' => 'MataKuliahController::index()',
        'route' => 'GET /mata-kuliah',
        'desc'  => 'Query di-scope ke user aktif. Hanya mata kuliah milik user ini yang tampil.',
        'file'  => 'app/Http/Controllers/MataKuliahController.php',
        'code'  => <<<'CODE'
public function index()
{
    $mataKuliahs = auth()->user()
        ->mataKuliahs()
        ->latest()
        ->paginate(10);

    return view('mata-kuliah.index', compact('mataKuliahs'));
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.018.02','J.620100.021.02'],
    ],
    [
        'badge' => 'Request',
        'title' => 'StoreMataKuliahRequest — kode_mk unik per user',
        'route' => '',
        'desc'  => 'Kode MK boleh sama di akun berbeda, tapi tidak boleh duplikat dalam satu akun.',
        'file'  => 'app/Http/Requests/StoreMataKuliahRequest.php',
        'code'  => <<<'CODE'
public function rules(): array
{
    return [
        'kode_mk' => [
            'required', 'string', 'max:20',
            Rule::unique('mata_kuliahs', 'kode_mk')
                ->where('user_id', auth()->id()),
        ],
        'nama' => ['required', 'string', 'max:255'],
        'sks'  => ['required', 'integer', 'min:1', 'max:6'],
    ];
}
CODE,
        'kompetensi' => ['J.620100.022.02'],
    ],
    [
        'badge' => 'SQL',
        'title' => 'Query SELECT — daftar mata kuliah',
        'route' => '',
        'desc'  => 'Setiap query di-scope ke <code>user_id</code> aktif. Kolom <code>kode</code> bersifat unik per user (bukan global), memungkinkan dua user punya kode mata kuliah yang sama.',
        'file'  => '-- Dieksekusi saat MataKuliahController::index()',
        'code'  => <<<'CODE'
SELECT COUNT(*) AS aggregate
FROM `mata_kuliahs`
WHERE `user_id` = 1;

SELECT * FROM `mata_kuliahs`
WHERE `user_id` = 1
ORDER BY `created_at` DESC
LIMIT 10 OFFSET 0;

-- Struktur tabel mata_kuliahs:
-- CREATE TABLE `mata_kuliahs` (
--   `id`         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
--   `user_id`    BIGINT UNSIGNED NOT NULL,
--   `kode`       VARCHAR(20) NOT NULL,
--   `name`       VARCHAR(255) NOT NULL,
--   `sks`        TINYINT NOT NULL DEFAULT 2,
--   `created_at` TIMESTAMP NULL,
--   `updated_at` TIMESTAMP NULL,
--   FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
-- );
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Mata Kuliah" />
        </div>
    </div>
</x-app-layout>