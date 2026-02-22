# 🚀 Cara Menggunakan Fitur Booking Online EMIRA

## Untuk Pasien

### 1. Akses Halaman Booking
- Buka browser dan akses: `http://localhost:8000/booking`
- Atau klik menu "Booking Online" di halaman utama

### 2. Verifikasi Data Pasien
- Masukkan **No. Rekam Medis** atau **NIK** Anda
- Klik tombol "Cek Data"
- Jika data ditemukan, informasi pasien akan ditampilkan
- Klik "Lanjut ke Pilih Jadwal"

### 3. Pilih Jadwal Dokter
- Pilih **Poli** yang ingin dikunjungi
- Pilih **Tanggal Kunjungan** (minimal hari ini)
- Sistem akan menampilkan jadwal dokter yang tersedia
- Klik jadwal dokter yang diinginkan
- Klik "Lanjut ke Detail"

### 4. Isi Detail Booking
- Pilih **Jenis Pembayaran** (Umum atau BPJS)
- Jika BPJS, masukkan **No. BPJS**
- Isi **Keluhan** (opsional)
- Klik "Konfirmasi Booking"

### 5. Simpan Kode Booking
- Anda akan mendapat **Kode Booking** (contoh: BKG-20250222-ABC123)
- **SIMPAN** kode ini untuk cek status booking
- Booking akan dikonfirmasi petugas dalam 1x24 jam

### 6. Cek Status Booking
- Akses: `http://localhost:8000/booking/check`
- Masukkan **Kode Booking** Anda
- Klik "Cek Status"
- Lihat status dan nomor antrian (jika sudah dikonfirmasi)

---

## Untuk Admin/Petugas

### 1. Login ke Sistem
- Login sebagai **Superadmin**
- Email: `superadmin@emira.app`
- Password: `emira@superadmin`

### 2. Akses Manajemen Booking
- Klik menu **"Booking Online"** di sidebar
- Atau akses: `http://localhost:8000/booking-management`

### 3. Lihat Daftar Booking
- Semua booking online akan tampil di tabel
- Filter berdasarkan **Status** atau **Tanggal**
- Badge kuning = Pending (perlu konfirmasi)
- Badge hijau = Confirmed
- Badge merah = Cancelled

### 4. Konfirmasi Booking
- Klik tombol **✓** (hijau) pada booking yang pending
- Konfirmasi akan:
  - Update status booking menjadi "Confirmed"
  - Jika tanggal booking = hari ini → otomatis buat antrian & kunjungan
  - Jika tanggal booking = masa depan → hanya update status

### 5. Batalkan Booking
- Klik tombol **✗** (merah) pada booking
- Isi **Alasan Pembatalan**
- Klik "Batalkan Booking"

---

## Tips & Catatan

### Untuk Pasien
✅ Pastikan Anda sudah terdaftar sebagai pasien (punya No. RM)
✅ Booking minimal H-0 (hari ini)
✅ Datang 15 menit sebelum jadwal praktik
✅ Bawa kartu identitas dan kartu BPJS (jika ada)
✅ Simpan kode booking untuk cek status

### Untuk Admin
✅ Konfirmasi booking sesegera mungkin
✅ Jika booking untuk hari ini, antrian otomatis dibuat
✅ Jika pasien tidak datang, ubah status antrian menjadi "tidak_hadir"
✅ Berikan alasan jelas saat membatalkan booking

---

## Contoh Skenario

### Skenario 1: Booking untuk Hari Ini
1. Pasien booking pukul 08:00 untuk hari ini
2. Admin konfirmasi pukul 08:15
3. Sistem otomatis buat antrian dengan nomor urut
4. Pasien datang dan langsung dapat nomor antrian
5. Pasien menunggu dipanggil sesuai urutan

### Skenario 2: Booking untuk Besok
1. Pasien booking hari ini untuk besok
2. Admin konfirmasi hari ini
3. Status booking = "Confirmed"
4. Besok pagi, admin buat antrian manual atau pasien datang langsung
5. Pasien dilayani sesuai jadwal

### Skenario 3: Pembatalan Booking
1. Pasien booking untuk besok
2. Pasien berubah pikiran dan tidak jadi datang
3. Pasien hubungi klinik untuk batalkan
4. Admin batalkan booking dengan alasan "Pasien berubah pikiran"
5. Status booking = "Cancelled"

---

## Troubleshooting

### Pasien tidak ditemukan
❌ **Masalah:** Data pasien tidak ditemukan saat input No. RM/NIK
✅ **Solusi:** Pasien harus daftar dulu di loket pendaftaran

### Tidak ada jadwal tersedia
❌ **Masalah:** Tidak ada jadwal dokter muncul
✅ **Solusi:** 
- Pastikan ada jadwal dokter untuk hari yang dipilih
- Cek kuota jadwal dokter (mungkin sudah penuh)
- Pilih tanggal lain

### Booking tidak bisa dikonfirmasi
❌ **Masalah:** Tombol konfirmasi tidak muncul
✅ **Solusi:** 
- Pastikan status booking = "Pending"
- Hanya superadmin yang bisa konfirmasi
- Refresh halaman

---

## URL Penting

| Halaman | URL | Akses |
|---------|-----|-------|
| Booking Online | `/booking` | Public |
| Cek Status | `/booking/check` | Public |
| Manajemen Booking | `/booking-management` | Superadmin |
| Login Staff | `/login` | Public |

---

## Support
Jika ada kendala, hubungi admin sistem atau IT support klinik.
