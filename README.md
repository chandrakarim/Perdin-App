🧳 Aplikasi Perjalanan Dinas (Perdin)

Aplikasi ini digunakan untuk mengelola data perjalanan dinas pegawai secara digital mulai dari pengajuan, perhitungan jarak otomatis antar kota (menggunakan fungsi Helpers), hingga proses persetujuan (approve/reject) oleh bagian SDM (Sumber Daya Manusia).

Dibangun menggunakan Laravel 10, aplikasi ini dirancang dengan sistem autentikasi multi-role (Admin, SDM, Pegawai), keamanan tinggi, serta antarmuka responsif berbasis Blade Template.

🚀 Fitur Utama
👤 Role & Hak Akses

- Admin: Mengelola data pegawai dan master data kota (kota, provinsi, pulau, koordinat).

- Pegawai: Membuat dan mengajukan perjalanan dinas (Perdin).

- SDM: Melihat daftar pengajuan pending, memeriksa detail, lalu melakukan approve atau reject melalui modal interaktif.

📍 Fitur Perjalanan Dinas

Input data perjalanan:

- Kota asal dan tujuan

- Maksud perjalanan

- Tanggal mulai dan berakhir

Hitung otomatis:

- Jarak antar kota (km) menggunakan fungsi Helpers

- Durasi hari perjalanan

- Uang saku per hari dan total uang saku

- Format tanggal otomatis dengan Carbon → 12 Okt 2025 – 15 Okt 2025 (4 hari)

- Tabel data responsif dengan tampilan yang rapi dan terformat.

🧭 Manajemen Data Kota

Admin dapat menambah dan mengedit daftar kota dengan atribut:

No	Nama Kota	Provinsi	Pulau	Luar Negeri	Latitude	Longitude
1	Yogyakarta	D.I.Yogyakarta Jawa	Tidak	-7.7972	110.3688

Form input disediakan dengan tampilan ikon modern dan validasi real-time.

🧱 Keamanan

Validasi input berbasis Form Request.

Login dan autentikasi menggunakan Laravel UI dengan Bootstrap.

🧰 Teknologi yang Digunakan

Komponen	Deskripsi Framework	Laravel 10
Database	MySQL Frontend  Laravel Breeze	+ Blade Template + Bootstrap 5
Autentikasi	laravel/ui
Library Tanggal	Carbon
Icons	Boxicons + Bootstrap Icons

⚙️ Instalasi dan Konfigurasi
1. Clone Repositori
git clone https://github.com/chandrakarim/Perdin-App.git

cd perdin-app

2. Instal Dependensi
composer install
npm install && npm run dev

3. Setup Environment

Salin file .env.example menjadi .env

cp .env.example .env


Lalu sesuaikan konfigurasi database:

DB_DATABASE=perdin_db

DB_USERNAME=root

DB_PASSWORD=


4. Migrasi Database
php artisan migrate --seed


Seeder akan membuat:

Role default (Admin, SDM, Pegawai)

Contoh user dan data kota

5. Jalankan Server
php artisan serve


Akses di: http://localhost:8000

👨‍💼 Alur Penggunaan

Pegawai Login

- Membuat pengajuan perjalanan dinas.

- Memilih kota asal & tujuan (tersedia di database kota).

- Sistem menghitung otomatis jarak & uang saku.


SDM Login

- Melihat daftar pengajuan pending.

- Klik tombol Detail & Konfirmasi → membuka modal dengan detail lengkap.

- Bisa langsung Approve atau menambahkan catatan lalu Reject.

- Melihat laporan perjalanan dinas.



Admin Login

- Menambah data kota baru melalui form input.

- Mengelola user (pegawai/SDM/Admin).


# Struktur Folder Proyek Perdin Laravel

📁 **app/**
- 📁 Http/
  - 📁 Controllers/
    - 📁 Admin/
      - 📄 CityController.php
    - 📁 Pegawai/
      - 📄 PerdinController.php
    - 📁 Sdm/
      - 📄 SdmController.php
    - 📄 AdminDashboardController.php
  - 📁 Middleware/
- 📁 Models/
  - 📄 User.php
  - 📄 Perdin.php
  - 📄 City.php
- 📁 Helpers/
  - 📄 PerdinHelper.php

📁 **resources/**
- 📁 views/
  - 📁 admin/
    - 📁 data_kota/
      - 📄 create.blade.php
      - 📄 edit.blade.php
      - 📄 index.blade.php
    - 📁 data_user/
      - 📄 create.blade.php
      - 📄 edit.blade.php
      - 📄 index.blade.php
  - 📁 sdm/
    - 📄 dashboard.blade.php
    - 📄 history.blade.php
  - 📁 pegawai/
    - 📁 perdin/
      - 📄 create.blade.php
- 📁 layouts/
  - 📄 master.blade.php
  - 📄 navbar.blade.php
  - 📄 menu.blade.php
  - 📄 footer.blade.php

📁 **routes/**
- 📄 web.php

📁 **database/**
- 📁 migrations/
  - 📄 create_users_table.php
  - 📄 create_perdins_table.php
  - 📄 create_cities_table.php
- 📁 seeders/
  - 📄 CitySeeder.php
  - 📄 UserSeeder.php



📁 **public/**
- 📁 css/
- 📁 js/
- 📁 images/

📄 .env  
📄 composer.json  
📄 package.json  
📄 artisan  
📄 README.md


