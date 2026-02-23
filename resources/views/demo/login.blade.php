<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Demo Login</h2>
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
                            <p style="color:#93c5fd;font-size:12px;font-weight:600;letter-spacing:0.08em;margin:0 0 4px 0;">FORM LOGIN</p>
                            <h2 style="color:#fff;font-size:20px;font-weight:700;margin:0 0 4px 0;">Demo UI Login</h2>
                            <p style="color:#93c5fd;font-size:13px;margin:0;">Tampilan non-fungsional untuk code review</p>
                        </div>
                        <div class="p-8">
                            <div style="background:#fef3c7;border:1px solid #fde68a;border-radius:8px;padding:10px 14px;margin-bottom:20px;font-size:12px;color:#92400e;">
                                ⚠️ Form ini tidak bisa digunakan login. Hanya untuk demonstrasi UI & kode.
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <div style="position:relative;">
                                    <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#9ca3af;">
                                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </span>
                                    <input type="email" value="mahasiswa@kampus.ac.id" disabled
                                        style="width:100%;padding:10px 12px 10px 40px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;background:#f9fafb;color:#6b7280;cursor:not-allowed;">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                                <div style="position:relative;">
                                    <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#9ca3af;">
                                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    </span>
                                    <input type="password" value="password" disabled
                                        style="width:100%;padding:10px 12px 10px 40px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;background:#f9fafb;color:#6b7280;cursor:not-allowed;">
                                </div>
                            </div>

                            <button disabled style="width:100%;padding:12px;border-radius:8px;border:none;background:linear-gradient(135deg,#1e3a5f,#1e40af);color:#fff;font-size:14px;font-weight:600;cursor:not-allowed;opacity:0.8;">
                                Masuk
                            </button>
                            <p class="text-center text-xs text-gray-400 mt-4">Belum punya akun? <span class="text-blue-500">Daftar di sini</span></p>
                        </div>
                    </div>
                </div>

                {{-- Kanan: Alur Autentikasi --}}
                <div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-sm font-bold text-gray-700 mb-4">🔄 Alur Autentikasi Login</h3>
                        @foreach([
                            ['color'=>'#3b82f6','text'=>'User POST email + password ke /login'],
                            ['color'=>'#3b82f6','text'=>'LoginRequest::authenticate() → Auth::attempt()'],
                            ['color'=>'#8b5cf6','text'=>'Auth::attempt() → Hash::check(password, db_hash)'],
                            ['color'=>'#10b981','text'=>'Session regenerate → simpan user ID di session'],
                            ['color'=>'#10b981','text'=>'Redirect ke /dashboard'],
                            ['color'=>'#ef4444','text'=>'Gagal → kembali ke form dengan error message'],
                        ] as $i => $step)
                        <div class="flex items-center gap-3 py-2 {{ $i > 0 ? 'border-t border-gray-100' : '' }}">
                            <span style="width:22px;height:22px;border-radius:50%;background:{{ $step['color'] }};color:#fff;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;">{{ $i+1 }}</span>
                            <span class="text-sm text-gray-600">{{ $step['text'] }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4 flex gap-3">
                        <a href="{{ route('demo.register') }}" class="flex-1 text-center py-2 text-sm text-blue-600 bg-blue-50 rounded-lg border border-blue-200 hover:bg-blue-100 transition-colors">
                            Lihat Demo Register →
                        </a>
                        <a href="{{ route('login') }}" class="flex-1 text-center py-2 text-sm text-gray-600 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors">
                            Login Asli
                        </a>
                    </div>
                </div>
            </div>

            @php
            $btcItems = [
                [
                    'badge' => 'PHP',
                    'title' => 'AuthenticatedSessionController::store()',
                    'route' => 'POST /login',
                    'desc'  => 'Auth::attempt() mencocokkan email+password menggunakan Hash::check() di balik layar. Jika cocok → session dibuat secara otomatis.',
                    'file'  => 'app/Http/Controllers/Auth/AuthenticatedSessionController.php',
                    'code'  => <<<'CODE'
public function store(LoginRequest $request)
{
    $request->authenticate();
    // ↑ memanggil Auth::attempt() di balik layar

    $request->session()->regenerate();
    // ↑ cegah session fixation attack

    return redirect()->intended(RouteServiceProvider::HOME);
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
                ],
                [
                    'badge' => 'Auth',
                    'title' => 'Auth Facade — check, user, id, logout',
                    'route' => '',
                    'desc'  => 'Facade Auth adalah pintu masuk ke sistem autentikasi Laravel. Di baliknya menggunakan Guard (default: session guard) yang menyimpan user ID di session terenkripsi.',
                    'file'  => 'Illuminate/Support/Facades/Auth.php',
                    'code'  => <<<'CODE'
Auth::attempt(['email' => $e, 'password' => $p]);
// → true jika cocok, false jika tidak

Auth::user();   // objek User yang login
Auth::id();     // ID user yang login
Auth::check();  // true/false apakah sudah login
Auth::logout(); // hapus session

// Di Blade / Controller:
auth()->user()->name
auth()->id()
CODE,
                ],
                [
                    'badge' => 'PHP',
                    'title' => 'Password Hashing — Hash::make & check',
                    'route' => '',
                    'desc'  => 'Laravel TIDAK menyimpan password plaintext. Password di-hash menggunakan bcrypt saat register. Auth::attempt() otomatis memanggil Hash::check() untuk verifikasi.',
                    'file'  => 'app/Http/Controllers/Auth/RegisteredUserController.php',
                    'code'  => <<<'CODE'
// Saat REGISTER — hash password
User::create([
    'password' => Hash::make($request->password),
    // → "$2y$12$abc..." (tidak bisa di-reverse)
]);

// Saat LOGIN — Auth::attempt() otomatis cek:
Hash::check("input_password", "$2y$12$abc...");
// → true/false
CODE,
        'kompetensi' => ['J.620100.022.02'],
                ],
                [
                    'badge' => 'Route',
                    'title' => 'Middleware auth — melindungi route',
                    'route' => 'middleware: [auth, verified]',
                    'desc'  => 'Middleware adalah lapisan perantara antara request dan controller. Middleware <code>auth</code> akan redirect ke <code>/login</code> jika user belum terautentikasi.',
                    'file'  => 'routes/web.php',
                    'code'  => <<<'CODE'
Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/dashboard', [...]);
        // Semua route di sini hanya untuk user login
    });

// Jika belum login → redirect ke /login
// Jika sudah login → lanjut ke controller
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
                ],
    [
        'badge' => 'SQL',
        'title' => 'Query SELECT — autentikasi user',
        'route' => '',
        'desc'  => 'Laravel TIDAK menyimpan plain password. Saat login, ia mengambil row user berdasarkan email, lalu <code>Hash::check()</code> membandingkan input dengan bcrypt hash di database.',
        'file'  => '-- Dieksekusi saat Auth::attempt()',
        'code'  => <<<'CODE'
-- Step 1: cari user berdasarkan email
SELECT * FROM `users`
WHERE `email` = 'mahasiswa@kampus.ac.id'
LIMIT 1;

-- Step 2: PHP mem-verifikasi password (bukan SQL)
-- Hash::check('input_password', '$2y$10$abc...xyz')
-- → true / false

-- Step 3: jika berhasil, simpan session
INSERT INTO `sessions`
    (`id`, `user_id`, `ip_address`, `payload`, `last_activity`)
VALUES
    ('abc123...', 1, '127.0.0.1', 'encoded...', 1708505400);

-- Password di DB adalah bcrypt hash, bukan plain text:
-- $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Demo Login" />

        </div>
    </div>
</x-app-layout>
