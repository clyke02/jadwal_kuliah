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

            @php
            $btcItems = [
    [
        'badge' => 'PHP',
        'title' => 'DosenController::update()',
        'route' => 'PUT /dosen/{id}',
        'desc'  => '<code>abort_if()</code> memverifikasi kepemilikan data sebelum update. Mencegah user A mengubah data milik user B.',
        'file'  => 'app/Http/Controllers/DosenController.php',
        'code'  => <<<'CODE'
public function update(UpdateDosenRequest $request, Dosen $dosen)
{
    abort_if($dosen->user_id !== auth()->id(), 403);
    $dosen->update($request->validated());

    Log::info('[Dosen] Diupdate', [
        'user' => auth()->user()->email,
        'id'   => $dosen->id,
    ]);

    return redirect()->route('dosen.index')
        ->with('success', 'Dosen berhasil diupdate!');
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
    ],
    [
        'badge' => 'Request',
        'title' => 'UpdateDosenRequest — ignore ID saat update',
        'route' => '',
        'desc'  => 'Saat update, rule unique harus mengabaikan record saat ini (<code>->ignore($id)</code>) agar tidak error ketika user menyimpan tanpa mengubah NIP.',
        'file'  => 'app/Http/Requests/UpdateDosenRequest.php',
        'code'  => <<<'CODE'
public function rules(): array
{
    $id = $this->route('dosen')?->id;
    return [
        'nip'  => [
            'required', 'string', 'max:20',
            Rule::unique('dosens', 'nip')
                ->where('user_id', auth()->id())
                ->ignore($id),
        ],
        'name' => ['required', 'string', 'max:255'],
    ];
}
CODE,
        'kompetensi' => ['J.620100.022.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Edit Dosen" />
        </div>
    </div>
</x-app-layout>