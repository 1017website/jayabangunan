# 🏗️ Jaya Bangun Konstruksi — Laravel Website + CMS

Website company profile PT. Jaya Bangun Konstruksi dibangun dengan **Laravel 12** lengkap dengan **panel CMS** untuk mengelola seluruh konten secara dinamis.

---

## 📋 Fitur

### 🌐 Website Frontend
- Halaman utama one-page dengan section: Hero, Tentang, Layanan, Proyek, Statistik, Proses, Testimoni, Kontak, Footer
- Semua konten diambil dari database (100% dinamis)
- Animasi scroll reveal, custom cursor, preloader
- Filter proyek berdasarkan kategori
- Form kontak yang tersimpan ke database
- Responsive mobile

### 🖥️ Panel CMS Admin (`/admin`)
| Modul | Fungsi |
|-------|--------|
| **Dashboard** | Ringkasan data + pesan terbaru + aksi cepat |
| **Pengaturan** | Edit teks hero, about, info perusahaan, media sosial |
| **Layanan** | CRUD layanan (icon, judul, deskripsi, urutan) |
| **Proyek** | CRUD proyek (upload foto / URL, kategori, tahun, lokasi) |
| **Testimoni** | CRUD testimoni (foto avatar, rating bintang) |
| **Statistik** | CRUD angka statistik (nilai, suffix, label) |
| **Pesan Masuk** | Lihat & kelola pesan dari form kontak |

---

## ⚡ Cara Instalasi (Laravel 12)

> **PENTING:** File di ZIP ini adalah file kustom yang di-copy ke project Laravel 12.
> Jangan `composer install` dari ZIP ini — Laravel 12 harus dibuat fresh terlebih dahulu.

### Cara Otomatis (Rekomendasi — Windows)

```powershell
# 1. Buat project Laravel 12 fresh
composer create-project laravel/laravel jayabangunan
cd jayabangunan

# 2. Extract ZIP jaya-bangun-laravel ke folder lain, lalu jalankan:
.\path\ke\jaya-bangun-laravel\install.ps1
```

Script `install.ps1` akan otomatis meng-copy semua file, install dependencies,
setup .env, dan menjalankan migrate.

---

### Cara Manual

#### 1. Buat project Laravel 12 fresh
```bash
composer create-project laravel/laravel jayabangunan
cd jayabangunan
```

#### 2. Install package tambahan
```bash
composer require intervention/image:^3.0
```

#### 3. Copy file dari ZIP ke project
Copy folder/file berikut dari ZIP ke project Laravel 12:

| Dari ZIP | Ke Project |
|----------|------------|
| `app/Models/*` | `app/Models/` |
| `app/Http/Controllers/*` | `app/Http/Controllers/` |
| `app/Http/Middleware/AdminMiddleware.php` | `app/Http/Middleware/` |
| `app/Providers/AppServiceProvider.php` | `app/Providers/` |
| `database/migrations/*` | `database/migrations/` (hapus yang lama) |
| `database/seeders/DatabaseSeeder.php` | `database/seeders/` |
| `resources/views/*` | `resources/views/` (hapus yang lama) |
| `routes/web.php` | `routes/` |
| `config/auth.php` | `config/` |

#### 4. Setup .env
```bash
cp .env.example .env
php artisan key:generate
```
Edit DB_DATABASE, DB_USERNAME, DB_PASSWORD sesuai MySQL Anda.

#### 5. Buat database
```sql
CREATE DATABASE jaya_bangun CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 6. Migrate & seed
```bash
php artisan migrate --seed
php artisan storage:link
```

#### 7. Jalankan
```bash
php artisan serve
```

Buka: **http://localhost:8000**

---

## 🔐 Login Admin

URL: `http://localhost:8000/admin`

| Field    | Value |
|----------|-------|
| Email    | `admin@jayabangun.co.id` |
| Password | `password` |

> ⚠️ **Ganti password segera setelah login pertama!**

---

## 📁 Struktur Direktori Penting

```
jaya-bangun-laravel/
│
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php              ← Frontend
│   │   └── Admin/
│   │       ├── AuthController.php          ← Login/logout
│   │       ├── DashboardController.php
│   │       ├── ServiceController.php
│   │       ├── ProjectController.php
│   │       ├── TestimonialController.php
│   │       ├── StatController.php
│   │       ├── SettingController.php
│   │       └── MessageController.php
│   │
│   └── Models/
│       ├── Setting.php                     ← Key-value settings
│       ├── Service.php
│       ├── Project.php                     ← image_url accessor
│       ├── Testimonial.php                 ← stars + avatar_url accessor
│       ├── Stat.php
│       ├── ContactMessage.php
│       └── User.php
│
├── database/
│   ├── migrations/                         ← 5 migration files
│   └── seeders/DatabaseSeeder.php          ← Data contoh lengkap
│
├── resources/views/
│   ├── frontend/
│   │   └── home.blade.php                  ← Halaman utama (replika template)
│   └── admin/
│       ├── layouts/app.blade.php           ← CMS layout + sidebar
│       ├── auth/login.blade.php
│       ├── dashboard.blade.php
│       ├── settings/index.blade.php
│       ├── services/{index,form}.blade.php
│       ├── projects/{index,form}.blade.php
│       ├── testimonials/{index,form}.blade.php
│       ├── stats/{index,form}.blade.php
│       └── messages/{index,show}.blade.php
│
├── routes/web.php                          ← Semua route
├── bootstrap/app.php                       ← Laravel 12 app config
├── config/auth.php
└── .env.example
```

---

## 🗄️ Skema Database

| Tabel | Isi |
|-------|-----|
| `settings` | Key-value pairs untuk semua teks website |
| `services` | Daftar layanan (icon, judul, deskripsi) |
| `projects` | Portofolio proyek (gambar, kategori, tahun) |
| `testimonials` | Ulasan klien (foto, rating, isi) |
| `stats` | Angka statistik (nilai, suffix, label) |
| `contact_messages` | Pesan masuk dari form kontak |
| `users` | Admin login |

---

## 🔧 Kustomisasi Konten

Semua teks dan gambar dapat diubah langsung dari **Panel Admin** tanpa coding:

1. Login ke `/admin`
2. Klik **Pengaturan** → edit teks hero, about, info perusahaan
3. Klik **Layanan / Proyek / Testimoni / Statistik** → tambah, edit, hapus data
4. Klik **Lihat Website** di sidebar untuk melihat perubahan

---

## 🖼️ Gambar Proyek

Ada dua cara input gambar:
- **Upload file** dari komputer (disimpan di `storage/app/public/projects/`)
- **URL gambar eksternal** (Unsplash, CDN, dll.)

---

## 🌐 Deploy ke Shared Hosting (cPanel)

1. Upload semua file ke `public_html/jaya-bangun/`
2. Pindahkan isi folder `public/` ke `public_html/`
3. Edit `public_html/index.php` — ubah path ke `bootstrap/app.php`
4. Buat database MySQL di cPanel, import hasil `php artisan migrate`
5. Edit `.env` dengan kredensial database hosting

---

## 📞 Dukungan

Kontak developer untuk pertanyaan teknis lebih lanjut.
