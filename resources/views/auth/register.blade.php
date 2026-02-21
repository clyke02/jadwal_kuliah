<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h2>
        <p class="text-gray-500 mt-1 text-sm">Daftarkan akun Jadwal Kuliah kamu</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nama -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('name') border-red-400 @enderror"
                    placeholder="Nama kamu">
            </div>
            @error('name')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
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
                <input id="password" name="password" type="password" required autocomplete="new-password"
                    class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('password') border-red-400 @enderror"
                    placeholder="Min. 8 karakter">
            </div>
            @error('password')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                    class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Ulangi password">
            </div>
            @error('password_confirmation')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Daftar -->
        <button type="submit"
            class="w-full py-2.5 px-4 rounded-lg text-white text-sm font-semibold transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mt-2"
            style="background: linear-gradient(135deg, #2563eb, #3b82f6);"
            onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
            Buat Akun
        </button>

        <!-- Link Login -->
        <p class="text-center text-sm text-gray-500 mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
