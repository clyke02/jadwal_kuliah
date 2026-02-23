<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Dosen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('dosen.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="nip" value="NIP" />
                            <x-text-input id="nip" name="nip" type="text" class="mt-1 block w-full" :value="old('nip')" required />
                            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('dosen.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button>Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            @php
            $btcItems = [
    [
        'badge' => 'PHP',
        'title' => 'DosenController::store()',
        'route' => 'POST /dosen',
        'desc'  => 'Data divalidasi oleh <code>StoreDosenRequest</code> sebelum disimpan. Relasi <code>auth()->user()->dosens()->create()</code> otomatis mengisi <code>user_id</code>.',
        'file'  => 'app/Http/Controllers/DosenController.php',
        'code'  => <<<'CODE'
public function store(StoreDosenRequest $request)
{
    $dosen = auth()->user()
        ->dosens()
        ->create($request->validated());

    Log::info('[Dosen] Ditambahkan', [
        'user' => auth()->user()->email,
        'nip'  => $dosen->nip,
        'nama' => $dosen->name,
    ]);

    return redirect()->route('dosen.index')
        ->with('success', 'Dosen berhasil ditambahkan!');
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
    ],
    [
        'badge' => 'Request',
        'title' => 'StoreDosenRequest — Validasi unik per user',
        'route' => '',
        'desc'  => 'Aturan <code>unique</code> di-scope ke <code>user_id</code> aktif. Dua user berbeda boleh punya NIP sama, tapi satu user tidak boleh duplikat.',
        'file'  => 'app/Http/Requests/StoreDosenRequest.php',
        'code'  => <<<'CODE'
public function rules(): array
{
    return [
        'nip'  => [
            'required', 'string', 'max:20',
            Rule::unique('dosens', 'nip')
                ->where('user_id', auth()->id()),
        ],
        'name' => ['required', 'string', 'max:255'],
    ];
}
CODE,
        'kompetensi' => ['J.620100.022.02'],
    ],
    [
        'badge' => 'SQL',
        'title' => 'Query INSERT — simpan dosen baru',
        'route' => '',
        'desc'  => '<code>auth()->user()->dosens()->create()</code> otomatis mengisi <code>user_id</code> dari user yang login. Laravel mengeksekusi INSERT dan langsung mengembalikan model yang baru dibuat.',
        'file'  => '-- Dieksekusi saat DosenController::store()',
        'code'  => <<<'CODE'
INSERT INTO `dosens`
    (`user_id`, `nip`, `name`, `created_at`, `updated_at`)
VALUES
    (1, '1099288388199', 'Sutanto', NOW(), NOW());

-- Jika NIP sudah ada untuk user yang sama → error:
-- SQLSTATE[23000]: Integrity constraint violation:
-- 1062 Duplicate entry '1099288388199-1'
--      for key 'dosens_nip_user_id_unique'
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Tambah Dosen" />
        </div>
    </div>
</x-app-layout>