<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Demo Register</h2>
            <span style="font-size:11px;background:#fef3c7;color:#92400e;padding:2px 10px;border-radius:99px;border:1px solid #fde68a;font-weight:600;">Non-Fungsional</span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

                {{-- Kiri: Demo Form --}}
                <div>
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                        <div style="background:linear-gradient(135deg,#1e3a5f,#1e40af);padding:28px 32px 24px;">
                            <p style="color:#93c5fd;font-size:12px;font-weight:600;letter-spacing:0.08em;margin:0 0 4px 0;">FORM REGISTRASI</p>
                            <h2 style="color:#fff;font-size:20px;font-weight:700;margin:0 0 4px 0;">Demo UI Register</h2>
                            <p style="color:#93c5fd;font-size:13px;margin:0;">Tampilan non-fungsional untuk code review</p>
                        </div>
                        <div class="p-8">
                            <div style="background:#fef3c7;border:1px solid #fde68a;border-radius:8px;padding:10px 14px;margin-bottom:20px;font-size:12px;color:#92400e;">
                                ⚠️ Form ini tidak bisa digunakan register. Hanya untuk demonstrasi.
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" value="Budi Mahasiswa" disabled
                                    style="width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;background:#f9fafb;color:#6b7280;cursor:not-allowed;">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <input type="email" value="budi@kampus.ac.id" disabled
                                    style="width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;background:#f9fafb;color:#6b7280;cursor:not-allowed;">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                                <input type="password" value="password" disabled
                                    style="width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;background:#f9fafb;color:#6b7280;cursor:not-allowed;">
                            </div>
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                                <input type="password" value="password" disabled
                                    style="width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;background:#f9fafb;color:#6b7280;cursor:not-allowed;">
                            </div>

                            <button disabled style="width:100%;padding:12px;border-radius:8px;border:none;background:linear-gradient(135deg,#1e3a5f,#1e40af);color:#fff;font-size:14px;font-weight:600;cursor:not-allowed;opacity:0.8;">
                                Daftar Sekarang
                            </button>
                            <p class="text-center text-xs text-gray-400 mt-4">Sudah punya akun? <span class="text-blue-500">Login di sini</span></p>
                        </div>
                    </div>
                </div>

                {{-- Kanan: Alur Registrasi --}}
                <div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-sm font-bold text-gray-700 mb-4">🔄 Alur Registrasi</h3>
                        @foreach([
                            ['color'=>'#3b82f6','text'=>'User POST: name, email, password, password_confirmation'],
                            ['color'=>'#3b82f6','text'=>'Validasi: email unik, password min 8 karakter, konfirmasi cocok'],
                            ['color'=>'#8b5cf6','text'=>'Hash::make(password) → simpan bcrypt hash ke DB'],
                            ['color'=>'#10b981','text'=>'User::create() → insert ke tabel users'],
                            ['color'=>'#10b981','text'=>'event(new Registered($user)) → kirim email verifikasi'],
                            ['color'=>'#10b981','text'=>'Auth::login($user) → langsung login, redirect ke dashboard'],
                        ] as $i => $step)
                        <div class="flex items-center gap-3 py-2 {{ $i > 0 ? 'border-t border-gray-100' : '' }}">
                            <span style="width:22px;height:22px;border-radius:50%;background:{{ $step['color'] }};color:#fff;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;">{{ $i+1 }}</span>
                            <span class="text-sm text-gray-600">{{ $step['text'] }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4 flex gap-3">
                        <a href="{{ route('demo.login') }}" class="flex-1 text-center py-2 text-sm text-blue-600 bg-blue-50 rounded-lg border border-blue-200 hover:bg-blue-100 transition-colors">
                            ← Lihat Demo Login
                        </a>
                        <a href="{{ route('register') }}" class="flex-1 text-center py-2 text-sm text-gray-600 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors">
                            Register Asli
                        </a>
                    </div>
                </div>
            </div>

            @php
            $btcItems = [
                [
                    'badge' => 'PHP',
                    'title' => 'RegisteredUserController::store()',
                    'route' => 'POST /register',
                    'desc'  => 'Controller register bawaan Breeze. Password di-hash menggunakan bcrypt sebelum disimpan. Setelah user dibuat, langsung di-login dan redirect ke dashboard.',
                    'file'  => 'app/Http/Controllers/Auth/RegisteredUserController.php',
                    'code'  => <<<'CODE'
public function store(Request $request)
{
    $request->validate([
        'name'     => ['required', 'string', 'max:255'],
        'email'    => ['required', 'email', 'max:255',
                       Rule::unique(User::class)],
        'password' => ['required', 'confirmed',
                       Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.018.02'],
                ],
                [
                    'badge' => 'PHP',
                    'title' => 'Hash::make() — bcrypt password',
                    'route' => '',
                    'desc'  => 'Bcrypt adalah algoritma hashing satu arah. Password yang sudah di-hash tidak bisa di-dekripsi. Setiap hash berbeda meskipun passwordnya sama (karena ada random salt).',
                    'file'  => 'Illuminate/Hashing/BcryptHasher.php',
                    'code'  => <<<'CODE'
$hash = Hash::make("rahasia123");
// → "$2y$12$abcdef..." (berbeda setiap kali!)

Hash::check("rahasia123", $hash); // → true
Hash::check("salah",      $hash); // → false

// Laravel menggunakan bcrypt cost factor = 12 (default)
// Semakin tinggi cost → semakin aman, tapi lebih lambat
CODE,
        'kompetensi' => ['J.620100.022.02'],
                ],
                [
                    'badge' => 'Eloquent',
                    'title' => 'User::create() — Mass Assignment',
                    'route' => '',
                    'desc'  => '<code>$fillable</code> di model User mendefinisikan field mana yang boleh di-isi massal. Proteksi dari Mass Assignment Attack.',
                    'file'  => 'app/Models/User.php',
                    'code'  => <<<'CODE'
class User extends Authenticatable
{
    // Hanya field ini yang boleh diisi via create()
    protected $fillable = [
        'name', 'email', 'password',
    ];

    // Field ini disembunyikan dari JSON/array
    protected $hidden = [
        'password', 'remember_token',
    ];
}
CODE,
        'kompetensi' => ['J.620100.018.02','J.620100.021.02'],
                ],
                [
                    'badge' => 'Route',
                    'title' => 'Route guest — hanya untuk belum login',
                    'route' => 'middleware: guest',
                    'desc'  => 'Route register dan login hanya bisa diakses jika user BELUM login. Jika sudah login, akan di-redirect ke dashboard.',
                    'file'  => 'routes/auth.php',
                    'code'  => <<<'CODE'
// Hanya untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('register',
        [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register',
        [RegisteredUserController::class, 'store']);
});
CODE,
        'kompetensi' => ['J.620100.017.02'],
                ],
    [
        'badge' => 'SQL',
        'title' => 'Query INSERT — registrasi user baru',
        'route' => '',
        'desc'  => 'Password di-hash dengan bcrypt sebelum INSERT — Laravel tidak pernah menyimpan plain password. Kolom <code>email</code> memiliki constraint UNIQUE sehingga duplikasi email langsung ditolak database.',
        'file'  => '-- Dieksekusi saat RegisteredUserController::store()',
        'code'  => <<<'CODE'
-- Step 1: cek duplikat email (validasi Laravel)
SELECT COUNT(*) AS aggregate
FROM `users`
WHERE `email` = 'budi@kampus.ac.id';

-- Step 2: INSERT user baru
INSERT INTO `users`
    (`name`, `email`, `password`, `created_at`, `updated_at`)
VALUES (
    'Budi Mahasiswa',
    'budi@kampus.ac.id',
    '$2y$12$eW5KlT...', -- Hash::make('password123')
    NOW(), NOW()
);

-- Step 3: langsung login (tanpa perlu re-input password)
-- Auth::login($user) → INSERT ke sessions table
INSERT INTO `sessions` (`id`, `user_id`, ...) VALUES (...);
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Demo Register" />

        </div>
    </div>
</x-app-layout>
