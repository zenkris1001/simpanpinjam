# Aplikasi Pembiayaan

Aplikasi web internal untuk mencatat dan mengelola pengajuan pembiayaan nasabah.

## Fitur

* Dashboard statistik pengajuan
* Tambah pengajuan nasabah
* Daftar pengajuan
* Pencarian nama nasabah
* Filter berdasarkan status
* Detail pengajuan
* Perhitungan cicilan per bulan
* Persetujuan pengajuan
* Penolakan pengajuan
* Status Lunas
* Pagination daftar pengajuan
* Validasi pengajuan

## Teknologi

* Laravel 12
* PHP 8.2+
* MySQL
* Tailwind CSS
* Vite

## Persyaratan

Pastikan komputer sudah terinstall:

* XAMPP
* PHP 8.2 atau lebih baru
* Composer
* Node.js dan NPM

## Cara Menjalankan di Localhost

### 1. Extract Project

Extract file ZIP ke folder:

```text
C:\xampp\htdocs\
```

Contoh:

```text
C:\xampp\htdocs\pembiayaan-app
```

### 2. Buka Terminal

Masuk ke folder project:

```bash
cd C:\xampp\htdocs\pembiayaan-app
```

### 3. Install Dependency Laravel

Jalankan:

```bash
composer install
```

### 4. Install Dependency Frontend

Jalankan:

```bash
npm install
```

### 5. Buat File Environment

Copy file `.env.example` menjadi `.env`.

Windows:

```bash
copy .env.example .env
```

Kemudian buka file `.env` dan sesuaikan database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_pembiayaan
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Buat Database

Buka XAMPP dan aktifkan:

* Apache
* MySQL

Kemudian buka phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Buat database baru dengan nama:

```text
db_pembiayaan
```

### 7. Generate Application Key

Jalankan:

```bash
php artisan key:generate
```

### 8. Jalankan Migration

Jalankan:

```bash
php artisan migrate
```

Perintah ini akan membuat tabel database yang dibutuhkan aplikasi.

### 9. Jalankan Laravel

Buka terminal pertama:

```bash
php artisan serve
```

Biasanya aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

atau:

```text
http://localhost:8000
```

### 10. Jalankan Vite

Buka terminal kedua pada folder project:

```bash
npm run dev
```

Biarkan terminal ini tetap berjalan selama aplikasi digunakan.

## Akses Aplikasi

Setelah Laravel dan Vite berjalan, buka browser:

```text
http://127.0.0.1:8000
```

## Aturan Pengajuan

Aplikasi memiliki beberapa aturan:

* Pendapatan bulanan minimal Rp1.000.000
* Nominal maksimal pengajuan Rp200.000.000
* Tenor maksimal 24 bulan
* Maksimal 3 pengajuan untuk satu nama nasabah
* Pengajuan dimulai dengan status Pending
* Pengajuan Pending dapat disetujui atau ditolak
* Pengajuan yang sudah disetujui dapat ditandai Lunas
* Pengajuan Lunas tetap tersimpan tetapi tidak dihitung dalam total pengajuan Dashboard

## Perhitungan Cicilan

Cicilan per bulan dihitung dengan rumus:

```text
Nominal Pengajuan ÷ Tenor
```

Contoh:

```text
Rp24.000.000 ÷ 24 bulan
= Rp1.000.000 per bulan
```

Perhitungan ini tidak menggunakan bunga karena tidak terdapat ketentuan bunga pada spesifikasi aplikasi.

## Struktur Utama

```text
app/
├── Http/Controllers/
│   ├── ApplicationController.php
│   └── DashboardController.php
│
├── Models/
│   └── Application.php
│
resources/views/
├── layouts/
│   └── app.blade.php
├── dashboard.blade.php
└── applications/
    ├── index.blade.php
    ├── create.blade.php
    └── show.blade.php

routes/
└── web.php

database/
└── migrations/
```

## Catatan

Jika terjadi perubahan database setelah migration, gunakan:

```bash
php artisan migrate
```

Jika tampilan CSS tidak muncul, pastikan Vite sedang berjalan:

```bash
npm run dev
```

Jika ingin menghentikan server, tekan:

```text
Ctrl + C
```
# simpanpinjamsimple
# simpanpinjamsimple_
# simpanpinjamsimple_
# simpanpinjamsimple_
# simpanpinjamsimple_
