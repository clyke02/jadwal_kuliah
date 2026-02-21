<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Jadwal Kuliah') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex">

            <!-- Panel Kiri -->
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden" style="background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 50%, #3b82f6 100%);">
                <!-- Dekorasi lingkaran -->
                <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full opacity-10" style="background: white;"></div>
                <div class="absolute -bottom-32 -right-32 w-[500px] h-[500px] rounded-full opacity-10" style="background: white;"></div>
                <div class="absolute top-1/2 left-1/2 w-64 h-64 rounded-full opacity-5" style="background: white; transform: translate(-20%, -70%);"></div>

                <!-- Konten panel kiri -->
                <div class="relative z-10 flex flex-col justify-center items-center w-full px-12 text-white">
                    <img src="{{ asset('icon.png') }}" alt="Jadwal Kuliah" style="height: 100px; width: 100px; object-fit: contain;" class="mb-6 drop-shadow-lg">
                    <h1 class="text-4xl font-bold mb-3 text-center">Jadwal Kuliah</h1>
                    <p class="text-blue-100 text-center text-lg leading-relaxed max-w-sm">
                        Kelola jadwal perkuliahan kamu dengan mudah dan efisien
                    </p>

                    <!-- Fitur highlights -->
                    <div class="mt-10 space-y-4 w-full max-w-sm">
                        <div class="flex items-center gap-3 bg-white bg-opacity-10 rounded-xl px-4 py-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(255,255,255,0.2);">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-sm text-blue-50">Manajemen jadwal lengkap</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white bg-opacity-10 rounded-xl px-4 py-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(255,255,255,0.2);">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <span class="text-sm text-blue-50">Data terpisah per akun</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white bg-opacity-10 rounded-xl px-4 py-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(255,255,255,0.2);">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <span class="text-sm text-blue-50">Deteksi konflik otomatis</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel Kanan (Form) -->
            <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12 bg-gray-50">
                <div class="w-full max-w-md">
                    <!-- Logo mobile (hanya muncul di layar kecil) -->
                    <div class="flex flex-col items-center mb-8 lg:hidden">
                        <img src="{{ asset('icon.png') }}" alt="Jadwal Kuliah" style="height: 60px; width: 60px; object-fit: contain;" class="mb-3">
                        <h1 class="text-2xl font-bold text-gray-800">Jadwal Kuliah</h1>
                    </div>

                    <!-- Card Form -->
                    <div class="bg-white rounded-2xl shadow-lg px-8 py-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
