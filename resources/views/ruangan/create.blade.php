<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Ruangan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('ruangan.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="nama" value="Nama Ruangan" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama')" required />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="kapasitas" value="Kapasitas" />
                            <x-text-input id="kapasitas" name="kapasitas" type="number" min="1" class="mt-1 block w-full" :value="old('kapasitas')" required />
                            <x-input-error :messages="$errors->get('kapasitas')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('ruangan.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button>Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
