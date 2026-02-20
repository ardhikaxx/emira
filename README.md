# EMIRA - Sistem Informasi Manajemen Rumah Sakit

EMIRA adalah aplikasi sistem informasi manajemen rumah sakit berbasis web yang dibangun dengan Laravel. Aplikasi ini dirancang untuk mengelola berbagai aspek operasional rumah sakit secara digital dan efisien.

## Teknologi yang Digunakan

- **Framework**: Laravel 12
- **PHP**: ^8.2
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Blade Template
- **Icons**: Font Awesome 6
- **Authentication**: Session-based

## Fitur Utama

### 1. Manajemen Pasien
- Pendaftaran pasien baru dengan nomor RM otomatis
- Riwayat kunjungan pasien
- Data demografi pasien (NIK, nama lengkap, tanggal lahir, jenis kelamin, kontak)

### 2. Sistem Antrian
- Pendaftaran antrian pasien per poli
- Pemilihan dokter
- Pemanggilan dan melayani antrian
- Status antrian real-time (menunggu, dipanggil, dalam pelayanan, selesai)

### 3. Rekam Medis Elektronik
- Pembuatan rekam medis berdasarkan kunjungan
- Pencatatan anamnesis
- Diagnosa dengan kode ICD-10
- Tindakan medis
- Riwayat penyakit keluarga dan alergi

### 4. Vital Sign
- Pencatatan tanda vital pasien
- Tekanan darah (sistol/diastol)
- Nadi, pernapasan, suhu tubuh
- Saturasi oksigen
- Berat badan, tinggi badan, BMI
- Gula darah sewaktu

### 5. Manajemen Poli
- Kelola data poli/klinik
- Kode poli dan status aktif

### 6. Manajemen Dokter
- Kelola data dokter
- Spesialisasi dan poli penugasan
- No. SIP, No. STR, NIP

### 7. Jadwal Praktik Dokter
- Jadwal praktik per hari
- Jam mulai dan selesai
- Kuota pasien per hari

### 8. Manajemen Ruangan
- Kelola ruangan (rawat inap, ICU, UGD, isolasi, VIP)
- Kapasitas dan lokasi lantai

### 9. Master Data
- Kode ICD-10 (diagnosa penyakit)
- Master tindakan medis
- Kategori tindakan

### 10. Manajemen User
- Kelola pengguna sistem
- Hak akses berbasis role

### 11. Pengaturan Sistem
- Konfigurasi aplikasi rumah sakit

## Role Pengguna

| Role | Deskripsi |
|------|-----------|
| **Super Admin** | Akses penuh ke seluruh fitur sistem termasuk master data, user, poli, dokter, ruangan, dan pengaturan |
| **Dokter** | Input rekam medis, diagnosa, tindakan medis, dan surat keterangan |
| **Perawat** | Kelola antrian, vital sign, dan tindakan keperawatan |
| **Rekam Medis** | Registrasi pasien, arsip rekam medis, dan laporan EMIRA |

## Hak Akses per Role

| Fitur | Super Admin | Dokter | Perawat | Rekam Medis |
|-------|:------------:|:------:|:-------:|:-----------:|
| Dashboard | ✓ | ✓ | ✓ | ✓ |
| Antrian | ✓ | ✓ | ✓ | ✓ |
| Vital Sign | ✓ | ✓ | ✓ | ✓ |
| Pasien | ✓ | - | - | ✓ |
| Rekam Medis | ✓ | ✓ | - | ✓ |
| Poli | ✓ | - | - | - |
| Dokter | ✓ | - | - | - |
| Jadwal Dokter | ✓ | - | - | - |
| Ruangan | ✓ | - | - | - |
| ICD-10 | ✓ | - | - | - |
| Tindakan | ✓ | - | - | - |
| User | ✓ | - | - | - |
| Pengaturan | ✓ | - | - | - |

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
```
Edit koneksi database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=emira
DB_USERNAME=root
DB_PASSWORD=
```

4. Generate key dan setup
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```

5. Jalankan aplikasi
```bash
php artisan serve
```

Buka browser: `http://127.0.0.1:8000`

## Default Login (Setelah Seeding)

| Role | Email | Password |
|------|-------|----------|
| Super Admin | superadmin@emira.app | emira@superadmin |
| Dokter | andi.wijaya@emira.app | dokter123 |
| Perawat | rina.susanti@emira.app | perawat123 |
| Rekam Medis | ahmad.fauzi@emira.app | rekammedis123 |

## Lisensi

Proyek ini adalah proprietary software. Semua hak cipta dilindungi.
