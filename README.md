# Sistem Manajemen Klinik Berbasis Web
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## ✨ Kutipan
> "Aku tidak berilmu; yang berilmu hanyalah DIA. Jika tampak ilmu dariku, itu hanyalah pantulan dari Cahaya-Nya."

Sistem Manajemen Klinik ini adalah sebuah aplikasi web yang dibangun menggunakan Laravel 12. Aplikasi ini dirancang untuk membantu klinik skala kecil hingga menengah di Indonesia dalam mengelola proses bisnis utama, mulai dari pendaftaran pasien, penjadwalan janji temu daring, pencatatan rekam medis, hingga proses pembayaran dan pelaporan.

Sistem ini memiliki empat hak akses (role) yang berbeda: **Admin**, **Dokter**, **Kasir/Resepsionis**, dan **Pasien**, masing-masing dengan dasbor dan fungsionalitas yang disesuaikan dengan kebutuhannya.

---

## Fitur Utama

Berikut adalah rincian fitur yang tersedia untuk setiap peran pengguna:

#### 🧑‍⚕️ Pasien
* **Registrasi & Autentikasi**: Pasien dapat mendaftar dengan data lengkap (termasuk NIK dan alamat) dan melakukan login.
* **Booking Daring**: Alur pemesanan janji temu multi-langkah: pilih poli, pilih dokter, dan pilih jadwal yang tersedia.
* **Antrian Otomatis**: Sistem secara otomatis memberikan nomor antrian setelah booking berhasil.
* **Dasbor Pasien**: Melihat riwayat booking, status janji temu (pending, terkonfirmasi, selesai), dan melihat detail rekam medis dari kunjungan sebelumnya.

####  reception️ Resepsionis / Kasir
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

## Teknologi yang Digunakan

* **Backend**: PHP 8.2, Laravel Framework 12
* **Frontend**: Laravel Blade, Tailwind CSS, Alpine.js
* **Database**: MySQL / MariaDB
* **Autentikasi**: Laravel Breeze
* **Manajemen Dependensi**: Composer (PHP), NPM (JavaScript)

---

## Spesifikasi Sistem

Berikut adalah spesifikasi minimal yang dibutuhkan untuk menjalankan aplikasi ini di lingkungan lokal maupun produksi.

| Kebutuhan    | Spesifikasi Minimal       |
| :----------- | :------------------------ |
| PHP          | 8.2 atau lebih tinggi     |
| Database     | MySQL 8.0+ / MariaDB 10.6+ |
| Composer     | Versi 2.x                 |
| Node.js      | Versi 20.x (LTS) atau lebih tinggi |
| Web Server   | Nginx / Apache            |

---

## Panduan Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone Repositori**
    Buka terminal Anda dan jalankan perintah berikut:
    ```bash
    git clone [https://github.com/Alghifari888/Manajemen-Klinik.git](https://github.com/Alghifari888/Manajemen-Klinik.git)
    cd Manajemen-Klinik
    ```

2.  **Instal Dependensi PHP**
    Jalankan Composer untuk menginstal semua pustaka (library) PHP yang dibutuhkan.
    ```bash
    composer install
    ```

3.  **Instal Dependensi JavaScript**
    Jalankan NPM untuk menginstal semua pustaka JavaScript.
    ```bash
    npm install
    ```

4.  **Siapkan Berkas Environment**
    Salin berkas `.env.example` menjadi `.env`. Di sinilah semua konfigurasi proyek Anda disimpan.
    ```bash
    cp .env.example .env
    ```

5.  **Hasilkan Kunci Aplikasi (App Key)**
    Kunci ini penting untuk keamanan enkripsi Laravel.
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi Database**
    Buka berkas `.env` dan sesuaikan pengaturan basis data berikut dengan konfigurasi lokal Anda:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_klinik
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    Pastikan Anda sudah membuat sebuah basis data kosong dengan nama `db_klinik` (atau nama lain sesuai konfigurasi Anda).

7.  **Jalankan Migrasi dan Seeder**
    Perintah ini akan membuat semua tabel di basis data dan mengisinya dengan data awal (data admin, dokter, kasir, pasien, dan poli).
    ```bash
    php artisan migrate:fresh --seed
    ```

8.  **Compile Aset Frontend**
    Jalankan perintah ini untuk meng-compile berkas CSS dan JavaScript.
    ```bash
    npm run dev
    ```

9.  **Jalankan Server Pengembangan**
    Aplikasi Anda sekarang siap dijalankan.
    ```bash
    php artisan serve
    ```
    Buka `http://127.0.0.1:8000` di peramban (browser) Anda.

---

## Struktur Proyek

Berikut adalah gambaran umum struktur folder dan berkas penting dalam proyek ini:

