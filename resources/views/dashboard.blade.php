<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Total Dosen</h3>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalDosen }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Total Mata Kuliah</h3>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalMataKuliah }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Total Ruangan</h3>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalRuangan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Total Jadwal</h3>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalJadwal }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Selamat Datang di Sistem Manajemen Jadwal Kuliah</h3>
                    <p class="text-gray-600">Gunakan menu navigasi di atas untuk mengelola data dosen, mata kuliah, ruangan, dan jadwal perkuliahan.</p>

            @php
            $btcItems = [
                [
                    'badge' => 'PHP',
                    'title' => 'DashboardController::index()',
                    'route' => 'GET /dashboard',
                    'desc'  => 'Mengambil total data milik user yang sedang login menggunakan relasi Eloquent HasMany. Setiap query di-scope ke <code>auth()->user()</code> sehingga data antar akun tidak tercampur.',
                    'file'  => 'app/Http/Controllers/DashboardController.php',
                    'code'  => <<<'CODE'
public function index()
{
    $user = auth()->user();

    $totalDosen      = $user->dosens()->count();
    $totalMataKuliah = $user->mataKuliahs()->count();
    $totalRuangan    = $user->ruangans()->count();
    $totalJadwal     = $user->jadwals()->count();

    return view('dashboard', compact(
        'totalDosen', 'totalMataKuliah',
        'totalRuangan', 'totalJadwal'
    ));
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.018.02','J.620100.021.02'],
                ],
                [
                    'badge' => 'Eloquent',
                    'title' => 'User HasMany Relationships',
                    'route' => '',
                    'desc'  => 'Model <code>User</code> memiliki relasi <code>hasMany</code> ke semua model lain. Memungkinkan query berantai seperti <code>auth()->user()->dosens()->count()</code> tanpa perlu <code>WHERE user_id = ?</code> manual.',
                    'file'  => 'app/Models/User.php',
                    'code'  => <<<'CODE'
class User extends Authenticatable
{
    public function dosens(): HasMany
    {
        return $this->hasMany(Dosen::class);
    }
    public function mataKuliahs(): HasMany
    {
        return $this->hasMany(MataKuliah::class);
    }
    public function ruangans(): HasMany
    {
        return $this->hasMany(Ruangan::class);
    }
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
CODE,
        'kompetensi' => ['J.620100.018.02','J.620100.021.02'],
                ],
                [
                    'badge' => 'Auth',
                    'title' => 'Middleware auth — melindungi route',
                    'route' => 'middleware: auth, verified',
                    'desc'  => 'Semua route di dalam grup <code>auth</code> hanya bisa diakses user yang sudah login. Jika belum login, Laravel otomatis redirect ke <code>/login</code>.',
                    'file'  => 'routes/web.php',
                    'code'  => <<<'CODE'
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    // ... semua route lainnya
});
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
                ],
    [
        'badge' => 'SQL',
        'title' => 'Query COUNT — statistik dashboard',
        'route' => '',
        'desc'  => 'Eloquent <code>->count()</code> menghasilkan 4 query COUNT terpisah. Setiap query di-scope ke <code>user_id</code> aktif sehingga data tidak bercampur antar akun.',
        'file'  => '-- Dieksekusi saat DashboardController::index()',
        'code'  => <<<'CODE'
-- Eloquent: auth()->user()->dosens()->count()
SELECT COUNT(*) AS aggregate
FROM `dosens`
WHERE `user_id` = 1;

-- Eloquent: auth()->user()->mataKuliahs()->count()
SELECT COUNT(*) AS aggregate
FROM `mata_kuliahs`
WHERE `user_id` = 1;

-- Eloquent: auth()->user()->ruangans()->count()
SELECT COUNT(*) AS aggregate
FROM `ruangans`
WHERE `user_id` = 1;

-- Eloquent: auth()->user()->jadwals()->count()
SELECT COUNT(*) AS aggregate
FROM `jadwals`
WHERE `user_id` = 1;
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Dashboard" />
        </div>
    </div>
</x-app-layout>