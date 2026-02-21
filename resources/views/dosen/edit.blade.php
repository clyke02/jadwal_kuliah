<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Dosen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('dosen.update', $dosen) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="nip" value="NIP" />
                            <x-text-input id="nip" name="nip" type="text" class="mt-1 block w-full" :value="old('nip', $dosen->nip)" required />
                            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $dosen->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('dosen.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button>Update</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
