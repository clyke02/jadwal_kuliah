<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Mata Kuliah
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('mata-kuliah.update', $mataKuliah) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="kode_mk" value="Kode Mata Kuliah" />
                            <x-text-input id="kode_mk" name="kode_mk" type="text" class="mt-1 block w-full" :value="old('kode_mk', $mataKuliah->kode_mk)" required />
                            <x-input-error :messages="$errors->get('kode_mk')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="nama" value="Nama Mata Kuliah" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $mataKuliah->nama)" required />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="sks" value="SKS" />
                            <x-text-input id="sks" name="sks" type="number" min="1" max="6" class="mt-1 block w-full" :value="old('sks', $mataKuliah->sks)" required />
                            <x-input-error :messages="$errors->get('sks')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('mata-kuliah.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button>Update</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            @php
            $btcItems = [
    [
        'badge' => 'PHP',
        'title' => 'MataKuliahController::update()',
        'route' => 'PUT /mata-kuliah/{id}',
        'desc'  => 'Method PUT tidak didukung HTML form. Laravel menggunakan <code>@method("PUT")</code> untuk override via field <code>_method</code>.',
        'file'  => 'app/Http/Controllers/MataKuliahController.php',
        'code'  => <<<'CODE'
public function update(UpdateMataKuliahRequest $request, MataKuliah $mataKuliah)
{
    abort_if($mataKuliah->user_id !== auth()->id(), 403);
    $mataKuliah->update($request->validated());

    return redirect()->route('mata-kuliah.index')
        ->with('success', 'Mata Kuliah berhasil diupdate!');
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
    ],
    [
        'badge' => 'Blade',
        'title' => '@method("PUT") — Method Spoofing',
        'route' => '',
        'desc'  => 'HTML hanya mendukung GET dan POST. Laravel membaca field <code>_method=PUT</code> untuk mengarahkan ke method controller yang benar.',
        'file'  => 'resources/views/mata-kuliah/edit.blade.php',
        'code'  => <<<'CODE'
<form action="{{ route('mata-kuliah.update', $mataKuliah) }}"
      method="POST">
    @csrf
    @method('PUT')
    {{-- Digenerate: <input type="hidden" name="_method" value="PUT"> --}}
</form>
CODE,
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Edit Mata Kuliah" />
        </div>
    </div>
</x-app-layout>