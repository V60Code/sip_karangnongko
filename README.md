# 🐐 SIP Karangnongko - Sistem Informasi Peternakan

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-3.3-orange.svg)](https://filamentphp.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

**SIP Karangnongko** adalah sistem informasi peternakan kambing berbasis web yang dirancang khusus untuk mengelola dan memantau aktivitas peternakan kambing di Desa Karangnongko. Sistem ini menyediakan solusi digital komprehensif untuk pencatatan data kambing, monitoring kesehatan harian, dan manajemen peternakan yang efisien.

## 🎯 Tujuan Proyek

Sistem ini dikembangkan untuk:
- Digitalisasi pengelolaan data peternakan kambing
- Memudahkan pencatatan dan monitoring kesehatan kambing harian
- Meningkatkan efisiensi manajemen peternakan
- Menyediakan laporan dan analisis data peternakan
- Mendukung pengambilan keputusan berbasis data

## Daftar Isi
- [Tentang Proyek](#tentang-proyek)
- [Fitur Utama](#fitur-utama)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Prasyarat](#prasyarat)
- [Instalasi](#instalasi)
- [Cara Penggunaan](#cara-penggunaan)
- [Berkontribusi](#berkontribusi)
- [Lisensi](#lisensi)
- [Kontak](#kontak)

## 📖 Tentang Proyek

SIP Karangnongko dikembangkan sebagai bagian dari program KKN (Kuliah Kerja Nyata) untuk membantu digitalisasi sektor peternakan di Desa Karangnongko. Sistem ini mengatasi permasalahan pencatatan manual yang rentan terhadap kehilangan data dan kesulitan dalam monitoring kondisi kambing secara real-time.

### Latar Belakang
- Pencatatan data kambing masih dilakukan secara manual
- Kesulitan dalam tracking kesehatan dan kondisi kambing harian
- Tidak ada sistem terpusat untuk mengelola multiple peternakan
- Kurangnya data historis untuk analisis dan pengambilan keputusan

### Target Pengguna
- **Peternak**: Mengelola data kambing dan pencatatan harian
- **Administrator**: Mengawasi seluruh peternakan dan generate laporan
- **Petugas Lapangan**: Melakukan monitoring dan input data harian

## ✨ Fitur Utama

### 🏢 **Manajemen Peternakan**
- Registrasi dan pengelolaan data peternakan
- Multi-farm support untuk mengelola beberapa lokasi
- Sistem pembatasan akses berdasarkan peternakan

### 🐐 **Manajemen Data Kambing**
- **Auto Tag Number**: Sistem penomoran otomatis untuk identifikasi unik
- **Data Lengkap**: Jenis kelamin, tipe/ras, tanggal lahir
- **CRUD Operations**: Create, Read, Update, Delete data kambing
- **Filter & Search**: Pencarian berdasarkan berbagai kriteria
- **Relasi Data**: Hubungan kambing dengan peternakan dan user

### 📅 **Sistem Absen Harian (Daily Check)**
- **Pencatatan Harian**: Input kehadiran dan kondisi kambing
- **Many-to-Many Relation**: Satu pengecekan untuk multiple kambing
- **Validasi Tanggal**: Pembatasan input untuk tanggal masa depan
- **Catatan Observasi**: Field khusus untuk kondisi dan catatan
- **Auto User Assignment**: Otomatis assign user yang melakukan check

### 👥 **Sistem User & Role Management**
- **Role-based Access Control**: Admin dan User dengan hak akses berbeda
- **Multi-level Authorization**: Pembatasan akses berdasarkan peternakan
- **User Activity Tracking**: Pencatatan aktivitas pengguna

### 📊 **Dashboard & Reporting**
- **Real-time Dashboard**: Overview data peternakan terkini
- **Widget System**: Komponen visual untuk data penting
- **Laporan Global**: Analisis komprehensif lintas peternakan
- **Historical Data**: Data historis untuk analisis trend

### 🔧 **Fitur Teknis**
- **Filament Admin Panel**: Interface modern dan user-friendly
- **Database Optimization**: Index untuk performa optimal
- **Responsive Design**: Akses dari berbagai perangkat
- **Data Validation**: Validasi input untuk integritas data

## 🛠️ Teknologi yang Digunakan

### Backend
- **Framework**: Laravel 12.x
- **Language**: PHP 8.2+
- **Admin Panel**: Filament 3.3
- **Database**: MySQL 8.0+ / PostgreSQL 14+
- **Package Manager**: Composer

### Frontend
- **UI Framework**: Filament Components (Tailwind CSS)
- **Build Tool**: Vite
- **Package Manager**: NPM
- **Icons**: Heroicons

### Development Tools
- **Testing**: Pest PHP
- **Code Style**: Laravel Pint
- **Development Server**: Laravel Sail / Artisan Serve
- **Version Control**: Git

### Database Features
- **Migrations**: Database schema versioning
- **Seeders**: Sample data generation
- **Relationships**: Eloquent ORM relationships
- **Performance**: Optimized indexes

## 📋 Prasyarat

Pastikan sistem Anda memiliki:

### Wajib
- **PHP** >= 8.2 dengan ekstensi:
  - BCMath
  - Ctype
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PDO
  - Tokenizer
  - XML
- **Composer** >= 2.0
- **Database**: MySQL >= 8.0 atau PostgreSQL >= 14
- **Web Server**: Apache/Nginx atau PHP built-in server

### Opsional (untuk development)
- **Node.js** >= 18.x
- **NPM** >= 9.x
- **Git** untuk version control
- **Laravel Sail** untuk Docker development

## 🚀 Instalasi

### Metode 1: Instalasi Manual

1. **Clone Repository**
   ```bash
   git clone https://github.com/V60Code/sip_karangnongko.git
   cd sip_karangnongko
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   
   Edit file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sip_karangnongko
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Database Migration & Seeding**
   ```bash
   php artisan migrate --seed
   ```

6. **Build Assets**
   ```bash
   npm run build
   ```

7. **Storage Link**
   ```bash
   php artisan storage:link
   ```

8. **Start Development Server**
   ```bash
   php artisan serve
   ```

### Metode 2: Menggunakan Laravel Sail (Docker)

1. **Clone & Setup**
   ```bash
   git clone https://github.com/V60Code/sip_karangnongko.git
   cd sip_karangnongko
   cp .env.example .env
   ```

2. **Install Dependencies via Sail**
   ```bash
   ./vendor/bin/sail up -d
   ./vendor/bin/sail composer install
   ./vendor/bin/sail npm install
   ```

3. **Setup Application**
   ```bash
   ./vendor/bin/sail artisan key:generate
   ./vendor/bin/sail artisan migrate --seed
   ./vendor/bin/sail npm run build
   ```

Aplikasi akan tersedia di `http://localhost` (Sail) atau `http://127.0.0.1:8000` (Artisan Serve)

## 📱 Cara Penggunaan

### Login Sistem

1. **Akses Aplikasi**
   - Buka browser dan kunjungi `http://127.0.0.1:8000/admin`
   - Atau `http://localhost/admin` jika menggunakan Sail

2. **Kredensial Default**
   
   Setelah menjalankan seeder, gunakan akun berikut:
   
   **Administrator:**
   - Email: `admin@karangnongko.com`
   - Password: `password`
   
   **User Peternakan:**
   - Email: `user@karangnongko.com`
   - Password: `password`

### Panduan Penggunaan

#### Untuk Administrator:
1. **Dashboard**: Lihat overview seluruh peternakan
2. **Manajemen Peternakan**: Tambah/edit data peternakan
3. **Manajemen User**: Kelola akses pengguna
4. **Laporan Global**: Generate laporan komprehensif

#### Untuk User Peternakan:
1. **Data Kambing**: Kelola data kambing di peternakan Anda
2. **Daily Check**: Input kondisi kambing harian
3. **Laporan**: Lihat laporan peternakan Anda

### Fitur Utama

- **Auto Tag Number**: Sistem otomatis generate nomor tag kambing
- **Daily Monitoring**: Pencatatan kondisi kambing setiap hari
- **Multi-Farm**: Kelola beberapa peternakan dalam satu sistem
- **Role-based Access**: Akses terbatas sesuai role pengguna

## 🤝 Berkontribusi

Kami menyambut kontribusi untuk pengembangan SIP Karangnongko!

### Cara Berkontribusi

1. **Fork Repository**
   ```bash
   git clone https://github.com/your-username/sip_karangnongko.git
   ```

2. **Buat Feature Branch**
   ```bash
   git checkout -b feature/nama-fitur
   ```

3. **Development Setup**
   ```bash
   composer install
   npm install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   ```

4. **Coding Standards**
   - Ikuti PSR-12 coding standards
   - Gunakan Laravel Pint untuk formatting:
     ```bash
     ./vendor/bin/pint
     ```
   - Tulis tests untuk fitur baru:
     ```bash
     php artisan test
     ```

5. **Commit & Push**
   ```bash
   git add .
   git commit -m "feat: menambahkan fitur X"
   git push origin feature/nama-fitur
   ```

6. **Create Pull Request**
   - Buat PR ke branch `main`
   - Sertakan deskripsi lengkap perubahan
   - Pastikan semua tests passing

### Guidelines
- Gunakan conventional commits
- Update dokumentasi jika diperlukan
- Pastikan backward compatibility
- Test pada multiple PHP versions

## 🧪 Testing

### Menjalankan Tests

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run with coverage
php artisan test --coverage
```

### Test Database

Sistem menggunakan SQLite in-memory untuk testing:

```bash
# Setup test environment
cp .env.testing.example .env.testing
php artisan config:clear
```

## 🚀 Deployment

### Production Setup

1. **Server Requirements**
   - PHP 8.2+ dengan semua ekstensi
   - MySQL 8.0+ atau PostgreSQL 14+
   - Nginx atau Apache
   - SSL Certificate (recommended)

2. **Environment Configuration**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-domain.com
   
   DB_CONNECTION=mysql
   DB_HOST=your-db-host
   DB_DATABASE=sip_karangnongko
   DB_USERNAME=your-db-user
   DB_PASSWORD=your-secure-password
   ```

3. **Deployment Commands**
   ```bash
   composer install --optimize-autoloader --no-dev
   npm run build
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan migrate --force
   ```

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE). Lihat file LICENSE untuk detail lengkap.

## 👥 Tim Pengembang

**Tim KKN Karangnongko**
- Email: [m.alfarizihabibullah@gmail.com](mailto:m.alfarizihabibullah@gmail.com)
- Repository: [https://github.com/V60Code/sip_karangnongko](https://github.com/V60Code/sip_karangnongko)

## 🙏 Acknowledgments

- [Laravel Framework](https://laravel.com) - Web application framework
- [Filament](https://filamentphp.com) - Admin panel framework
- [Tailwind CSS](https://tailwindcss.com) - CSS framework
- Desa Karangnongko - Lokasi implementasi sistem
