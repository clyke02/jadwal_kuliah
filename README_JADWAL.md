# Sistem Manajemen Jadwal Kuliah

Aplikasi web untuk mengelola jadwal perkuliahan dengan validasi konflik ruangan dan konflik dosen berdasarkan waktu.

## Tech Stack

- **Framework**: Laravel 11
- **Templating**: Blade
- **Styling**: Tailwind CSS
- **Authentication**: Laravel Breeze
- **Database**: MySQL
- **ORM**: Eloquent

## Fitur Utama

### 1. Authentication
- Login & Logout
- Role-based access (Admin & Dosen)
- Menggunakan Laravel Breeze

### 2. Dashboard
Menampilkan statistik:
- Total Dosen
- Total Mata Kuliah
- Total Ruangan
- Total Jadwal

### 3. CRUD Data Master
- **Dosen**: Kelola data dosen (NIP, Nama)
- **Mata Kuliah**: Kelola data mata kuliah (Kode MK, Nama, SKS)
- **Ruangan**: Kelola data ruangan (Nama, Kapasitas)

### 4. CRUD Jadwal
Kelola jadwal perkuliahan dengan field:
- Mata Kuliah
- Dosen
- Ruangan
- Hari (Senin-Jumat)
- Jam Mulai
- Jam Selesai

## Logika Bisnis

### Validasi Konflik Jadwal

Sistem akan otomatis mengecek konflik saat menambah atau mengupdate jadwal:

#### 1. Konflik Ruangan
Tidak boleh ada jadwal lain yang menggunakan:
- Ruangan yang sama
- Hari yang sama
- Waktu yang overlap

#### 2. Konflik Dosen
Tidak boleh ada jadwal lain dimana dosen:
- Dosen yang sama
- Hari yang sama
- Waktu yang overlap

#### Rumus Interval Overlap
```php
jam_mulai_baru < jam_selesai_lama AND jam_selesai_baru > jam_mulai_lama
```

Logika konflik diimplementasikan dalam **ScheduleService** dengan menggunakan **DB Transaction**.

## Struktur Project

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── DashboardController.php
│   │   ├── DosenController.php
│   │   ├── MataKuliahController.php
│   │   ├── RuanganController.php
│   │   └── JadwalController.php
│   └── Requests/
│       ├── StoreDosenRequest.php
│       ├── UpdateDosenRequest.php
│       ├── StoreMataKuliahRequest.php
│       ├── UpdateMataKuliahRequest.php
│       ├── StoreRuanganRequest.php
│       ├── UpdateRuanganRequest.php
│       ├── StoreJadwalRequest.php
│       └── UpdateJadwalRequest.php
├── Models/
│   ├── User.php
│   ├── Dosen.php
│   ├── MataKuliah.php
│   ├── Ruangan.php
│   └── Jadwal.php
└── Services/
    └── ScheduleService.php

database/
├── migrations/
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 2026_02_21_090406_create_dosens_table.php
│   ├── 2026_02_21_090407_create_mata_kuliahs_table.php
│   ├── 2026_02_21_090408_create_ruangans_table.php
│   └── 2026_02_21_090409_create_jadwals_table.php
└── seeders/
    └── DatabaseSeeder.php

resources/views/
├── layouts/
│   ├── app.blade.php
│   └── navigation.blade.php
├── dashboard.blade.php
├── dosen/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── mata-kuliah/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── ruangan/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
└── jadwal/
    ├── index.blade.php
    ├── create.blade.php
    └── edit.blade.php
