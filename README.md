<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
</p>

# 🏥 Sistem Manajemen Klinik Berbasis Web
Sistem Manajemen Klinik Berbasis Web adalah perangkat lunak yang dirancang 
untuk mengelola operasional dan data klinik secara daring melalui internet. 

## ✨ Kutipan
> "Aku tidak berilmu; yang berilmu hanyalah DIA. Jika tampak ilmu dariku, itu hanyalah pantulan dari Cahaya-Nya."

---
Sistem Manajemen Klinik ini adalah sebuah aplikasi web yang dibangun menggunakan Laravel 12. Aplikasi ini dirancang untuk membantu klinik skala kecil hingga menengah di Indonesia dalam mengelola proses bisnis utama, mulai dari pendaftaran pasien, penjadwalan janji temu daring, pencatatan rekam medis, hingga proses pembayaran dan pelaporan.

Sistem ini memiliki empat hak akses (role) yang berbeda: **Admin**, **Dokter**, **Kasir/Resepsionis**, dan **Pasien**, masing-masing dengan dasbor dan fungsionalitas yang disesuaikan dengan kebutuhannya.

---
## 🎥 Demo
![Demo](./videoujicoba.gif)

## 📖 Daftar Isi
1. [Fitur Utama](#-fitur-utama)
2. [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
3. [Panduan Instalasi](#-panduan-instalasi)
4. [Akun Demo untuk Login](#-akun-demo-untuk-login)
5. [Struktur Proyek](#-struktur-proyek)
6. [Panduan Berkontribusi](#-panduan-berkontribusi)

## ✨ Fitur Utama

Berikut adalah rincian fitur yang tersedia untuk setiap peran pengguna:

#### 🧑‍⚕️ Pasien
* **Registrasi & Autentikasi**: Pasien dapat mendaftar dengan data lengkap (termasuk NIK dan alamat) dan melakukan login.
* **Booking Daring**: Alur pemesanan janji temu multi-langkah: pilih poli, pilih dokter, dan pilih jadwal yang tersedia.
* **Antrian Otomatis**: Sistem secara otomatis memberikan nomor antrian setelah booking berhasil.
* **Dasbor Pasien**: Melihat riwayat booking, status janji temu (pending, terkonfirmasi, selesai), dan melihat detail rekam medis dari kunjungan sebelumnya.

#### ✒️ Resepsionis / Kasir
* **Dasbor Antrian**: Melihat daftar seluruh pasien yang memiliki janji temu pada hari ini.
* **Konfirmasi Kedatangan**: Mengubah status pasien dari `pending` menjadi `confirmed` saat mereka tiba di klinik.
* **Proses Pembayaran**: Menginput biaya konsultasi dan obat untuk pasien yang telah selesai diperiksa.
* **Cetak Kwitansi**: Menghasilkan halaman kwitansi yang siap cetak untuk setiap transaksi pembayaran.

#### 🩺 Dokter
* **Dasbor Dokter**: Melihat daftar antrian pasien yang sudah dikonfirmasi dan siap untuk diperiksa.
* **Pencatatan Rekam Medis**: Menginput data rekam medis sederhana yang meliputi keluhan, diagnosa, dan resep/tindakan.
* **Penyelesaian Konsultasi**: Mengubah status pasien menjadi `completed` setelah rekam medis disimpan.

#### 👑 Admin
* **Manajemen Data Master**: Kemampuan untuk menambah, melihat, mengubah, dan menghapus (CRUD) data Poli, Dokter, dan Jadwal Praktik Dokter.
* **Dasbor Statistik**: Melihat ringkasan data penting seperti pendapatan hari ini, jumlah kunjungan pasien hari ini, dan total booking yang masih `pending`.
* **Laporan Klinik**: Mengakses halaman laporan pendapatan dan laporan kunjungan pasien dengan filter per bulan dan tahun.

---

## 🛠️ Teknologi yang Digunakan

* **Backend**: PHP 8.2, Laravel Framework 12
* **Frontend**: Laravel Blade, Tailwind CSS, Alpine.js
* **Database**: MySQL / MariaDB
* **Autentikasi**: Laravel Breeze
* **Manajemen Dependensi**: Composer (PHP), NPM (JavaScript)

---

## 🚀 Panduan Instalasi

Bagian ini memuat tiga skenario instalasi: untuk pengembangan lokal, deployment ke server VPS (atau shared hosting dengan SSH), dan deployment ke shared hosting tanpa SSH (via cPanel).

---

### A. Instalasi di Komputer Lokal (Untuk Pengembangan)

Langkah-langkah ini ditujukan untuk menyiapkan lingkungan pengembangan di mesin Anda sendiri.

#### Prasyarat
- PHP 8.2+, Composer, Node.js 20+, Server Database (MySQL/MariaDB), Git.

#### Langkah-langkah Instalasi
1.  **Clone Repositori**: `git clone https://github.com/Alghifari888/Manajemen-Klinik.git` dan `cd Manajemen-Klinik`.
2.  **Instal Dependensi**: Jalankan `composer install` dan `npm install`.
3.  **Konfigurasi .env**: Salin `.env.example` ke `.env` (`cp .env.example .env`).
4.  **Generate Kunci**: Jalankan `php artisan key:generate`.
5.  **Setup Database**: Buat database `db_klinik` dan sesuaikan kredensial di file `.env`.
6.  **Migrasi & Seeder**: Jalankan `php artisan migrate:fresh --seed` untuk membuat tabel dan mengisi data awal.
7.  **Jalankan Server**: Buka dua terminal. Di satu terminal, jalankan `npm run dev`. Di terminal lain, jalankan `php artisan serve`.
8.  **Akses Aplikasi**: Buka `http://127.0.0.1:8000` di browser Anda.

---

### B. Deployment ke Server VPS / Shared Hosting (Dengan Akses SSH)

Panduan ini untuk server yang memberikan Anda akses terminal/SSH.

1.  **Clone Repositori**: Hubungkan via SSH, `cd` ke direktori web Anda, lalu `git clone ...`.
2.  **Konfigurasi .env Produksi**:
    - `cp .env.example .env`
    - Edit file `.env`: set `APP_ENV=production`, `APP_DEBUG=false`, dan isi detail database produksi.
    - Jalankan `php artisan key:generate`.
3.  **Install Dependensi Produksi**:
    - `composer install --optimize-autoloader --no-dev`
    - `npm install`
    - `npm run build`
4.  **Migrasi & Optimasi**:
    - `php artisan migrate:fresh --seed --force` (gunakan `--seed` hanya jika butuh data awal).
    - `php artisan config:cache`
    - `php artisan route:cache`
    - `php artisan view:cache`
5.  **Konfigurasi Web Server**: Arahkan *Document Root* ke folder `/public` proyek Anda untuk keamanan.
6.  **Atur Hak Akses**: `sudo chown -R www-data:www-data storage bootstrap/cache` dan `sudo chmod -R 775 storage bootstrap/cache`.
7.  **Symbolic Link**: `php artisan storage:link`. (Jika ada fitur upload file).

---

### C. Deployment ke Shared Hosting (via cPanel / Tanpa SSH)

Metode ini bersifat manual jika tidak ada akses terminal.

1.  **Persiapan di Lokal**:
    - Jalankan `composer install --optimize-autoloader --no-dev` dan `npm run build`.
    - Hapus folder `node_modules`.
    - Kompres semua file proyek (termasuk folder `vendor`) ke dalam satu file `.zip`.

2.  **Unggah & Ekstrak di cPanel**:
    - Login ke cPanel, buka `File Manager`, masuk ke `public_html`.
    - `Upload` dan `Extract` file `.zip` Anda ke dalam sebuah folder (misal: `manajemen-klinik`).

3.  **Atur Struktur Folder**:
    - Pindahkan semua isi dari `manajemen-klinik/public` ke `public_html`.
    - Edit file `public_html/index.php`, ubah path-nya:
      ```php
      // Ganti 'manajemen-klinik' dengan nama folder Anda
      require __DIR__.'/manajemen-klinik/vendor/autoload.php';
      $app = require_once __DIR__.'/manajemen-klinik/bootstrap/app.php';
      ```

4.  **Setup Database**:
    - Gunakan `MySQL Database Wizard` di cPanel untuk membuat database, user, dan password.
    - Ekspor database lokal Anda ke file `.sql`.
    - Impor file `.sql` tersebut ke database baru melalui `phpMyAdmin` di cPanel.

5.  **Konfigurasi Final**:
    - Edit file `.env` di dalam folder `manajemen-klinik`.
    - Atur `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://domainanda.com`.
    - Masukkan detail koneksi database dari cPanel.

---

## 🔑 Akun Demo untuk Login
Setelah instalasi dan seeding berhasil, Anda dapat login menggunakan akun berikut:

| Peran      | Email                | Password |
| :--------- | :------------------- | :------- |
| **Admin** | `admin@klinik.com`   | `password` |
| **Dokter** | `dokter@klinik.com`  | `password` |
| **Kasir** | `kasir@klinik.com`   | `password` |
| **Pasien** | `pasien@klinik.com`  | `password` |

---

## 📁 Struktur Proyek

Berikut adalah gambaran umum struktur folder dan berkas penting dalam proyek ini:

```
klinik-manajemen/
├── app/
│   ├── Enums/                  # Berisi Enum untuk UserRole
│   ├── Http/
│   │   ├── Controllers/        # Lokasi semua Controller
│   │   │   ├── Admin/          # Controller khusus untuk modul Admin
│   │   │   ├── Dokter/         # Controller khusus untuk modul Dokter
│   │   │   ├── Kasir/          # Controller khusus untuk modul Kasir
│   │   │   └── Pasien/         # Controller khusus untuk modul Pasien
│   │   └── Middleware/         # Berisi middleware kustom (misal: RoleMiddleware)
│   └── Models/                 # Berisi semua model Eloquent
├── bootstrap/
├── config/
├── database/
│   ├── migrations/             # Berisi skema struktur tabel basis data
│   └── seeders/                # Berisi berkas untuk mengisi data awal
├── public/                     # Folder root untuk web server
├── resources/
│   └── views/                  # Lokasi semua berkas tampilan (Blade)
├── routes/
│   └── web.php                 # Definisi semua rute utama aplikasi
└── .env                        # Berkas konfigurasi environment
```

---

## 🤝 Panduan Berkontribusi

Kami sangat terbuka untuk kontribusi dari komunitas.

### Melalui Fork (Untuk Non-Kolaborator)

1.  **Fork Repositori**: Klik tombol "Fork" di pojok kanan atas.
2.  **Clone Fork Anda**: `git clone https://github.com/NAMA_ANDA/Manajemen-Klinik.git`
3.  **Buat Branch Baru**: `git checkout -b nama-fitur-baru`
4.  **Lakukan Perubahan**, lalu `commit` dan `push` ke branch Anda.
5.  **Buat Pull Request** dari fork Anda ke repositori ini.

### Pedoman Kontribusi

* **Gaya Pesan Commit**: Gunakan format *Conventional Commits* (`feat:`, `fix:`, `docs:`, dll).
* **Gaya Kode**: Ikuti standar PSR-12 untuk PHP.
* **Fokus**: Usahakan setiap Pull Request hanya fokus pada satu fitur atau perbaikan.

Terima kasih telah berkontribusi!

## 📄 License (English)

This project is licensed under the MIT License.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.

---

## 📄 Lisensi (Bahasa Indonesia)

Proyek ini dilisensikan di bawah Lisensi MIT.

Hak Cipta (c) 2025 Alghifari888

Dengan ini diberikan izin, secara gratis, kepada siapa pun yang memperoleh salinan
perangkat lunak dan file dokumentasi terkait (selanjutnya disebut "Perangkat Lunak"), untuk menggunakan
Perangkat Lunak tanpa batasan, termasuk namun tidak terbatas pada hak untuk menggunakan, menyalin,
memodifikasi, menggabungkan, menerbitkan, mendistribusikan, mensublisensikan, dan/atau menjual
salinan Perangkat Lunak, dengan ketentuan sebagai berikut:

Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam semua
salinan atau bagian substansial dari Perangkat Lunak.

PERANGKAT LUNAK INI DIBERIKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT
MAUPUN TERSIRAT, TERMASUK NAMUN TIDAK TERBATAS PADA JAMINAN DAYA JUAL,
KECOCOKAN UNTUK TUJUAN TERTENTU, DAN TIDAK PELANGGARAN HAK PIHAK LAIN.
