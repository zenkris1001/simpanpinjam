# Aplikasi Pembiayaan

Aplikasi web internal untuk mencatat dan mengelola pengajuan pembiayaan nasabah.

## Teknologi

* Laravel 12
* PHP 8.2+
* MySQL
* Tailwind CSS
* Vite

## Cara Menjalankan Aplikasi

### 1. Extract Project

Extract file ZIP ke:

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

### 3. Install Laravel

Jalankan:

```bash
composer install
```

### 4. Install Vite

Jalankan:

```bash
npm install
```

### 5. Atur File `.env`

Copy `.env.example` menjadi `.env`:

```bash
copy .env.example .env
```

Kemudian buka file `.env` dan isi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_pembiayaan
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Buat Database

Buka XAMPP, lalu nyalakan:

* Apache
* MySQL

Kemudian buka:

```text
http://localhost/phpmyadmin
```

Buat database dengan nama:

```text
db_pembiayaan
```

### 7. Generate Key

Jalankan:

```bash
php artisan key:generate
```

### 8. Buat Tabel Database

Jalankan:

```bash
php artisan migrate
```

Perintah ini akan membuat tabel yang dibutuhkan aplikasi.

### 9. Jalankan Laravel

Jalankan:

```bash
php artisan serve
```

Kemudian buka:

```text
http://127.0.0.1:8000
```

### 10. Jalankan Vite

Buka terminal baru di folder project, lalu jalankan:

```bash
npm run dev
```

Biarkan terminal ini tetap berjalan agar CSS dan tampilan aplikasi dapat digunakan.

## Akses Aplikasi

Buka browser dan masuk ke:

```text
http://127.0.0.1:8000
```

## Aturan Pengajuan

Aplikasi memiliki beberapa aturan:

* Pendapatan minimal Rp1.000.000 per bulan.
* Pengajuan maksimal Rp200.000.000.
* Tenor maksimal 24 bulan.
* Satu nasabah maksimal memiliki 3 pengajuan.
* Pengajuan baru memiliki status **Pending**.
* Pengajuan **Pending** dapat disetujui atau ditolak.
* Pengajuan yang sudah disetujui dapat ditandai **Lunas**.
* Pengajuan yang sudah **Lunas** tetap tersimpan di database.
* Pengajuan **Lunas** tidak dihitung dalam total pengajuan di Dashboard.

## Perhitungan Cicilan

Cicilan dihitung dengan rumus sederhana:

```text
Nominal Pengajuan ÷ Tenor
```

Contoh:

```text
Rp24.000.000 ÷ 24 bulan
= Rp1.000.000 per bulan
```

Aplikasi tidak menggunakan bunga karena tidak ada aturan bunga pada spesifikasi.

## Struktur Project

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

Jika ada perubahan pada database, jalankan:

```bash
php artisan migrate
```

Jika CSS atau tampilan tidak muncul, pastikan Vite sudah berjalan:

```bash
npm run dev
```

Untuk menghentikan Laravel atau Vite, tekan:

```text
Ctrl + C
```
