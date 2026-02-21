<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Jadwal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $errors->first('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('jadwal.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="mata_kuliah_id" value="Mata Kuliah" />
                            <select id="mata_kuliah_id" name="mata_kuliah_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Mata Kuliah</option>
                                @foreach ($mataKuliahs as $mk)
                                    <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>
                                        {{ $mk->kode_mk }} - {{ $mk->nama }} ({{ $mk->sks }} SKS)
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('mata_kuliah_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="dosen_id" value="Dosen" />
                            <select id="dosen_id" name="dosen_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Dosen</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->name }} ({{ $dosen->nip }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('dosen_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="ruangan_id" value="Ruangan" />
                            <select id="ruangan_id" name="ruangan_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Ruangan</option>
                                @foreach ($ruangans as $ruangan)
                                    <option value="{{ $ruangan->id }}" {{ old('ruangan_id') == $ruangan->id ? 'selected' : '' }}>
                                        {{ $ruangan->nama }} (Kapasitas: {{ $ruangan->kapasitas }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('ruangan_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="hari" value="Hari" />
                            <select id="hari" name="hari" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Hari</option>
                                @foreach ($hariOptions as $hari)
                                    <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>
                                        {{ $hari }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('hari')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="jam_mulai" value="Jam Mulai" />
                            <x-text-input id="jam_mulai" name="jam_mulai" type="time" class="mt-1 block w-full" :value="old('jam_mulai')" required />
                            <x-input-error :messages="$errors->get('jam_mulai')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="jam_selesai" value="Jam Selesai" />
                            <x-text-input id="jam_selesai" name="jam_selesai" type="time" class="mt-1 block w-full" :value="old('jam_selesai')" required />
                            <x-input-error :messages="$errors->get('jam_selesai')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('jadwal.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button>Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
