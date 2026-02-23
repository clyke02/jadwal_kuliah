<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">About &amp; Tools</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Intro Banner --}}
            <div class="rounded-2xl p-6 mb-8 text-white"
                style="background: linear-gradient(135deg, #1e3a5f 0%, #1e40af 100%);">
                <div class="flex items-start gap-4">
                    <img src="{{ asset('icon.png') }}" alt="icon" style="width:48px;height:48px;object-fit:contain;flex-shrink:0;">
                    <div>
                        <h1 class="text-2xl font-bold mb-1">Tools &amp; Tech Stack yang Digunakan</h1>
                        <p class="text-blue-200 text-sm leading-relaxed">
                            Setiap tool disertai penjelasan, cara install via CLI, dan link website resmi.
                            Aplikasi ini dibangun menggunakan stack <strong class="text-white">PHP + Laravel + MySQL + Tailwind CSS</strong>.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Tools --}}

@php
            $tools = [
                [
                    'icon'    => 'php',
                    'name'    => 'PHP (Hypertext Preprocessor)',
                    'version' => 'v8.2',
                    'version_color' => '#3b82f6',
                    'website' => 'https://php.net',
                    'desc'    => 'PHP adalah bahasa pemrograman server-side yang menjadi fondasi aplikasi ini. PHP digunakan untuk logika bisnis, routing, akses database, dan rendering HTML melalui template engine Blade milik Laravel. PHP 8.2 membawa fitur modern seperti <em>readonly properties</em>, <em>enums</em>, dan <em>fibers</em>.',
                    'blocks'  => [
                        ['title' => '# Cek versi PHP yang terpasang', 'code' => 'php -v'],
                        ['title' => '# Install via Laragon (Windows – cara termudah)', 'code' => "Download Laragon di laragon.org, PHP sudah termasuk (bundled)"],
                        ['title' => '# Install Manual via Chocolatey (Windows)', 'code' => 'choco install php'],
                        ['title' => '# Install di Ubuntu/Debian', 'code' => 'sudo apt install php8.2 php8.2-cli php8.2-pdo php8.2-sqlite3 php8.2-mbstring'],
                    ],
                ],
                [
                    'icon'    => 'laravel',
                    'name'    => 'Laravel Framework',
                    'version' => 'v11',
                    'version_color' => '#ef4444',
                    'website' => 'https://laravel.com',
                    'docs'    => 'https://laravel.com/docs',
                    'desc'    => 'PHP framework dengan arsitektur MVC yang ekspresif dan elegan. Laravel menyediakan <strong>Eloquent ORM</strong> (query database dengan sintaks berorientasi objek), <strong>Blade</strong> (template engine), <strong>Artisan</strong> (CLI tool), <strong>Migrations</strong> (version control untuk skema database), <strong>Middleware</strong>, dan sistem autentikasi lengkap. Framework paling populer di ekosistem PHP.',
                    'blocks'  => [
                        ['title' => '# Install Laravel Installer (global)', 'code' => 'composer global require laravel/installer'],
                        ['title' => '# Buat proyek Laravel baru', 'code' => 'laravel new nama-proyek'],
                        ['title' => '# Atau via Composer langsung', 'code' => 'composer create-project laravel/laravel nama-proyek'],
                        ['title' => '# Jalankan development server', 'code' => "cd nama-proyek\nphp artisan serve\n# → http://127.0.0.1:8000"],
                    ],
                ],
                [
                    'icon'    => 'mysql',
                    'name'    => 'MySQL / MariaDB',
                    'version' => 'v8.0 / v10.x',
                    'version_color' => '#f59e0b',
                    'website' => 'https://dev.mysql.com',
                    'desc'    => 'Sistem manajemen database relasional yang digunakan untuk menyimpan seluruh data aplikasi: jadwal kuliah, dosen, mata kuliah, dan ruangan. Laravel berkomunikasi dengan MySQL melalui <strong>PDO</strong> dan <strong>Eloquent ORM</strong>. Konfigurasi koneksi disimpan di file <code>.env</code>.',
                    'blocks'  => [
                        ['title' => '# Konfigurasi .env untuk MySQL', 'code' => "DB_CONNECTION=mysql\nDB_HOST=127.0.0.1\nDB_PORT=3306\nDB_DATABASE=jadwal_kuliah\nDB_USERNAME=root\nDB_PASSWORD=\nDB_COLLATION=utf8mb4_unicode_ci"],
                        ['title' => '# Jalankan migrasi dan seeder', 'code' => 'php artisan migrate --seed'],
                        ['title' => '# Reset database (hapus semua tabel lalu migrasi ulang)', 'code' => 'php artisan migrate:fresh --seed'],
                        ['title' => '# Buka MySQL CLI', 'code' => "mysql -u root -p\nuse jadwal_kuliah;"],
                    ],
                ],
                [
                    'icon'    => 'composer',
                    'name'    => 'Composer',
                    'version' => 'v2.x',
                    'version_color' => '#8b5cf6',
                    'website' => 'https://getcomposer.org',
                    'desc'    => 'Dependency manager untuk PHP. Composer mengelola semua paket/library PHP yang dibutuhkan aplikasi, termasuk Laravel itu sendiri, dan menyimpan daftarnya di <code>composer.json</code>. Semua dependensi diunduh ke folder <code>vendor/</code>.',
                    'blocks'  => [
                        ['title' => '# Install dependensi proyek', 'code' => 'composer install'],
                        ['title' => '# Update semua dependensi ke versi terbaru', 'code' => 'composer update'],
                        ['title' => '# Tambah paket baru', 'code' => 'composer require nama/paket'],
                        ['title' => '# Cek versi Composer', 'code' => 'composer --version'],
                    ],
                ],
                [
                    'icon'    => 'tailwind',
                    'name'    => 'Tailwind CSS',
                    'version' => 'v3.x',
                    'version_color' => '#06b6d4',
                    'website' => 'https://tailwindcss.com',
                    'desc'    => 'Framework CSS utility-first yang digunakan untuk mendesain seluruh tampilan aplikasi ini. Tailwind menyediakan class-class kecil seperti <code>flex</code>, <code>p-4</code>, <code>rounded-xl</code> yang digabung langsung di HTML. Tidak perlu menulis CSS manual. Build output dioptimasi oleh <strong>Vite</strong> sehingga file CSS sangat kecil di production.',
                    'blocks'  => [
                        ['title' => '# Install Tailwind CSS via npm', 'code' => "npm install -D tailwindcss postcss autoprefixer\nnpx tailwindcss init -p"],
                        ['title' => '# Konfigurasi content di tailwind.config.js', 'code' => "module.exports = {\n  content: ['./resources/**/*.blade.php', './resources/**/*.js'],\n  theme: { extend: {} },\n  plugins: [],\n}"],
                        ['title' => '# Build CSS untuk production', 'code' => 'npm run build'],
                        ['title' => '# Development mode (watch perubahan)', 'code' => 'npm run dev'],
                    ],
                ],
                [
                    'icon'    => 'alpine',
                    'name'    => 'Alpine.js',
                    'version' => 'v3.x',
                    'version_color' => '#10b981',
                    'website' => 'https://alpinejs.dev',
                    'desc'    => 'JavaScript framework ringan untuk menambahkan interaktivitas ke halaman HTML. Alpine.js digunakan di aplikasi ini untuk toggle sidebar pada layar mobile dan beberapa interaksi UI kecil. Alpine bekerja langsung di markup HTML menggunakan direktif seperti <code>x-data</code>, <code>x-show</code>, <code>@click</code> – tanpa build step.',
                    'blocks'  => [
                        ['title' => '# Install Alpine.js via npm', 'code' => 'npm install alpinejs'],
                        ['title' => '# Import di resources/js/app.js', 'code' => "import Alpine from 'alpinejs';\nwindow.Alpine = Alpine;\nAlpine.start();"],
                        ['title' => '# Contoh penggunaan di Blade (toggle sidebar)', 'code' => "<div x-data=\"{ open: false }\">\n  <button @click=\"open = !open\">Toggle</button>\n  <div x-show=\"open\">Konten tersembunyi</div>\n</div>"],
                    ],
                ],
                [
                    'icon'    => 'vite',
                    'name'    => 'Vite',
                    'version' => 'v5.x',
                    'version_color' => '#a78bfa',
                    'website' => 'https://vitejs.dev',
                    'desc'    => 'Build tool modern yang digunakan untuk mengkompilasi dan mengoptimasi asset frontend (CSS dan JavaScript). Vite sangat cepat karena menggunakan <strong>ES Modules</strong> secara native. Laravel secara resmi mengintegrasikan Vite melalui paket <code>laravel-vite-plugin</code>. File hasil build disimpan di <code>public/build/</code>.',
                    'blocks'  => [
                        ['title' => '# Install dependensi npm (termasuk Vite)', 'code' => 'npm install'],
                        ['title' => '# Mode development (hot reload)', 'code' => 'npm run dev'],
                        ['title' => '# Build untuk production', 'code' => 'npm run build'],
                        ['title' => '# Konfigurasi di vite.config.js', 'code' => "import { defineConfig } from 'vite';\nimport laravel from 'laravel-vite-plugin';\n\nexport default defineConfig({\n  plugins: [\n    laravel({\n      input: ['resources/css/app.css', 'resources/js/app.js'],\n      refresh: true,\n    }),\n  ],\n});"],
                    ],
                ],
                [
                    'icon'    => 'laravel_breeze',
                    'name'    => 'Laravel Breeze',
                    'version' => 'v2.x',
                    'version_color' => '#f97316',
                    'website' => 'https://laravel.com/docs/starter-kits#breeze',
                    'desc'    => 'Starter kit autentikasi resmi dari Laravel. Breeze menyediakan implementasi lengkap untuk <strong>Login</strong>, <strong>Register</strong>, <strong>Forgot Password</strong>, <strong>Email Verification</strong>, dan <strong>Profile</strong> dengan tampilan berbasis Blade dan Tailwind CSS. Cocok untuk proyek yang butuh autentikasi cepat tanpa kompleksitas tambahan.',
                    'blocks'  => [
                        ['title' => '# Install Laravel Breeze', 'code' => 'composer require laravel/breeze --dev'],
                        ['title' => '# Scaffold Breeze (pilih stack Blade)', 'code' => 'php artisan breeze:install blade'],
                        ['title' => '# Jalankan migrasi dan build asset', 'code' => "php artisan migrate\nnpm install\nnpm run dev"],
                        ['title' => '# Route yang dibuat Breeze', 'code' => "GET  /login         → LoginController\nPOST /login         → login\nGET  /register      → RegisterController\nPOST /register      → register\nGET  /dashboard     → Dashboard"],
                    ],
                ],
            ];
            @endphp

            {{-- Satu container untuk semua tools --}}
            <div style="background:#fff;border-radius:16px;box-shadow:0 1px 4px rgba(0,0,0,0.07);border:1px solid #e5e7eb;overflow:hidden;">
                @foreach($tools as $i => $tool)

                {{-- Divider antar tool --}}
                @if($i > 0)
                <div style="height:1px;background:#e5e7eb;margin:0 24px;"></div>
                @endif

                <div style="padding:28px 28px 24px 28px;">

                    {{-- Header Tool --}}
                    <div style="display:flex;align-items:flex-start;gap:14px;margin-bottom:16px;">

                        {{-- Badge Icon --}}
                        <div style="width:44px;height:44px;border-radius:10px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            @if($tool['icon'] === 'php')
                                <svg viewBox="0 0 50 50" style="width:30px;height:30px;" fill="none" xmlns="http://www.w3.org/2000/svg"><ellipse cx="25" cy="25" rx="24" ry="14" fill="#8892bf"/><text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="white" font-size="14" font-weight="bold" font-family="monospace">PHP</text></svg>
                            @elseif($tool['icon'] === 'laravel')
                                <svg viewBox="0 0 50 50" style="width:30px;height:30px;" xmlns="http://www.w3.org/2000/svg"><rect width="50" height="50" rx="8" fill="#ef4444"/><text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="white" font-size="18" font-weight="bold" font-family="monospace">L</text></svg>
                            @elseif($tool['icon'] === 'mysql')
                                <svg viewBox="0 0 50 50" style="width:30px;height:30px;" xmlns="http://www.w3.org/2000/svg"><rect width="50" height="50" rx="8" fill="#f59e0b"/><text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="white" font-size="10" font-weight="bold" font-family="monospace">SQL</text></svg>
                            @elseif($tool['icon'] === 'composer')
                                <svg viewBox="0 0 50 50" style="width:30px;height:30px;" xmlns="http://www.w3.org/2000/svg"><rect width="50" height="50" rx="8" fill="#8b5cf6"/><text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="white" font-size="10" font-weight="bold" font-family="monospace">CPR</text></svg>
                            @elseif($tool['icon'] === 'tailwind')
                                <svg viewBox="0 0 50 50" style="width:30px;height:30px;" xmlns="http://www.w3.org/2000/svg"><rect width="50" height="50" rx="8" fill="#06b6d4"/><text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="white" font-size="12" font-weight="bold" font-family="monospace">TW</text></svg>
                            @elseif($tool['icon'] === 'alpine')
                                <svg viewBox="0 0 50 50" style="width:30px;height:30px;" xmlns="http://www.w3.org/2000/svg"><rect width="50" height="50" rx="8" fill="#10b981"/><text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="white" font-size="10" font-weight="bold" font-family="monospace">ALP</text></svg>
                            @elseif($tool['icon'] === 'vite')
                                <svg viewBox="0 0 50 50" style="width:30px;height:30px;" xmlns="http://www.w3.org/2000/svg"><rect width="50" height="50" rx="8" fill="#a78bfa"/><text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="white" font-size="12" font-weight="bold" font-family="monospace">VTE</text></svg>
                            @else
                                <svg viewBox="0 0 50 50" style="width:30px;height:30px;" xmlns="http://www.w3.org/2000/svg"><rect width="50" height="50" rx="8" fill="#f97316"/><text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="white" font-size="10" font-weight="bold" font-family="monospace">BRZ</text></svg>
                            @endif
                        </div>

                        {{-- Nama, versi, link --}}
                        <div style="flex:1;min-width:0;">
                            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:8px;margin-bottom:4px;">
                                <span style="font-size:15px;font-weight:700;color:#111827;">{{ $tool['name'] }}</span>
                                <span style="font-size:11px;font-weight:600;padding:2px 8px;border-radius:99px;color:#fff;background:{{ $tool['version_color'] }};">{{ $tool['version'] }}</span>
                                <a href="{{ $tool['website'] }}" target="_blank"
                                    style="font-size:12px;color:#3b82f6;text-decoration:none;display:inline-flex;align-items:center;gap:3px;">
                                    <svg style="width:11px;height:11px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    {{ parse_url($tool['website'], PHP_URL_HOST) }}
                                </a>
                                @isset($tool['docs'])
                                <a href="{{ $tool['docs'] }}" target="_blank"
                                    style="font-size:12px;color:#6b7280;text-decoration:none;display:inline-flex;align-items:center;gap:3px;">
                                    <svg style="width:11px;height:11px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Docs
                                </a>
                                @endisset
                            </div>
                            <p style="font-size:13px;color:#4b5563;line-height:1.65;margin:0;">{!! $tool['desc'] !!}</p>
                        </div>
                    </div>

                    {{-- Satu blok terminal untuk semua commands tool ini --}}
                    <div style="padding-left:58px;">
                        <div style="border-radius:10px;overflow:hidden;border:1px solid #30363d;background:#0d1117;padding:14px 16px;">
                            @foreach($tool['blocks'] as $bi => $block)
                            @if($bi > 0)<div style="height:10px;"></div>@endif
                            <div style="font-family:monospace;font-size:11px;color:#6e7681;line-height:1.6;">{!! nl2br(e($block['title'])) !!}</div>
                            <pre style="margin:0;font-family:monospace;font-size:12px;color:#79c0ff;line-height:1.7;white-space:pre-wrap;word-break:break-all;">{{ $block['code'] }}</pre>
                            @endforeach
                        </div>
                    </div>

                </div>
                @endforeach
            </div>

            {{-- Tabel Unit Kompetensi --}}
            <div class="mt-8 bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div style="background:linear-gradient(135deg,#1e3a5f,#1e40af);padding:18px 24px;display:flex;align-items:center;gap:10px;">
                    <svg style="width:18px;height:18px;flex-shrink:0;" fill="none" stroke="#93c5fd" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    <div>
                        <h2 style="color:#fff;font-size:15px;font-weight:700;margin:0;">Unit Kompetensi yang Dicakup</h2>
                        <p style="color:#93c5fd;font-size:12px;margin:2px 0 0 0;">SKKNI Bidang Pengembangan Perangkat Lunak — 17 unit kompetensi</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="background:#f8fafc;border-bottom:2px solid #e5e7eb;">
                                <th style="padding:10px 16px;text-align:left;font-size:11px;font-weight:700;color:#6b7280;width:40px;">No</th>
                                <th style="padding:10px 16px;text-align:left;font-size:11px;font-weight:700;color:#6b7280;width:160px;">Kode Unit</th>
                                <th style="padding:10px 16px;text-align:left;font-size:11px;font-weight:700;color:#6b7280;">Judul Unit Kompetensi</th>
                                <th style="padding:10px 16px;text-align:left;font-size:11px;font-weight:700;color:#6b7280;">Diterapkan Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $units = [
                                ['J.620100.001.01','Menganalisis Tools','About &amp; Tools — identifikasi setiap library','#eef2ff','#4338ca'],
                                ['J.620100.002.01','Menganalisis Skalabilitas Perangkat Lunak','Middleware auth, pagination, eager loading','#f0fdf4','#15803d'],
                                ['J.620100.003.01','Melakukan Identifikasi Library/Framework','About &amp; Tools — deskripsi setiap tool','#eef2ff','#4338ca'],
                                ['J.620100.006.01','Merancang User Experience','Seluruh tampilan UI (dashboard, form, tabel)','#fff7ed','#c2410c'],
                                ['J.620100.017.02','Mengimplementasikan Pemrograman Terstruktur','Semua Controller (index, store, update, destroy)','#eff6ff','#1d4ed8'],
                                ['J.620100.018.02','Mengimplementasikan Pemrograman OOP','Models, Controllers, Form Requests','#eff6ff','#1d4ed8'],
                                ['J.620100.020.02','Menggunakan SQL','Query SELECT, INSERT, UPDATE, DELETE di semua modul','#f0fdf4','#15803d'],
                                ['J.620100.021.02','Menerapkan Akses Basis Data','Eloquent ORM, migrations, foreign key','#f0fdf4','#15803d'],
                                ['J.620100.022.02','Mengimplementasikan Algoritma Pemrograman','Validasi jadwal konflik, password hashing, auth logic','#fef3c7','#b45309'],
                                ['J.620100.024.02','Melakukan Migrasi Ke Teknologi Baru','Laravel Breeze (auth modern), Vite (bundler modern)','#f5f3ff','#6d28d9'],
                                ['J.620100.025.02','Melakukan Debugging','Log Viewer real-time (menu Logs &amp; Debug)','#fef2f2','#b91c1c'],
                                ['J.620100.030.02','Menerapkan Pemrograman Multimedia','Tailwind CSS, Alpine.js (UI interaktif)','#fff7ed','#c2410c'],
                                ['J.620100.032.01','Menerapkan Code Review','Fitur Behind The Code di setiap halaman','#f5f3ff','#6d28d9'],
                                ['J.620100.036.02','Melaksanakan Pengujian Kode Secara Statis','Behind The Code + label kompetensi per snippet','#f5f3ff','#6d28d9'],
                                ['J.620100.044.01','Menerapkan Alert Notification','Log::warning, Log::error, Log Viewer alert','#fef2f2','#b91c1c'],
                                ['J.620100.045.01','Melakukan Pemantauan Resource','Log Viewer polling real-time setiap 2 detik','#fef2f2','#b91c1c'],
                                ['J.620100.047.01','Melakukan Pembaharuan Perangkat Lunak','Composer, npm, migrasi database','#f0fdf4','#15803d'],
                            ];
                            @endphp
                            @foreach($units as $i => $u)
                            <tr style="{{ $i % 2 === 0 ? 'background:#fff' : 'background:#fafafa' }};border-bottom:1px solid #f3f4f6;">
                                <td style="padding:10px 16px;font-size:12px;color:#9ca3af;font-weight:600;">{{ $i + 1 }}</td>
                                <td style="padding:10px 16px;">
                                    <span style="font-size:11px;font-weight:700;padding:3px 8px;border-radius:4px;background:{{ $u[4] }}22;color:{{ $u[4] }};font-family:monospace;border:1px solid {{ $u[4] }}44;">
                                        {{ $u[0] }}
                                    </span>
                                </td>
                                <td style="padding:10px 16px;font-size:12px;font-weight:600;color:#111827;">{!! $u[1] !!}</td>
                                <td style="padding:10px 16px;font-size:12px;color:#6b7280;">{!! $u[2] !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Footer --}}
            <div class="mt-8 text-center text-sm text-gray-400 pb-4">
                Jadwal Kuliah &copy; {{ date('Y') }} &mdash; Dibangun dengan Laravel {{ app()->version() }} &amp; PHP {{ phpversion() }}
            </div>

        </div>
    </div>

    @php
    $btcItems = [
        [
            'badge' => 'Laravel',
            'title' => 'AboutController::index()',
            'route' => 'GET /about',
            'desc'  => 'Controller sederhana yang hanya mengembalikan view. Data tools didefinisikan langsung di view menggunakan blok PHP Blade — tidak perlu database karena kontennya statis.',
            'file'  => 'app/Http/Controllers/AboutController.php',
            'code'  => <<<'CODE'
class AboutController extends Controller
{
    public function index()
    {
        return view('about.index');
    }
}

// routes/web.php:
Route::get('/about', [AboutController::class, 'index'])
    ->name('about.index');
CODE,
        'kompetensi' => ['J.620100.001.01','J.620100.003.01'],
        ],
        [
            'badge' => 'Blade',
            'title' => 'Blade PHP Block — data statis di view',
            'route' => '',
            'desc'  => 'Untuk data yang tidak berasal dari database, kita bisa mendefinisikan array langsung di Blade menggunakan blok <code>&lt;?php ... ?&gt;</code>. Ini lebih praktis daripada membuat controller khusus.',
            'file'  => 'resources/views/about/index.blade.php',
            'code'  => <<<'CODE'
// Definisikan data array langsung di view (tanpa DB):
// Buka dengan: directive "at"php di Blade
$tools = [
    [
        'icon'    => 'php',
        'name'    => 'PHP (Hypertext Preprocessor)',
        'version' => 'v8.2',
        'website' => 'https://php.net',
        'desc'    => '...',
        'blocks'  => [...],
    ],
    // ... tools lainnya
];
// Tutup dengan: directive "at"endphp (hapus komentar // di blade asli)

// Render:
// Loop dengan: @foreach($tools as $tool)
//     {{ $tool['name'] }} -- {{ $tool['version'] }}
// Tutup loop: @endforeach
CODE,
        'kompetensi' => ['J.620100.001.01','J.620100.003.01'],
        ],
    [
        'badge' => 'SQL',
        'title' => 'Skema database lengkap — semua tabel',
        'route' => '',
        'desc'  => 'Aplikasi ini menggunakan 5 tabel utama. Semua tabel data (selain users) memiliki <code>user_id</code> sebagai foreign key dengan <code>ON DELETE CASCADE</code>.',
        'file'  => '-- Ringkasan skema database',
        'code'  => <<<'CODE'
-- users (pusat sistem)
CREATE TABLE users (id, name, email UNIQUE, password, ...);

-- dosens (1 user → banyak dosen)
CREATE TABLE dosens (
    id, user_id FK→users(id) CASCADE,
    nip, name,
    UNIQUE(nip, user_id)
);

-- mata_kuliahs (1 user → banyak matkul)
CREATE TABLE mata_kuliahs (
    id, user_id FK→users(id) CASCADE,
    kode, name, sks
);

-- ruangans (1 user → banyak ruangan)
CREATE TABLE ruangans (
    id, user_id FK→users(id) CASCADE,
    name
);

-- jadwals (relasi ke 4 tabel sekaligus)
CREATE TABLE jadwals (
    id,
    user_id        FK→users(id) CASCADE,
    dosen_id       FK→dosens(id) CASCADE,
    mata_kuliah_id FK→mata_kuliahs(id) CASCADE,
    ruangan_id     FK→ruangans(id) CASCADE,
    hari, jam_mulai, jam_selesai
);
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
    ];
    @endphp
    <div class="py-4 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-behind-the-code :items="$btcItems" page-title="About & Tools" />
        </div>
    </div>
</x-app-layout>
