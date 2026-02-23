<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-30 w-64 flex flex-col transition-transform duration-200 ease-in-out lg:translate-x-0"
    style="background: linear-gradient(180deg, #1e3a5f 0%, #1e40af 100%);">

    <!-- Logo -->
    <div class="flex items-center gap-3 px-6 py-5 border-b border-blue-700">
        <img src="{{ asset('icon.png') }}" alt="icon" style="height:36px;width:36px;object-fit:contain;">
        <span class="text-white font-bold text-lg leading-tight">Jadwal Kuliah</span>
    </div>

    <!-- Menu Navigasi -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
            {{ request()->routeIs('dashboard') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        {{-- Dosen --}}
        <a href="{{ route('dosen.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
            {{ request()->routeIs('dosen.*') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Dosen
        </a>

        {{-- Mata Kuliah --}}
        <a href="{{ route('mata-kuliah.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
            {{ request()->routeIs('mata-kuliah.*') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            Mata Kuliah
        </a>

        {{-- Ruangan --}}
        <a href="{{ route('ruangan.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
            {{ request()->routeIs('ruangan.*') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            Ruangan
        </a>

        {{-- Jadwal --}}
        <a href="{{ route('jadwal.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
            {{ request()->routeIs('jadwal.*') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Jadwal
        </a>

        {{-- Logs --}}
        <a href="{{ route('logs.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
            {{ request()->routeIs('logs.*') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Logs
        </a>

        {{-- Demo Login & Register --}}
        <div class="pt-2 pb-1 px-4">
            <p style="font-size:10px;font-weight:700;letter-spacing:0.08em;color:rgba(255,255,255,0.35);text-transform:uppercase;">Demo</p>
        </div>
        <a href="{{ route('demo.login') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
            {{ request()->routeIs('demo.login') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Demo Login
        </a>
        <a href="{{ route('demo.register') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
            {{ request()->routeIs('demo.register') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Demo Register
        </a>

        {{-- About & Tools --}}
        <a href="{{ route('about.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
            {{ request()->routeIs('about.*') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            About &amp; Tools
        </a>

    </nav>

    <!-- User Info & Logout -->
    <div class="px-4 py-4 border-t border-blue-700">
        <div class="flex items-center gap-3 px-4 py-2 mb-2">
            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold text-blue-900 flex-shrink-0"
                style="background: rgba(255,255,255,0.9);">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-white text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                <p class="text-blue-300 text-xs truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <a href="{{ route('profile.edit') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white transition-colors duration-150">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Profil
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white transition-colors duration-150">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>

</aside>
