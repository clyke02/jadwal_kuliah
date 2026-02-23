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

            @php
            $btcItems = [
    [
        'badge' => 'PHP',
        'title' => 'MataKuliahController::store()',
        'route' => 'POST /mata-kuliah',
        'desc'  => 'Relasi <code>auth()->user()->mataKuliahs()->create()</code> otomatis mengisi <code>user_id</code>. Validasi memastikan kode MK unik per user.',
        'file'  => 'app/Http/Controllers/MataKuliahController.php',
        'code'  => <<<'CODE'
public function store(StoreMataKuliahRequest $request)
{
    $mk = auth()->user()
        ->mataKuliahs()
        ->create($request->validated());

    return redirect()->route('mata-kuliah.index')
        ->with('success', 'Mata Kuliah berhasil ditambahkan!');
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
    ],
    [
        'badge' => 'Blade',
        'title' => '@csrf — CSRF Token Protection',
        'route' => '',
        'desc'  => 'Setiap form POST wajib menyertakan <code>@csrf</code>. Laravel menolak request tanpa token yang cocok (HTTP 419 Page Expired).',
        'file'  => 'resources/views/mata-kuliah/create.blade.php',
        'code'  => <<<'CODE'
<form action="{{ route('mata-kuliah.store') }}" method="POST">
    @csrf
    {{-- Digenerate menjadi: --}}
    {{-- <input type="hidden" name="_token" value="..."> --}}
    <button type="submit">Simpan</button>
</form>
CODE,
    ],
    [
        'badge' => 'SQL',
        'title' => 'Query INSERT — simpan mata kuliah baru',
        'route' => '',
        'desc'  => 'Kolom <code>sks</code> divalidasi antara 1–6. Laravel secara otomatis men-cast integer di PHP sebelum INSERT sehingga tidak ada risk type mismatch.',
        'file'  => '-- Dieksekusi saat MataKuliahController::store()',
        'code'  => <<<'CODE'
INSERT INTO `mata_kuliahs`
    (`user_id`, `kode`, `name`, `sks`, `created_at`, `updated_at`)
VALUES
    (1, 'IF301', 'Pemrograman Web', 3, NOW(), NOW());
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Tambah Mata Kuliah" />
        </div>
    </div>
</x-app-layout>