```

## Database Schema

### Tabel `users`
- id
- name
- email (unique)
- password
- role (enum: admin, dosen)
- timestamps

### Tabel `dosens`
- id
- nip (unique)
- name
- timestamps

### Tabel `mata_kuliahs`
- id
- kode_mk (unique)
- nama
- sks
- timestamps

### Tabel `ruangans`
- id
- nama (unique)
- kapasitas
- timestamps

### Tabel `jadwals`
- id
- mata_kuliah_id (foreign key → mata_kuliahs)
- dosen_id (foreign key → dosens)
- ruangan_id (foreign key → ruangans)
- hari (enum: Senin, Selasa, Rabu, Kamis, Jumat)
- jam_mulai (time)
- jam_selesai (time)
- timestamps

## Instalasi

### Requirements
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Langkah Instalasi

1. **Clone atau masuk ke direktori project**
```bash
cd jadwal-kuliah
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi database di file `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jadwal_kuliah
DB_USERNAME=root
DB_PASSWORD=
```

5. **Buat database**
```sql
CREATE DATABASE jadwal_kuliah;
```

6. **Jalankan migration dan seeder**
```bash
php artisan migrate --seed
```

7. **Build assets**
```bash
npm run build
```

8. **Jalankan server**
```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://localhost:8000`

## Login Credentials

### Admin
- Email: `admin@jadwal.test`
- Password: `password`

### Dosen
- Email: `dosen@jadwal.test`
- Password: `password`

## Best Practices yang Diimplementasikan

### 1. Service Layer Pattern
Logika bisnis untuk konflik jadwal dipisahkan ke `ScheduleService` untuk:
- Separation of Concerns
- Reusability
- Testability

### 2. Form Request Validation
Validasi input menggunakan Form Request untuk:
- Clean Controller
- Reusable validation rules
- Automatic error handling

### 3. Eloquent Relationships
Relasi antar model didefinisikan dengan jelas:
- `hasMany` untuk one-to-many
- `belongsTo` untuk inverse relationship

### 4. Eager Loading
Mencegah N+1 problem dengan menggunakan `with()`:
```php
$jadwals = Jadwal::with(['mataKuliah', 'dosen', 'ruangan'])->get();
```

### 5. Database Transaction
Menggunakan DB Transaction untuk operasi kritis:
```php
DB::transaction(function () use ($data) {
    // Check conflicts
    // Create schedule
});
```

### 6. Foreign Key Constraints
Semua foreign key memiliki constraint untuk referential integrity:
```php
$table->foreignId('dosen_id')->constrained('dosens')->onDelete('cascade');
```

### 7. Resource Controllers
Menggunakan resource controllers untuk CRUD standar:
```php
Route::resource('jadwal', JadwalController::class);
```

## Contoh Penggunaan

### Tambah Jadwal dengan Validasi Konflik

```php
// JadwalController@store
public function store(StoreJadwalRequest $request)
{
    try {
        $this->scheduleService->createSchedule($request->validated());
        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    } catch (\Exception $e) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['error' => $e->getMessage()]);
    }
}
```

### Service Layer dengan Eager Loading

```php
// ScheduleService@checkRoomConflict
public function checkRoomConflict(...)
{
    return Jadwal::with('ruangan')
        ->where('ruangan_id', $ruanganId)
        ->where('hari', $hari)
        ->where(function ($q) use ($jamMulai, $jamSelesai) {
            $q->where('jam_mulai', '<', $jamSelesai)
              ->where('jam_selesai', '>', $jamMulai);
        })
        ->first();
}
```

## Testing

Untuk menguji validasi konflik:

1. Buat jadwal pertama: IF101, Senin, 08:00-10:00, R.101
2. Coba buat jadwal kedua dengan:
   - Ruangan sama (R.101), hari sama (Senin), jam overlap (09:00-11:00)
   - Sistem akan menolak dan menampilkan pesan error

## Troubleshooting

### Error: "could not find driver"
Install ekstensi PDO MySQL di PHP

### Error: "Access denied for user"
Periksa kredensial database di file `.env`

### Error: "Class not found"
Jalankan: `composer dump-autoload`

### Assets tidak muncul
Jalankan: `npm run build`

## Lisensi

MIT License

## Kontak

Untuk pertanyaan atau kontribusi, silakan hubungi developer.

---

**Note**: Aplikasi ini dibuat sebagai portfolio project untuk demonstrasi kemampuan OOP, SQL, Laravel best practices, dan clean architecture.
