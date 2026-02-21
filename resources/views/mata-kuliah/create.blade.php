<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Mata Kuliah
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('mata-kuliah.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="kode_mk" value="Kode Mata Kuliah" />
                            <x-text-input id="kode_mk" name="kode_mk" type="text" class="mt-1 block w-full" :value="old('kode_mk')" required />
                            <x-input-error :messages="$errors->get('kode_mk')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="nama" value="Nama Mata Kuliah" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama')" required />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="sks" value="SKS" />
                            <x-text-input id="sks" name="sks" type="number" min="1" max="6" class="mt-1 block w-full" :value="old('sks')" required />
                            <x-input-error :messages="$errors->get('sks')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('mata-kuliah.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button>Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
