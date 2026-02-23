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

            @php
            $btcItems = [
    [
        'badge' => 'PHP',
        'title' => 'JadwalController::store() — Service Layer',
        'route' => 'POST /jadwal',
        'desc'  => 'Logika pengecekan konflik dipisahkan ke <code>ScheduleService</code> (Service Layer Pattern). Controller hanya bertanggung jawab menerima request dan mengembalikan response.',
        'file'  => 'app/Http/Controllers/JadwalController.php',
        'code'  => <<<'CODE'
public function store(StoreJadwalRequest $request)
{
    try {
        $jadwal = $this->scheduleService->createSchedule(
            array_merge($request->validated(), ['user_id' => auth()->id()])
        );
        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    } catch (\Exception $e) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['error' => $e->getMessage()]);
    }
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
    ],
    [
        'badge' => 'Service',
        'title' => 'ScheduleService::checkConflict() — Deteksi Bentrok',
        'route' => '',
        'desc'  => 'Konflik terjadi jika ruangan atau dosen yang sama terjadwal pada hari dan jam bertumpukan. Logika: <code>mulai A < selesai B AND selesai A > mulai B</code>.',
        'file'  => 'app/Services/ScheduleService.php',
        'code'  => <<<'CODE'
public function checkRoomConflict(
    int $userId, int $ruanganId,
    string $hari, string $jamMulai, string $jamSelesai,
    ?int $excludeId = null
): ?Jadwal {
    return Jadwal::with('ruangan')
        ->where('user_id', $userId)
        ->where('ruangan_id', $ruanganId)
        ->where('hari', $hari)
        ->where(function ($q) use ($jamMulai, $jamSelesai) {
            $q->where('jam_mulai', '<', $jamSelesai)
              ->where('jam_selesai', '>', $jamMulai);
        })
        ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
        ->first();
}
CODE,
    ],
    [
        'badge' => 'Service',
        'title' => 'ScheduleService::createSchedule() — DB Transaction',
        'route' => '',
        'desc'  => '<code>DB::transaction()</code> memastikan cek konflik dan simpan data terjadi atomik — jika ada error, semua perubahan dibatalkan (rollback).',
        'file'  => 'app/Services/ScheduleService.php',
        'code'  => <<<'CODE'
public function createSchedule(array $data): Jadwal
{
    return DB::transaction(function () use ($data) {
        $conflicts = $this->checkConflict($data);

        if (!empty($conflicts)) {
            throw new \Exception(implode(' | ', $conflicts));
        }

        return Jadwal::create($data);
    });
}
CODE,
        'kompetensi' => ['J.620100.021.02','J.620100.022.02'],
    ],
    [
        'badge' => 'SQL',
        'title' => 'Query INSERT — simpan jadwal baru',
        'route' => '',
        'desc'  => 'Sebelum INSERT, controller mengecek konflik waktu dengan <code>WHERE hari = ? AND ruangan_id = ?</code>. Jika ada overlap jam, transaksi di-rollback dan error dikembalikan ke user.',
        'file'  => '-- Dieksekusi saat JadwalController::store()',
        'code'  => <<<'CODE'
-- Cek konflik jadwal di ruangan & hari yang sama
SELECT COUNT(*) AS aggregate
FROM `jadwals`
WHERE `ruangan_id` = 2
  AND `hari` = 'Senin'
  AND `jam_mulai` < '10:00:00'
  AND `jam_selesai` > '08:00:00'
  AND `user_id` = 1;

-- Jika tidak ada konflik → INSERT
INSERT INTO `jadwals` (
    `user_id`, `dosen_id`, `mata_kuliah_id`,
    `ruangan_id`, `hari`, `jam_mulai`, `jam_selesai`,
    `created_at`, `updated_at`
) VALUES (
    1, 1, 1, 2, 'Senin',
    '08:00:00', '10:00:00', NOW(), NOW()
);
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
            ];
            @endphp
            <x-behind-the-code :items="$btcItems" page-title="Tambah Jadwal" />
        </div>
    </div>
</x-app-layout>