# POS Mitra

Aplikasi Point of Sale (POS) berbasis Laravel yang dirancang untuk membantu usaha retail, toko, atau warung dalam mengelola produk, pelanggan, supplier, transaksi penjualan, stok, dan laporan secara cepat dan rapi.

## 1. Nama Project
POS Mitra

## 2. Deskripsi
POS Mitra adalah aplikasi manajemen penjualan yang memiliki fitur utama berikut:

- Manajemen kategori produk
- Manajemen produk dan stok
- Manajemen supplier dan pelanggan
- Transaksi pembelian dan penjualan
- Pembuatan struk penjualan
- Laporan penjualan dan laporan stok
- Sistem role user (`admin` dan `kasir`)
- Tampilan dashboard dan navigasi yang responsif

## 3. Fitur

### Fitur Utama
- Dashboard statistik
- CRUD Kategori
- CRUD Produk
- CRUD Supplier
- CRUD Pelanggan
- Pembelian stok barang
- Transaksi penjualan
- Detail transaksi dan receipt/struk
- Laporan penjualan
- Laporan stok
- Role-based access control
- Tampilan modern menggunakan Bootstrap 5
- Notifikasi modern menggunakan SweetAlert2

## 4. Teknologi yang Digunakan

- Laravel 12
- PHP 8.2+
- SQLite (default project) atau dapat diubah ke MySQL/PostgreSQL
- Breeze untuk autentikasi
- Bootstrap 5
- Bootstrap Icons
- SweetAlert2
- Vite untuk asset frontend

## 5. Persyaratan Instalasi

Sebelum menjalankan project, pastikan perangkat Anda sudah memiliki:

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js dan npm
- Database SQLite (sudah tersedia secara bawaan) atau database lain sesuai konfigurasi

## 6. Cara Install

1. Clone atau unduh project ini.
2. Masuk ke folder project.
3. Jalankan perintah berikut:

```bash
composer install
npm install
```

4. Buat file `.env` dari `.env.example` jika belum ada:

```bash
cp .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Jalankan migrasi database:

```bash
php artisan migrate
```

7. Jalankan seeder untuk membuat data awal (jika diperlukan):

```bash
php artisan db:seed
```

8. Build frontend assets:

```bash
npm run build
```

## 7. Cara Konfigurasi Database

Project ini menggunakan SQLite secara default.

### Database SQLite
File database SQLite berada di:

```text
database/database.sqlite
```

Jika belum ada file tersebut, dapat dibuat dengan perintah:

```bash
touch database/database.sqlite
```

### Mengubah ke Database Lain
Jika ingin menggunakan MySQL atau PostgreSQL, edit file `.env` seperti berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pos_mitra
DB_USERNAME=root
DB_PASSWORD=
```

Setelah itu jalankan:

```bash
php artisan migrate
```

## 8. Cara Menjalankan Project

### Mode development

```bash
php artisan serve
```

Dan jalankan frontend asset secara terpisah:

```bash
npm run dev
```

### Mode production

```bash
npm run build
php artisan serve
```

## 9. Cara Membuat User

Project ini sudah menyediakan autentikasi Laravel Breeze. Untuk membuat user baru, gunakan salah satu cara berikut:

### A. Melalui register di aplikasi
- Buka halaman daftar (`/register`)
- Isi nama, email, password
- Setelah berhasil, user akan dibuat

### B. Melalui seeder / database manual
Jika ingin membuat user secara langsung, Anda juga bisa menambah data ke tabel `users` melalui database atau artisan tinker.

Contoh umum:

```bash
php artisan tinker
```

Lalu:

```php
App\Models\User::create([
    'name' => 'Admin POS',
    'email' => 'admin@example.com',
    'role' => 'admin',
    'password' => bcrypt('password123'),
]);
```

## 10. Cara Login

1. Buka browser dan akses aplikasi.
2. Masuk ke halaman login.
3. Gunakan user yang sudah dibuat.
4. Jika menggunakan seed default, user yang tersedia biasanya:
   - Email: `test@example.com`
   - Password: `password`

> Catatan: password seed default dibuat oleh factory Laravel, sehingga untuk pengguna tertentu Anda dapat menyesuaikan sesuai kebutuhan.

## 11. Struktur Fitur

### Modul utama
- `Dashboard` — ringkasan statistik dan aktivitas
- `Kategori` — mengelola jenis produk
- `Produk` — mengelola data barang, harga, stok, dan barcode
- `Supplier` — mengelola pemasok
- `Pelanggan` — mengelola data pelanggan
- `Pembelian` — mencatat pembelian stok dari supplier
- `Penjualan` — proses transaksi hingga struk
- `Laporan` — laporan stok dan penjualan
- `User` — pengaturan role admin/kasir

## 12. Informasi Pengembangan

### Struktur Direktori Penting

```text
app/
  Http/
    Controllers/
    Middleware/
  Models/
bootstrap/
config/
database/
  migrations/
  seeders/
resources/
  css/
  js/
  views/
routes/
public/
```

### Role User
Project ini sudah dilengkapi dengan middleware role untuk membatasi akses sesuai peran:

- `admin` — dapat akses semua fitur utama, termasuk manajemen user, laporan, dan pembelian
- `kasir` — dapat mengakses transaksi dan data umum, tetapi tidak semua fitur admin

### UI & UX
- Navbar otomatis menampilkan menu sesuai hak akses
- Semua aksi CRUD dibangun dengan tampilan yang konsisten
- SweetAlert2 digunakan untuk notifikasi dan konfirmasi hapus
- Bootstrap Icons digunakan agar tombol dan ikon lebih rapi dan menarik

## 13. Catatan Penting

- Pastikan `npm run build` dijalankan setelah perubahan frontend atau saat project pertama kali dijalankan.
- Jika terjadi error `ViteManifestNotFoundException`, pastikan asset frontend sudah dibangun dan `public/build/manifest.json` tersedia.
- Role user dapat diubah melalui panel `User` atau secara langsung di database.

## 14. License

Project ini dibuat untuk kebutuhan pengembangan aplikasi POS berbasis Laravel dan dapat dikembangkan lebih lanjut sesuai kebutuhan bisnis.