```
klinik-manajemen/
├── app/
│   ├── Enums/                  # Berisi Enum untuk UserRole
│   ├── Http/
│   │   ├── Controllers/        # Lokasi semua Controller
│   │   │   ├── Admin/          # Controller khusus untuk modul Admin
│   │   │   ├── Auth/           # Controller untuk autentikasi (dari Breeze)
│   │   │   ├── Dokter/         # Controller khusus untuk modul Dokter
│   │   │   ├── Kasir/          # Controller khusus untuk modul Kasir
│   │   │   └── Pasien/         # Controller khusus untuk modul Pasien
│   │   └── Middleware/         # Berisi middleware kustom (misal: RoleMiddleware)
│   └── Models/                 # Berisi semua model Eloquent (User, Booking, Doctor, dll.)
├── bootstrap/
│   └── app.php                 # Titik pusat konfigurasi aplikasi (termasuk pendaftaran middleware)
├── config/                     # Berkas-berkas konfigurasi Laravel
├── database/
│   ├── factories/
│   ├── migrations/             # Berisi skema struktur tabel basis data
│   └── seeders/                # Berisi berkas untuk mengisi data awal ke basis data
├── public/                     # Folder root untuk web server (berisi index.php, aset CSS/JS)
├── resources/
│   ├── css/
│   ├── js/
│   └── views/                  # Lokasi semua berkas tampilan (Blade)
│       ├── admin/
│       ├── auth/
│       ├── dokter/
│       ├── kasir/
│       ├── layouts/            # Berisi layout utama dan navigasi
│       └── pasien/
├── routes/
│   ├── web.php                 # Definisi semua rute utama aplikasi
│   └── auth.php                # Rute khusus untuk autentikasi (dari Breeze)
├── .env                        # Berkas konfigurasi environment (TIDAK BOLEH MASUK KE GIT)
└── composer.json               # Daftar dependensi PHP
```

---

## Panduan Berkontribusi

Kami sangat terbuka untuk kontribusi dari komunitas. Terdapat dua cara utama untuk berkontribusi, tergantung pada hak akses Anda.

### Melalui Fork (Untuk Non-Kolaborator)

Ini adalah alur standar untuk berkontribusi pada proyek sumber terbuka (open-source) di GitHub.

1.  **Fork Repositori**: Klik tombol "Fork" di pojok kanan atas halaman repositori ini. Ini akan membuat salinan repositori di bawah akun Anda.
2.  **Clone Fork Anda**: Lakukan clone pada repositori yang telah Anda *fork* ke mesin lokal Anda.
    ```bash
    git clone [https://github.com/NAMA_ANDA/Manajemen-Klinik.git](https://github.com/NAMA_ANDA/Manajemen-Klinik.git)
    ```
3.  **Buat Branch Baru**: Buat sebuah *branch* baru untuk mengerjakan fitur atau perbaikan Anda.
    ```bash
    git checkout -b nama-fitur-baru
    ```
4.  **Lakukan Perubahan**: Buat perubahan atau tambahkan fitur baru pada kode.
5.  **Commit & Push**: Lakukan *commit* pada perubahan Anda dan *push* ke repositori *fork* Anda.
    ```bash
    git add .
    git commit -m "feat: Menambahkan fitur X"
    git push origin nama-fitur-baru
    ```
6.  **Buat Pull Request**: Kembali ke halaman repositori *fork* Anda di GitHub dan klik tombol "New Pull Request". Jelaskan perubahan yang Anda buat secara detail.

### Sebagai Kolaborator

Jika Anda memiliki akses tulis langsung ke repositori ini:

1.  **Clone Repositori Utama**: Lakukan clone pada repositori utama.
2.  **Buat Branch Baru**: **Selalu** bekerja di dalam *branch* baru, jangan pernah langsung melakukan *commit* ke `main` atau `master`.
    ```bash
    git checkout -b nama-fitur-atau-perbaikan
    ```
3.  **Lakukan Perubahan, Commit, & Push**: Setelah selesai, *push branch* Anda ke repositori utama.
    ```bash
    git push origin nama-fitur-atau-perbaikan
    ```
4.  **Buat Pull Request**: Buat *Pull Request* dari *branch* Anda ke *branch* `main` untuk proses peninjauan kode (*code review*).

---

## Pedoman Kontribusi

Untuk menjaga kualitas dan konsistensi kode, harap ikuti pedoman berikut:

* **Gaya Pesan Commit**: Gunakan format *Conventional Commits*. Awali pesan *commit* Anda dengan tipe perubahan, contoh:
    * `feat:` untuk penambahan fitur baru.
    * `fix:` untuk perbaikan *bug*.
    * `docs:` untuk perubahan dokumentasi.
    * `style:` untuk perbaikan format kode.
    * `refactor:` untuk perubahan kode yang tidak menambah fitur atau memperbaiki *bug*.
* **Gaya Kode**: Ikuti standar PSR-12 untuk gaya penulisan kode PHP.
* **Satu Perubahan per Pull Request**: Usahakan setiap *Pull Request* hanya fokus pada satu fitur atau satu perbaikan agar mudah untuk ditinjau.
* **Jelaskan Perubahan Anda**: Berikan deskripsi yang jelas pada *Pull Request* mengenai apa yang Anda ubah dan mengapa.
