# 📅 Sistem Manajemen Jadwal Kuliah

Aplikasi web berbasis **Laravel**, **Blade**, dan **Tailwind CSS** untuk mengelola jadwal perkuliahan dengan validasi konflik ruangan dan dosen berbasis interval waktu.

Project ini dikembangkan sebagai implementasi kompetensi:
- Pemrograman Berorientasi Objek (OOP)
- Penggunaan SQL & Relasi Database
- Penerapan Arsitektur MVC
- Implementasi Algoritma
- Validasi & Error Handling
- Optimasi Query Database
- Clean Code & Best Practice Laravel

---

## 🎯 Latar Belakang

Permasalahan umum dalam pengelolaan jadwal kuliah:

- Terjadi bentrok ruangan
- Dosen mengajar di waktu yang sama
- Data tidak terstruktur
- Validasi manual yang rawan kesalahan

Aplikasi ini dirancang untuk menyelesaikan permasalahan tersebut dengan pendekatan sistematis dan berbasis constraint database serta algoritma interval waktu.

---

## 🛠️ Tech Stack

- Laravel (PHP Framework)
- Blade Template Engine
- Tailwind CSS
- MySQL
- Laravel Breeze (Authentication)
- Eloquent ORM

---

## 🧠 Arsitektur Sistem

Aplikasi mengikuti prinsip **Separation of Concerns**:

User Request  
→ Route  
→ Controller (koordinasi)  
→ Form Request (validasi input)  
→ Service Layer (logika bisnis)  
→ Model (Eloquent ORM)  
→ Database  

Logika bisnis (validasi konflik) dipisahkan dari Controller agar kode lebih bersih, modular, dan mudah diuji.

---

## 🗃️ Struktur Database

### Tabel `users`
- id
- name
- email
- password
- role (admin / dosen)

### Tabel `dosens`
- id
- name
- nip

### Tabel `mata_kuliahs`
- id
- kode_mk
- nama
- sks

### Tabel `ruangans`
- id
- nama
- kapasitas

### Tabel `jadwals`
- id
- mata_kuliah_id (foreign key)
- dosen_id (foreign key)
- ruangan_id (foreign key)
- hari (enum: Senin–Jumat)
- jam_mulai (time)
- jam_selesai (time)

Semua relasi dijaga menggunakan foreign key constraint untuk menjaga integritas data.

---

## ⚙️ Algoritma Validasi Konflik Jadwal

Sistem memastikan:

1. Tidak ada dua jadwal dengan ruangan yang sama pada waktu yang bertabrakan.
2. Tidak ada dosen yang mengajar pada dua kelas dengan waktu yang bertabrakan.

Rumus interval overlap yang digunakan:
jam_mulai_baru < jam_selesai_lama
AND
jam_selesai_baru > jam_mulai_lama
Logika ini diimplementasikan dalam `ScheduleService` dan dijalankan sebelum proses penyimpanan data menggunakan database transaction untuk menjaga konsistensi.

---

## ✨ Fitur Utama

### 🔐 Authentication
- Login
- Logout
- Role-based access control

### 📊 Dashboard
- Total dosen
- Total mata kuliah
- Total ruangan
- Total jadwal aktif

### 📚 Data Master
- CRUD Dosen
- CRUD Mata Kuliah
- CRUD Ruangan

### 🗓 Manajemen Jadwal
- Tambah jadwal
- Edit jadwal
- Hapus jadwal
- Validasi konflik otomatis
- Tampilan list view
- Tampilan jadwal mingguan

---

## 📈 Optimasi yang Diterapkan

- Eager loading untuk mencegah N+1 query
- Database transaction saat menyimpan jadwal
- Form Request validation
- Mass assignment protection (`$fillable`)
- Enum untuk konsistensi data hari
- Foreign key constraint untuk integritas relasi

---

## 🚀 Instalasi & Menjalankan Project

1. Clone repository
    git clone https://github.com/clyke02/jadwal_kuliah.git
    cd jadwal_kuliah

2. Install dependency
    composer install
    npm install

3. Setup environment
    cp .env.example .env
    php artisan key:generate


4. Konfigurasi database pada file `.env`
5. Jalankan migrasi database
    php artisan migrate --seed

6. Build assets
    npm run dev

7. Jalankan server
   php artisan serve


Akses aplikasi melalui:
http://127.0.0.1:8000

---

## 🧪 Testing & Debugging

- Validasi input menggunakan FormRequest
- Logging menggunakan Laravel Log
- Error handling untuk konflik jadwal
- Pengujian manual untuk edge case waktu

---

## 📸 Screenshot

Tambahkan screenshot berikut untuk memperkuat portofolio:
- Dashboard
- Form Tambah Jadwal
- List Jadwal
- Tampilan Jadwal Mingguan

---

## 🔮 Pengembangan Selanjutnya

- Unit Testing untuk ScheduleService
- Notifikasi perubahan jadwal
- Export jadwal ke PDF
- REST API endpoint
- Role mahasiswa

---

## 👤 Author

Nama: Clyke  
GitHub: https://github.com/clyke02  

---

## 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan portofolio.
