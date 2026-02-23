<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="flex min-h-screen" x-data="{ sidebarOpen: false }">

            <!-- Overlay mobile -->
            <div
                x-show="sidebarOpen"
                @click="sidebarOpen = false"
                class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
                x-transition:enter="transition-opacity ease-linear duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
            </div>

            <!-- Sidebar -->
            @include('layouts.navigation')

            <!-- Konten Utama -->
            <div class="flex-1 flex flex-col min-w-0 lg:ml-64">

                <!-- Topbar mobile -->
                <div class="lg:hidden flex items-center justify-between bg-white shadow px-4 py-3">
                    <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <span class="font-bold text-gray-800">{{ config('app.name') }}</span>
                    <img src="{{ asset('icon.png') }}" alt="icon" style="height:28px;width:28px;object-fit:contain;">
                </div>

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-5 px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 p-6">
                    {{ $slot }}
                </main>
            </div>

        </div>
    </body>
</html>
