<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Ruangan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('ruangan.update', $ruangan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="nama" value="Nama Ruangan" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $ruangan->nama)" required />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="kapasitas" value="Kapasitas" />
                            <x-text-input id="kapasitas" name="kapasitas" type="number" min="1" class="mt-1 block w-full" :value="old('kapasitas', $ruangan->kapasitas)" required />
                            <x-input-error :messages="$errors->get('kapasitas')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('ruangan.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button>Update</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            @php
            $btcItems = [
    [
        'badge' => 'PHP',
        'title' => 'RuanganController::update() — Route Model Binding',
        'route' => 'PUT /ruangan/{id}',
        'desc'  => 'Route Model Binding Laravel otomatis mengambil objek <code>Ruangan</code> dari database berdasarkan <code>{ruangan}</code> di URL. Tidak perlu <code>Ruangan::find($id)</code> manual.',
        'file'  => 'app/Http/Controllers/RuanganController.php',
        'code'  => <<<'CODE'
// Route Model Binding — Laravel inject objek otomatis:
// Route: PUT /ruangan/{ruangan}
//                       ↑ Laravel: Ruangan::findOrFail($id)

public function update(UpdateRuanganRequest $request, Ruangan $ruangan)
{
    abort_if($ruangan->user_id !== auth()->id(), 403);
    $ruangan->update($request->validated());

    return redirect()->route('ruangan.index')
        ->with('success', 'Ruangan berhasil diupdate!');
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Edit Ruangan" />
        </div>
    </div>
</x-app-layout>