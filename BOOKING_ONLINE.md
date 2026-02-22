# 📅 Fitur Booking Online EMIRA

## Overview
Fitur Booking Online memungkinkan pasien untuk membuat janji temu dengan dokter secara online melalui website EMIRA tanpa harus datang ke loket pendaftaran.

## Fitur Utama

### 1. Untuk Pasien (Public)
- **Booking Online** (`/booking`)
  - Cek data pasien dengan No. RM atau NIK
  - Pilih poli dan tanggal kunjungan
  - Lihat jadwal dokter yang tersedia dengan sisa kuota
  - Isi detail booking (jenis pembayaran, keluhan)
  - Dapatkan kode booking

- **Cek Status Booking** (`/booking/check`)
  - Cek status booking dengan kode booking
  - Lihat detail booking dan nomor antrian (jika sudah dikonfirmasi)

- **Halaman Sukses** (`/booking/success/{kode}`)
  - Konfirmasi booking berhasil
  - Detail lengkap booking
  - Informasi penting untuk pasien

### 2. Untuk Admin/Staff (Authenticated)
- **Manajemen Booking** (`/booking-management`)
  - Lihat semua booking online
  - Filter berdasarkan status dan tanggal
  - Konfirmasi booking (otomatis buat antrian jika hari ini)
  - Batalkan booking dengan alasan
  - Lihat detail lengkap booking (modal popup)
    - Data pasien lengkap
    - Jadwal dokter
    - Informasi medis (keluhan, jenis pembayaran)
    - Status antrian (jika sudah dibuat)
    - Timeline booking
    - Alasan pembatalan (jika dibatalkan)

## Alur Kerja

### Alur Pasien
1. Pasien mengakses `/booking`
2. Input No. RM atau NIK untuk verifikasi
3. Pilih poli dan tanggal kunjungan
4. Sistem menampilkan jadwal dokter yang tersedia dengan sisa kuota
5. Pilih jadwal dokter
6. Isi detail (jenis pembayaran, keluhan)
7. Submit booking
8. Dapatkan kode booking
9. Cek status booking kapan saja dengan kode booking

### Alur Admin
1. Admin login ke sistem
2. Akses menu "Booking Online" di sidebar
3. Lihat daftar booking yang masuk
4. Konfirmasi booking:
   - Jika tanggal booking = hari ini → otomatis buat antrian
   - Jika tanggal booking = masa depan → hanya update status
5. Atau batalkan booking jika diperlukan

## Status Booking

| Status | Deskripsi | Badge |
|--------|-----------|-------|
| `pending` | Menunggu konfirmasi dari petugas | Warning (Kuning) |
| `confirmed` | Sudah dikonfirmasi oleh petugas | Success (Hijau) |
| `cancelled` | Dibatalkan | Danger (Merah) |
| `completed` | Selesai dilayani | Primary (Biru) |

## Database Schema

### Tabel: `bookings`
```sql
- id
- kode_booking (unique)
- pasien_id (FK → pasiens)
- poli_id (FK → polis)
- dokter_id (FK → dokters)
- jadwal_dokter_id (FK → jadwal_dokters)
- tanggal_booking
- jam_booking
- jenis_pembayaran (umum|bpjs)
- no_bpjs (nullable)
- keluhan (nullable)
- status (pending|confirmed|cancelled|completed)
- antrian_id (nullable, FK → antrians)
- catatan_pembatalan (nullable)
- confirmed_at (nullable)
- cancelled_at (nullable)
- timestamps
```

## Routes

### Public Routes
```php
GET  /booking                      → Form booking
POST /booking                      → Store booking
GET  /booking/success/{kode}       → Success page
GET  /booking/check                → Form cek status
POST /booking/check-pasien         → API cek pasien
POST /booking/get-jadwal           → API get jadwal dokter
POST /booking/get-status           → API get status booking
```

### Admin Routes (Superadmin only)
```php
GET  /booking-management           → Daftar booking
POST /booking/{id}/confirm         → Konfirmasi booking
POST /booking/{id}/cancel          → Batalkan booking
```

## Fitur Keamanan
- Validasi pasien harus terdaftar (cek No. RM/NIK)
- Cek kuota jadwal dokter
- Validasi tanggal booking (tidak boleh masa lalu)
- CSRF protection
- Role-based access control untuk admin

## Integrasi dengan Sistem Existing
- Terintegrasi dengan tabel `pasiens`
- Terintegrasi dengan tabel `polis`
- Terintegrasi dengan tabel `dokters`
- Terintegrasi dengan tabel `jadwal_dokters`
- Otomatis buat `antrian` dan `kunjungan` saat konfirmasi (jika hari ini)

## Notifikasi (Future Enhancement)
- Email konfirmasi booking
- SMS reminder H-1
- WhatsApp notification
- Push notification

## Laporan (Future Enhancement)
- Statistik booking per bulan
- Tingkat konversi booking → kunjungan
- Dokter dengan booking terbanyak
- Waktu rata-rata konfirmasi booking

## Testing
Untuk testing fitur ini:
1. Akses `/booking` (tanpa login)
2. Gunakan No. RM dari data pasien yang sudah ada
3. Pilih jadwal dokter yang tersedia
4. Submit booking
5. Login sebagai superadmin
6. Akses `/booking-management`
7. Konfirmasi atau batalkan booking

## Catatan Penting
- Hanya superadmin yang bisa akses manajemen booking
- Booking otomatis jadi antrian hanya jika tanggal booking = hari ini
- Pasien harus sudah terdaftar di sistem (punya No. RM)
- Kuota jadwal dokter dikurangi otomatis saat booking dibuat
