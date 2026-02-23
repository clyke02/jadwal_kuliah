<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Ruangan
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
                        <a href="{{ route('ruangan.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Ruangan
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ruangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($ruangans as $index => $ruangan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $ruangans->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $ruangan->nama }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $ruangan->kapasitas }} orang
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('ruangan.edit', $ruangan) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('ruangan.destroy', $ruangan) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Belum ada data ruangan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $ruangans->links() }}
                    </div>
                </div>
            </div>

            @php
            $btcItems = [
    [
        'badge' => 'PHP',
        'title' => 'RuanganController::index()',
        'route' => 'GET /ruangan',
        'desc'  => 'Mengambil data ruangan milik user aktif. Ruangan digunakan sebagai pilihan saat membuat jadwal dan dicek konfliknya oleh ScheduleService.',
        'file'  => 'app/Http/Controllers/RuanganController.php',
        'code'  => <<<'CODE'
public function index()
{
    $ruangans = auth()->user()
        ->ruangans()
        ->latest()
        ->paginate(10);

    return view('ruangan.index', compact('ruangans'));
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.018.02','J.620100.021.02'],
    ],
    [
        'badge' => 'Eloquent',
        'title' => 'Cascade Delete — onDelete("cascade")',
        'route' => '',
        'desc'  => 'Saat ruangan dihapus, semua jadwal yang menggunakan ruangan ini ikut terhapus otomatis karena migrasi mendefinisikan <code>onDelete("cascade")</code>.',
        'file'  => 'database/migrations/create_jadwals_table.php',
        'code'  => <<<'CODE'
$table->foreignId('ruangan_id')
    ->constrained('ruangans')
    ->onDelete('cascade');
// Saat ruangan dihapus → jadwal terkait ikut terhapus.
// Tidak perlu manual delete.
CODE,
        'kompetensi' => ['J.620100.021.02','J.620100.022.02'],
    ],
    [
        'badge' => 'SQL',
        'title' => 'Query SELECT — daftar ruangan',
        'route' => '',
        'desc'  => 'Nama ruangan bersifat unik per user. Jika ruangan masih dipakai di jadwal, <code>onDelete(\'cascade\')</code> pada tabel jadwal akan menghapus jadwal terkait secara otomatis.',
        'file'  => '-- Dieksekusi saat RuanganController::index()',
        'code'  => <<<'CODE'
SELECT COUNT(*) AS aggregate
FROM `ruangans`
WHERE `user_id` = 1;

SELECT * FROM `ruangans`
WHERE `user_id` = 1
ORDER BY `created_at` DESC
LIMIT 10 OFFSET 0;

-- Struktur tabel ruangans:
-- CREATE TABLE `ruangans` (
--   `id`         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
--   `user_id`    BIGINT UNSIGNED NOT NULL,
--   `name`       VARCHAR(255) NOT NULL,
--   `created_at` TIMESTAMP NULL,
--   `updated_at` TIMESTAMP NULL,
--   FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
-- );
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Ruangan" />
        </div>
    </div>
</x-app-layout>