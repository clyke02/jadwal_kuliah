<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Dosen
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
                        <a href="{{ route('dosen.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Dosen
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($dosens as $index => $dosen)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $dosens->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $dosen->nip }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $dosen->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('dosen.edit', $dosen) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('dosen.destroy', $dosen) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Belum ada data dosen
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $dosens->links() }}
                    </div>
                </div>
            </div>

            @php
            $btcItems = [
    [
        'badge' => 'PHP',
        'title' => 'DosenController::index()',
        'route' => 'GET /dosen',
        'desc'  => 'Mengambil semua dosen milik user yang sedang login dengan pagination 10 data per halaman. Query di-scope ke user aktif sehingga data antar akun tidak bercampur.',
        'file'  => 'app/Http/Controllers/DosenController.php',
        'code'  => <<<'CODE'
public function index()
{
    $dosens = auth()->user()
        ->dosens()
        ->latest()
        ->paginate(10);

    return view('dosen.index', compact('dosens'));
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.018.02','J.620100.021.02'],
    ],
    [
        'badge' => 'PHP',
        'title' => 'DosenController::destroy()',
        'route' => 'DELETE /dosen/{id}',
        'desc'  => '<code>abort_if()</code> memastikan hanya pemilik data yang boleh menghapus. Jika user lain mencoba, Laravel melempar HTTP 403 Forbidden.',
        'file'  => 'app/Http/Controllers/DosenController.php',
        'code'  => <<<'CODE'
public function destroy(Dosen $dosen)
{
    abort_if($dosen->user_id !== auth()->id(), 403);

    Log::warning('[Dosen] Dihapus', [
        'user' => auth()->user()->email,
        'id'   => $dosen->id,
        'nama' => $dosen->name,
    ]);

    $dosen->delete();

    return redirect()->route('dosen.index')
        ->with('success', 'Dosen berhasil dihapus!');
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
    ],
    [
        'badge' => 'Eloquent',
        'title' => 'Model Dosen — BelongsTo User',
        'route' => '',
        'desc'  => 'Setiap dosen memiliki <code>user_id</code> sebagai foreign key. Relasi <code>belongsTo</code> memungkinkan akses ke data user pemilik melalui <code>$dosen->user</code>.',
        'file'  => 'app/Models/Dosen.php',
        'code'  => <<<'CODE'
class Dosen extends Model
{
    protected $fillable = ['user_id', 'nip', 'name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
CODE,
        'kompetensi' => ['J.620100.018.02','J.620100.021.02'],
    ],
    [
        'badge' => 'SQL',
        'title' => 'Query SELECT — daftar dosen dengan pagination',
        'route' => '',
        'desc'  => 'Eloquent <code>->paginate(10)</code> menghasilkan 2 query: satu COUNT untuk total halaman, satu SELECT dengan LIMIT/OFFSET untuk data aktual.',
        'file'  => '-- Dieksekusi saat DosenController::index()',
        'code'  => <<<'CODE'
-- Query 1: hitung total data (untuk pagination)
SELECT COUNT(*) AS aggregate
FROM `dosens`
WHERE `user_id` = 1;

-- Query 2: ambil data halaman ini
SELECT * FROM `dosens`
WHERE `user_id` = 1
ORDER BY `created_at` DESC
LIMIT 10 OFFSET 0;

-- Struktur tabel dosens:
-- CREATE TABLE `dosens` (
--   `id`         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
--   `user_id`    BIGINT UNSIGNED NOT NULL,
--   `nip`        VARCHAR(20) NOT NULL,
--   `name`       VARCHAR(255) NOT NULL,
--   `created_at` TIMESTAMP NULL,
--   `updated_at` TIMESTAMP NULL,
--   FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
--   UNIQUE KEY `dosens_nip_user_id_unique` (`nip`, `user_id`)
-- );
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Data Dosen" />
        </div>
    </div>
</x-app-layout>