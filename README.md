# Sistem Pengarsipan Surat Kelurahan Galung

Aplikasi web untuk mengelola arsip surat masuk & keluar di Kelurahan Galung. Dibangun dengan **Laravel 13** + **Filament 5**.

## Fitur

- 🔐 Login Admin
- 📊 Dashboard statistik + grafik
- 📁 CRUD Arsip Surat (masuk & keluar)
- 🏷️ Kategori Surat
- 📎 Upload & Download PDF
- 🔢 Auto-generate nomor surat
- 🔍 Pencarian & filter
- 📤 Export CSV
- 🖨️ Print surat berkop
- ♻️ Recycle bin (soft delete + restore)
- 📜 Riwayat aktivitas
- 👥 Manajemen user

## Teknologi

- PHP 8.3
- Laravel 13
- Filament 5
- MySQL
- Tailwind CSS

## Cara Install

```bash
git clone https://github.com/Plida05/Project-Arsip-Surat-Kelurahan-Galung.git arsip_surat
cd arsip_surat
composer install
cp .env.example .env
php artisan key:generate
# Setup database di .env
php artisan migrate --seed
php artisan storage:link
php artisan serve

Buka: http://localhost:8000/admin

Login Default
Email: admin@baruga.test

Password: password123
