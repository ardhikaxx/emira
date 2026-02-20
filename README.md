# EMIRA - Sistem Informasi Manajemen Rumah Sakit

EMIRA adalah aplikasi sistem informasi manajemen rumah sakit berbasis web yang dibangun dengan Laravel. Aplikasi ini dirancang untuk mengelola berbagai aspek operasional rumah sakit secara digital dan efisien.

## Teknologi yang Digunakan

- **Framework**: Laravel 10
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Blade Template
- **Icons**: Font Awesome 6
- **Authentication**: Laravel Breeze / Session-based

## Fitur Utama

### 1. Manajemen Pasien
- Pendaftaran pasien baru
- Riwayat kunjungan pasien
- Data demografi pasien (NIK, tanggal lahir, kontak, dll.)

### 2. Manajemen Poli dan Dokter
- Kelola data poli/klinik
- Kelola data dokter dengan spesialisasi
- Jadwal praktik dokter

### 3. Sistem Antrian
- Pendaftaran antrian pasien
- Pemanggilan antrian
- Status antrian real-time (menunggu, dipanggil, dalam pelayanan, selesai)

### 4. Rekam Medis
- Pembuatan rekam medis elektronik
- Pencatatan anamnesis dan diagnose
- Kode ICD-10
- Tindakan medis

### 5. Vital Sign
- Pencatatan tanda vital pasien
- Tekanan darah, nadi, pernapasan, suhu
- Saturasi oksigen, berat badan, tinggi badan

### 6. Manajemen Ruangan
- Kelola ruangan rawat inap, ICU, UGD, Isolasi, VIP
- Kapasitas dan status ruangan

### 7. Master Data
- Kode ICD-10 (diagnosa)
- Master tindakan medis
- Pengaturan sistem

### 8. Manajemen User
- Kelola pengguna sistem
- Hak akses berbasis role

## Role Pengguna

| Role | Deskripsi |
|------|-----------|
| **Super Admin** | Akses penuh ke semua fitur dan pengaturan sistem |
| **Admin** | Mengelola data master, pasien, dan laporan |
| **Dokter** | Akses rekam medis, antrian pasien, dan catatan medis |
| **Perawat** | Mencatat vital sign dan tindakan keperawatan |
| **Loket** | Mendaftarkan pasien dan antrian |

## Instalasi

1. Clone repository
```bash
git clone https://github.com/ardhikaxx/emira.git
```

2. Install dependencies
```bash
composer install
npm install
```

3. Konfigurasi file `.env`
```bash
cp .env.example .env
php artisan key:generate
```

4. Setup database
```bash
php artisan migrate
php artisan db:seed
```

5. Jalankan aplikasi
```bash
php artisan serve
```

## Default Login

Setelah seeding, gunakan kredensial berikut:

| Role | Email | Password |
|------|-------|----------|
| Super Admin | admin@emira.com | password |
| Admin | admin2@emira.com | password |
| Dokter | dokter@emira.com | password |
| Perawat | perawat@emira.com | password |
| Loket | loket@emira.com | password |

## Struktur Menu

- **Dashboard**: Halaman utama dengan statistik
- **Pasien**: Kelola data pasien
- **Antrian**: Sistem antrian pasien
- **Rekam Medis**: Dokumentasi medis
- **Poli**: Kelola poli
- **Dokter**: Kelola dokter
- **Jadwal**: Jadwal praktik dokter
- **Ruangan**: Kelola ruangan
- **Master**: ICD-10, Tindakan
- **User**: Kelola pengguna
- **Pengaturan**: Pengaturan aplikasi

## Lisensi

Proyek ini adalah proprietary software. Semua hak cipta dilindungi.
