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

            @php
            $btcItems = [
    [
        'badge' => 'PHP',
        'title' => 'RuanganController::store()',
        'route' => 'POST /ruangan',
        'desc'  => 'Nama ruangan unik per user. Validasi dilakukan di <code>StoreRuanganRequest</code> menggunakan <code>Rule::unique</code> yang di-scope ke <code>user_id</code>.',
        'file'  => 'app/Http/Controllers/RuanganController.php',
        'code'  => <<<'CODE'
public function store(StoreRuanganRequest $request)
{
    $ruangan = auth()->user()
        ->ruangans()
        ->create($request->validated());

    Log::info('[Ruangan] Ditambahkan', [
        'user' => auth()->user()->email,
        'nama' => $ruangan->nama,
    ]);

    return redirect()->route('ruangan.index')
        ->with('success', 'Ruangan berhasil ditambahkan!');
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
    ],
    [
        'badge' => 'SQL',
        'title' => 'Query INSERT — simpan ruangan baru',
        'route' => '',
        'desc'  => 'Nama ruangan divalidasi unik per user. Contoh: user A boleh punya ruangan "Lab A" dan user B juga boleh punya "Lab A", tapi satu user tidak boleh duplikat.',
        'file'  => '-- Dieksekusi saat RuanganController::store()',
        'code'  => <<<'CODE'
INSERT INTO `ruangans`
    (`user_id`, `name`, `created_at`, `updated_at`)
VALUES
    (1, 'Lab Komputer A', NOW(), NOW());
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Tambah Ruangan" />
        </div>
    </div>
</x-app-layout>