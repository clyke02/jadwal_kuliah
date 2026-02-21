<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang!</h2>
        <p class="text-gray-500 mt-1 text-sm">Masuk ke akun Jadwal Kuliah kamu</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="off"
                    class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('email') border-red-400 @enderror"
                    placeholder="nama@email.com">
            </div>
            @error('email')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('password') border-red-400 @enderror"
                    placeholder="••••••••">
            </div>
            @error('password')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me + Lupa Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                <span class="text-sm text-gray-600">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Tombol Login -->
        <button type="submit"
            class="w-full py-2.5 px-4 rounded-lg text-white text-sm font-semibold transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            style="background: linear-gradient(135deg, #2563eb, #3b82f6);"
            onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
            Masuk
        </button>

        <!-- Link Daftar -->
        @if (Route::has('register'))
            <p class="text-center text-sm text-gray-500 mt-4">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Daftar sekarang</a>
            </p>
        @endif
    </form>
</x-guest-layout>
