<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>

        @php
        $btcItems = [
            [
                'badge' => 'PHP',
                'title' => 'ProfileController::update()',
                'route' => 'PATCH /profile',
                'desc'  => 'Update nama dan email user. Jika email diubah, status <code>email_verified_at</code> di-reset ke null sehingga user perlu verifikasi ulang.',
                'file'  => 'app/Http/Controllers/ProfileController.php',
                'code'  => <<<'CODE'
public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Redirect::route('profile.edit')
        ->with('status', 'profile-updated');
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.018.02'],
            ],
            [
                'badge' => 'PHP',
                'title' => 'ProfileController::destroy() — Hapus Akun',
                'route' => 'DELETE /profile',
                'desc'  => 'Menghapus akun user beserta semua data miliknya (cascade delete dari foreign key). Wajib konfirmasi password sebelum eksekusi.',
                'file'  => 'app/Http/Controllers/ProfileController.php',
                'code'  => <<<'CODE'
public function destroy(Request $request): RedirectResponse
{
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();
    $user->delete();
    // → cascade delete: dosens, mataKuliahs,
    //   ruangans, jadwals ikut terhapus otomatis

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
}
CODE,
        'kompetensi' => ['J.620100.017.02','J.620100.022.02'],
            ],
            [
                'badge' => 'Eloquent',
                'title' => 'Cascade Delete — semua data user terhapus',
                'route' => '',
                'desc'  => 'Karena setiap tabel memiliki <code>foreignId("user_id")->onDelete("cascade")</code>, menghapus satu user otomatis menghapus semua data terkait.',
                'file'  => 'database/migrations/',
                'code'  => <<<'CODE'
// Di setiap tabel (dosens, mata_kuliahs, ruangans, jadwals):
$table->foreignId('user_id')
    ->constrained('users')
    ->onDelete('cascade');

// Saat User dihapus:
// → dosens WHERE user_id = X → DELETED
// → mata_kuliahs WHERE user_id = X → DELETED
// → ruangans WHERE user_id = X → DELETED
// → jadwals WHERE user_id = X → DELETED
CODE,
        'kompetensi' => ['J.620100.021.02','J.620100.022.02'],
            ],
            [
                'badge' => 'Auth',
                'title' => 'Password Validation — current_password rule',
                'route' => '',
                'desc'  => 'Rule <code>current_password</code> adalah validasi bawaan Laravel yang memverifikasi bahwa input cocok dengan password user yang sedang login.',
                'file'  => 'app/Http/Controllers/ProfileController.php',
                'code'  => <<<'CODE'
// Validasi: password yang diinput harus cocok
// dengan password user yang sedang login
$request->validateWithBag('userDeletion', [
    'password' => ['required', 'current_password'],
]);

// Equivalent manual:
if (!Hash::check($request->password, auth()->user()->password)) {
    throw ValidationException::withMessages([...]);
}
CODE,
        'kompetensi' => ['J.620100.022.02'],
            ],
    [
        'badge' => 'SQL',
        'title' => 'Tabel users — struktur dan relasi',
        'route' => '',
        'desc'  => 'Tabel <code>users</code> adalah pusat sistem. Semua data (dosen, matkul, ruangan, jadwal) memiliki <code>user_id</code> sebagai foreign key. Menghapus satu user otomatis menghapus semua datanya via CASCADE.',
        'file'  => '-- database/migrations/create_users_table.php',
        'code'  => <<<'CODE'
CREATE TABLE `users` (
    `id`                BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name`              VARCHAR(255) NOT NULL,
    `email`             VARCHAR(255) NOT NULL UNIQUE,
    `email_verified_at` TIMESTAMP NULL,
    `password`          VARCHAR(255) NOT NULL,  -- bcrypt hash
    `remember_token`    VARCHAR(100) NULL,
    `created_at`        TIMESTAMP NULL,
    `updated_at`        TIMESTAMP NULL
);

-- UPDATE saat ubah profil
UPDATE `users`
SET `name` = 'Budi Baru',
    `email` = 'budi@baru.ac.id',
    `email_verified_at` = NULL,  -- reset jika email berubah
    `updated_at` = NOW()
WHERE `id` = 1;

-- DELETE saat hapus akun (cascade ke semua tabel)
DELETE FROM `users` WHERE `id` = 1;
-- → otomatis menghapus dosens, mata_kuliahs,
--    ruangans, jadwals WHERE user_id = 1
CODE,
        'kompetensi' => ['J.620100.020.02','J.620100.021.02'],
    ],
        ];
        @endphp
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-8">
            <x-behind-the-code :items="$btcItems" page-title="Profile" />
        </div>
    </div>
</x-app-layout>
