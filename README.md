# Sistem Manajemen Poliklinik (Poli-Bimkar)

Sistem manajemen poliklinik berbasis web yang dibangun menggunakan Laravel 12 untuk mengelola operasional klinik, termasuk manajemen dokter, pasien, jadwal pemeriksaan, dan obat-obatan.

## 🚀 Fitur Utama

### 👨‍⚕️ Panel Dokter
- **Dashboard Dokter** - Overview aktivitas dan statistik
- **Manajemen Obat** - CRUD obat dengan soft delete dan restore
- **Jadwal Pemeriksaan** - Pengaturan jadwal praktek dokter
- **Pemeriksaan Pasien** - Proses pemeriksaan dan pencatatan hasil
- **Riwayat Pemeriksaan** - Melihat detail riwayat pemeriksaan pasien

### 👥 Panel Pasien
- **Dashboard Pasien** - Informasi personal dan aktivitas
- **Janji Pemeriksaan** - Membuat janji temu dengan dokter
- **Riwayat Pemeriksaan** - Melihat riwayat dan detail pemeriksaan

### 🔐 Sistem Autentikasi
- Multi-role authentication (Dokter & Pasien)
- Profile management
- Role-based access control

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Alpine.js, Tailwind CSS
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Breeze
- **Build Tools**: Vite
- **Testing**: Pest PHP

## 📋 Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/SQLite
- Web Server (Apache/Nginx)

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd poli-bimkar
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=poli_bimkar
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Migration & Seeding
```bash
# Run migrations
php artisan migrate

# Run seeders (optional)
php artisan db:seed
```

### 6. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Start Development Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 📊 Struktur Database

### Tabel Utama
- **users** - Data pengguna (dokter & pasien)
- **polis** - Data poliklinik
- **obats** - Data obat-obatan
- **jadwal_periksas** - Jadwal praktek dokter
- **janji_periksas** - Janji temu pasien
- **periksas** - Data pemeriksaan
- **detail_periksas** - Detail obat yang diberikan

### Relasi Database
- User (Dokter) → belongsTo → Poli
- JadwalPeriksa → belongsTo → User (Dokter)
- JanjiPeriksa → belongsTo → User (Pasien) & JadwalPeriksa
- Periksa → belongsTo → JanjiPeriksa
- DetailPeriksa → belongsTo → Periksa & Obat

## 🎯 Penggunaan

### Login sebagai Dokter
1. Akses halaman login
2. Masuk dengan kredensial dokter
3. Kelola jadwal pemeriksaan
4. Lakukan pemeriksaan pasien
5. Kelola data obat

### Login sebagai Pasien
1. Akses halaman login
2. Masuk dengan kredensial pasien
3. Buat janji pemeriksaan
4. Lihat riwayat pemeriksaan

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=ExampleTest
```

## 📁 Struktur Project

```
poli-bimkar/
├── app/
│   ├── Http/Controllers/
│   │   ├── Dokter/          # Controllers untuk dokter
│   │   └── Pasien/          # Controllers untuk pasien
│   ├── Models/              # Eloquent models
│   └── Middleware/          # Custom middleware
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   └── views/
│       ├── dokter/         # Views untuk dokter
│       ├── pasien/         # Views untuk pasien
│       └── layouts/        # Layout templates
├── routes/
│   ├── web.php            # Web routes
│   ├── dokter.php         # Dokter routes
│   └── pasien.php         # Pasien routes
└── public/                # Public assets
```

## 🔧 Konfigurasi

### Role Management
Sistem menggunakan role-based access dengan middleware:
- `role:dokter` - Akses khusus dokter
- `role:pasien` - Akses khusus pasien

### Middleware
- `auth` - Autentikasi pengguna
- `role` - Otorisasi berdasarkan role

## 🤝 Kontribusi

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📝 License

Project ini menggunakan [MIT License](https://opensource.org/licenses/MIT).

## 👥 Tim Pengembang

- **Developer**: [Nama Developer]
- **Project**: Tugas Kuliah SMT 6 - Bimbingan Karir

## 📞 Support

Jika mengalami masalah atau memiliki pertanyaan, silakan buat issue di repository ini.

---

**Catatan**: Project ini dikembangkan untuk keperluan akademik dalam rangka tugas kuliah Semester 6 Bimbingan Karir.
