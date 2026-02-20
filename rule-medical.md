# ⚕️ EMIRA — Electronic Medical Integrated Record & Administration
### Rule & Panduan Pengembangan Sistem · Laravel 12

> **EMIRA** adalah sistem rekam medis elektronik operasional yang fokus pada alur klinis harian: pendaftaran pasien, pemeriksaan, pencatatan rekam medis, dan laporan — dalam satu platform terpadu berbasis web.
>
> **Stack:** Laravel 12 · Bootstrap 5 (CDN) · Font Awesome 6 (CDN) · SweetAlert2 (CDN)
> **Tagline:** *"Satu Sistem, Rekam Medis Terintegrasi."*

---

## 🎨 IDENTITAS SISTEM EMIRA

| Atribut | Nilai |
|---------|-------|
| **Nama Sistem** | EMIRA |
| **Kepanjangan** | Electronic Medical Integrated Record & Administration |
| **Versi** | 1.0.0 |
| **Framework** | Laravel 12 |
| **Warna Primer** | `#0A6EBD` (Biru Medis) |
| **Warna Sekunder** | `#17B169` (Hijau Sehat) |
| **Warna Bahaya** | `#DC3545` (Merah Bootstrap) |
| **Font** | Inter / System UI |
| **Ikon** | Font Awesome 6 Free |

### Penggunaan Nama EMIRA
- **Judul halaman:** `EMIRA — [Nama Modul]`
- **Navbar brand:** `⚕️ EMIRA`
- **Footer:** `© 2025 EMIRA · Electronic Medical Integrated Record & Administration`
- **APP_NAME di `.env`:** `EMIRA`
- **Prefix No. RM:** `EMIRA-RM-YYYY-XXXXXX`
- **Prefix No. Kunjungan:** `EMIRA-KJN-YYYYMMDD-XXXX`

---

## 📦 CDN WAJIB

```html
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
<link rel="stylesheet" href="{{ asset('css/emira.css') }}">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
```

---

## 👤 ROLE EMIRA — 4 Role Operasional

| No | Role | Kode | Badge | Deskripsi |
|----|------|------|-------|-----------|
| 1 | **Super Admin** | `superadmin` | `bg-danger` | Akses penuh seluruh sistem EMIRA |
| 2 | **Dokter** | `dokter` | `bg-primary` | Rekam medis, diagnosa, tindakan, surat |
| 3 | **Perawat** | `perawat` | `bg-success` | Antrian, vital sign, tindakan keperawatan |
| 4 | **Rekam Medis** | `rekam_medis` | `bg-warning text-dark` | Registrasi pasien, arsip RM, laporan |

---

## 🔐 MATRIKS HAK AKSES

### 🔴 Super Admin — Akses Penuh
Semua modul tanpa pengecualian termasuk manajemen user, pengaturan sistem, dan log aktivitas.

### 🔵 Dokter
| Modul | C | R | U | D |
|-------|---|---|---|---|
| Rekam Medis (pasien yang ditangani) | ✅ | ✅ | ✅ | ❌ |
| Diagnosa ICD-10 | ✅ | ✅ | ✅ | ❌ |
| Tindakan Medis | ✅ | ✅ | ✅ | ❌ |
| Catatan SOAP (Rawat Inap) | ✅ | ✅ | ✅ | ❌ |
| Surat Rujukan | ✅ | ✅ | ✅ | ❌ |
| Surat Keterangan Sakit | ✅ | ✅ | ✅ | ❌ |
| Surat Keterangan Sehat | ✅ | ✅ | ✅ | ❌ |
| Vital Sign (view) | ❌ | ✅ | ❌ | ❌ |
| Antrian Hari Ini (view) | ❌ | ✅ | ❌ | ❌ |
| Data Pasien (view) | ❌ | ✅ | ❌ | ❌ |
| Riwayat Kunjungan Pasien | ❌ | ✅ | ❌ | ❌ |

### 🟢 Perawat
| Modul | C | R | U | D |
|-------|---|---|---|---|
| Registrasi Kunjungan | ✅ | ✅ | ✅ | ❌ |
| Manajemen Antrian | ✅ | ✅ | ✅ | ❌ |
| Vital Sign | ✅ | ✅ | ✅ | ❌ |
| Tindakan Keperawatan | ✅ | ✅ | ✅ | ❌ |
| Data Pasien (view) | ❌ | ✅ | ❌ | ❌ |
| Rekam Medis (view) | ❌ | ✅ | ❌ | ❌ |

### 🟡 Rekam Medis
| Modul | C | R | U | D |
|-------|---|---|---|---|
| Registrasi & Edit Pasien | ✅ | ✅ | ✅ | ❌ |
| Registrasi Kunjungan | ✅ | ✅ | ✅ | ❌ |
| Arsip & Cetak Rekam Medis | ✅ | ✅ | ❌ | ❌ |
| ICD-10 Coding | ✅ | ✅ | ✅ | ❌ |
| Laporan EMIRA | ❌ | ✅ | ❌ | ❌ |
| Master Poli, Dokter, Jadwal | ✅ | ✅ | ✅ | ❌ |
| Surat Rujukan (view & cetak) | ❌ | ✅ | ❌ | ❌ |

---

## 🗃️ STRUKTUR DATABASE EMIRA (24 Tabel)

### A. Manajemen Pengguna

#### 1. `roles`
```sql
id, name ENUM(superadmin|dokter|perawat|rekam_medis),
display_name, description, created_at, updated_at
```

#### 2. `users`
```sql
id, name, email UNIQUE, password, role_id FK→roles,
is_active BOOL DEFAULT 1, foto, last_login_at,
remember_token, email_verified_at, created_at, updated_at
```

### B. Master Data

#### 3. `polis`
```sql
id, kode_poli UNIQUE, nama_poli, deskripsi, lantai, is_active,
created_at, updated_at
```

#### 4. `dokters`
```sql
id, user_id FK→users, nip, no_sip, no_str,
gelar_depan, nama_lengkap, gelar_belakang, spesialisasi,
poli_id FK→polis, no_hp, foto, is_active, created_at, updated_at
```

#### 5. `jadwal_dokters`
```sql
id, dokter_id FK→dokters, poli_id FK→polis,
hari ENUM(senin|selasa|rabu|kamis|jumat|sabtu|minggu),
jam_mulai TIME, jam_selesai TIME, kuota_pasien INT DEFAULT 20,
is_active BOOL, created_at, updated_at
```

#### 6. `ruangans`
```sql
id, kode_ruangan UNIQUE, nama_ruangan,
jenis ENUM(rawat_inap|icu|ugd|isolasi|vip),
kapasitas INT, lantai, is_active, created_at, updated_at
```

#### 7. `icd10_masters`
```sql
id, kode UNIQUE, nama_penyakit_indonesia, nama_penyakit_inggris,
kategori, is_active, created_at, updated_at
```

#### 8. `master_tindakans`
```sql
id, kode_tindakan UNIQUE, nama_tindakan, kategori,
keterangan, is_active, created_at, updated_at
```

#### 9. `pengaturans`
```sql
id, key UNIQUE, value TEXT, group ENUM(umum|tampilan|cetak),
deskripsi, created_at, updated_at
```

### C. Pasien & Kunjungan

#### 10. `pasiens`
```sql
id, no_rm UNIQUE, nik UNIQUE, nama_lengkap, nama_panggilan,
tempat_lahir, tanggal_lahir DATE, jenis_kelamin ENUM(L|P),
golongan_darah ENUM(A|B|AB|O|tidak_diketahui),
rhesus ENUM(+|-|tidak_diketahui),
agama, status_pernikahan ENUM(belum_menikah|menikah|cerai_hidup|cerai_mati),
pendidikan, pekerjaan, no_hp, no_hp_darurat,
nama_kontak_darurat, hubungan_kontak_darurat,
email, alamat TEXT, kelurahan, kecamatan, kabupaten_kota, provinsi, kode_pos,
foto, jenis_pembayaran ENUM(umum|bpjs) DEFAULT umum, no_bpjs,
catatan_alergi TEXT, catatan_khusus TEXT,
is_active BOOL, created_at, updated_at, deleted_at
```

#### 11. `antrians`
```sql
id, kode_antrian VARCHAR(10), no_urut INT,
pasien_id FK→pasiens, poli_id FK→polis, dokter_id FK→dokters,
tanggal DATE, sumber ENUM(loket|online) DEFAULT loket,
status ENUM(menunggu|dipanggil|dalam_pelayanan|selesai|tidak_hadir) DEFAULT menunggu,
jam_daftar TIMESTAMP, jam_dipanggil TIMESTAMP NULL, jam_selesai TIMESTAMP NULL,
created_at, updated_at
```

#### 12. `kunjungans`
```sql
id, no_kunjungan UNIQUE, pasien_id FK→pasiens,
dokter_id FK→dokters, poli_id FK→polis, antrian_id FK→antrians,
tanggal_kunjungan DATE, jam_datang TIME, jam_dilayani TIME, jam_selesai TIME,
jenis_kunjungan ENUM(rawat_jalan|rawat_inap|ugd|kontrol),
jenis_pembayaran ENUM(umum|bpjs), no_bpjs_kunjungan,
keluhan_utama TEXT,
status ENUM(menunggu|dipanggil|dalam_pemeriksaan|selesai|dibatalkan) DEFAULT menunggu,
catatan_pendaftaran TEXT, registered_by FK→users,
created_at, updated_at
```

### D. Rekam Medis

#### 13. `rekam_medis`
```sql
id, no_rm_kunjungan UNIQUE,
kunjungan_id FK→kunjungans, pasien_id FK→pasiens, dokter_id FK→dokters,
tanggal_periksa DATETIME,
anamnesis TEXT, riwayat_penyakit_dahulu TEXT, riwayat_penyakit_keluarga TEXT,
riwayat_alergi TEXT, riwayat_obat_rutin TEXT,
catatan_dokter TEXT, rencana_tindak_lanjut TEXT,
created_at, updated_at, deleted_at
```

#### 14. `vital_signs`
```sql
id, kunjungan_id FK→kunjungans, pasien_id FK→pasiens,
tekanan_darah_sistol INT, tekanan_darah_diastol INT,
nadi INT, pernapasan INT, suhu DECIMAL(4,1),
saturasi_oksigen DECIMAL(5,2), berat_badan DECIMAL(6,2),
tinggi_badan DECIMAL(5,2), bmi DECIMAL(5,2),
lingkar_perut DECIMAL(5,2), gula_darah_sewaktu INT,
kesadaran ENUM(composmentis|apatis|somnolen|sopor|koma),
catatan TEXT, recorded_by FK→users,
created_at, updated_at
```

#### 15. `diagnosas`
```sql
id, rekam_medis_id FK→rekam_medis, icd10_id FK→icd10_masters,
jenis ENUM(utama|sekunder|komplikasi) DEFAULT utama,
keterangan_tambahan TEXT, created_at, updated_at
```

#### 16. `tindakan_medis`
```sql
id, rekam_medis_id FK→rekam_medis, kunjungan_id FK→kunjungans,
master_tindakan_id FK→master_tindakans,
dilakukan_oleh FK→users, tanggal_tindakan DATE, jam_tindakan TIME,
jumlah INT DEFAULT 1, keterangan TEXT, hasil TEXT,
created_at, updated_at
```

#### 17. `tindakan_keperawatans`
```sql
id, kunjungan_id FK→kunjungans, pasien_id FK→pasiens,
perawat_id FK→users, jenis_tindakan VARCHAR(200),
deskripsi TEXT, waktu_tindakan DATETIME, respons_pasien TEXT,
created_at, updated_at
```

### E. Rawat Inap

#### 18. `rawat_inaps`
```sql
id, no_rawat_inap UNIQUE,
kunjungan_id FK→kunjungans, pasien_id FK→pasiens,
dokter_id FK→dokters, ruangan_id FK→ruangans,
no_tempat_tidur VARCHAR(10),
tanggal_masuk DATE, jam_masuk TIME,
tanggal_keluar DATE NULL, jam_keluar TIME NULL,
kondisi_masuk TEXT, kondisi_keluar TEXT,
cara_keluar ENUM(pulang_biasa|atas_permintaan_sendiri|meninggal|rujuk|pindah_ruangan),
status ENUM(aktif|selesai) DEFAULT aktif,
created_at, updated_at
```

#### 19. `perkembangan_pasiens`
```sql
id, rawat_inap_id FK→rawat_inaps, pasien_id FK→pasiens,
tanggal DATE, jam TIME,
soap_subjective TEXT, soap_objective TEXT,
soap_assessment TEXT, soap_plan TEXT,
dicatat_oleh FK→users, created_at, updated_at
```

### F. Surat & Dokumen

#### 20. `surat_rujukans`
```sql
id, no_surat UNIQUE, kunjungan_id FK→kunjungans,
pasien_id FK→pasiens, dokter_id FK→dokters, icd10_id FK→icd10_masters,
tujuan_fasilitas, dokter_tujuan, spesialisasi_tujuan,
anamnesis_singkat TEXT, terapi_diberikan TEXT, alasan_rujukan TEXT,
jenis_rujukan ENUM(internal|eksternal|balik), tanggal_surat DATE,
created_at, updated_at
```

#### 21. `surat_keterangan_sakits`
```sql
id, no_surat UNIQUE, kunjungan_id FK→kunjungans,
pasien_id FK→pasiens, dokter_id FK→dokters,
tanggal_awal_sakit DATE, tanggal_akhir_sakit DATE, jumlah_hari INT,
diagnosa_singkat, keterangan TEXT, tanggal_surat DATE,
created_at, updated_at
```

#### 22. `surat_keterangan_sehats`
```sql
id, no_surat UNIQUE, kunjungan_id FK→kunjungans,
pasien_id FK→pasiens, dokter_id FK→dokters,
keperluan VARCHAR(300), keterangan TEXT, tanggal_surat DATE,
created_at, updated_at
```

### G. Sistem

#### 23. `activity_logs`
```sql
id, user_id FK→users,
action ENUM(login|logout|create|update|delete|view|print),
module VARCHAR(100), referensi_id BIGINT NULL, referensi_type VARCHAR(100) NULL,
deskripsi TEXT, ip_address VARCHAR(50), user_agent TEXT,
created_at
```

#### 24. `notifikasis`
```sql
id, user_id FK→users, judul VARCHAR(200), pesan TEXT,
jenis ENUM(info|sukses|peringatan|bahaya) DEFAULT info,
is_read BOOL DEFAULT 0, link VARCHAR(500) NULL,
created_at, updated_at
```

---

## 🔗 RELASI TABEL

```
roles          ──(1:N)──  users
users          ──(1:1)──  dokters
polis          ──(1:N)──  dokters
polis          ──(1:N)──  jadwal_dokters
dokters        ──(1:N)──  jadwal_dokters
pasiens        ──(1:N)──  antrians
pasiens        ──(1:N)──  kunjungans
dokters        ──(1:N)──  kunjungans
polis          ──(1:N)──  kunjungans
antrians       ──(1:1)──  kunjungans
kunjungans     ──(1:1)──  rekam_medis
kunjungans     ──(1:N)──  vital_signs
kunjungans     ──(1:N)──  tindakan_medis
kunjungans     ──(1:N)──  tindakan_keperawatans
kunjungans     ──(1:1)──  rawat_inaps
kunjungans     ──(1:N)──  surat_rujukans
kunjungans     ──(1:N)──  surat_keterangan_sakits
kunjungans     ──(1:N)──  surat_keterangan_sehats
rekam_medis    ──(1:N)──  diagnosas
rekam_medis    ──(1:N)──  tindakan_medis
diagnosas      ──(N:1)──  icd10_masters
tindakan_medis ──(N:1)──  master_tindakans
rawat_inaps    ──(N:1)──  ruangans
rawat_inaps    ──(1:N)──  perkembangan_pasiens
users          ──(1:N)──  activity_logs
users          ──(1:N)──  notifikasis
```

---

## 🌱 SEEDER EMIRA

### DatabaseSeeder.php
```php
<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PoliSeeder::class,
            DokterSeeder::class,
            JadwalDokterSeeder::class,
            RuanganSeeder::class,
            Icd10Seeder::class,
            MasterTindakanSeeder::class,
            PengaturanSeeder::class,
            PasienSeeder::class,
            AntrianKunjunganSeeder::class,
            RekamMedisSeeder::class,
        ]);
    }
}
```

---

### RoleSeeder.php
```php
<?php
// database/seeders/RoleSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name'         => 'superadmin',
                'display_name' => 'Super Admin',
                'description'  => 'Akses penuh ke seluruh sistem EMIRA',
            ],
            [
                'name'         => 'dokter',
                'display_name' => 'Dokter',
                'description'  => 'Input rekam medis, diagnosa, tindakan medis, dan surat keterangan',
            ],
            [
                'name'         => 'perawat',
                'display_name' => 'Perawat',
                'description'  => 'Kelola antrian, vital sign, dan tindakan keperawatan',
            ],
            [
                'name'         => 'rekam_medis',
                'display_name' => 'Rekam Medis',
                'description'  => 'Registrasi pasien, arsip rekam medis, dan laporan EMIRA',
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(['name' => $role['name']], array_merge($role, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ RoleSeeder: 4 role EMIRA berhasil dibuat.');
    }
}
```

---

### UserSeeder.php
```php
<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superadminId  = DB::table('roles')->where('name', 'superadmin')->value('id');
        $dokterId      = DB::table('roles')->where('name', 'dokter')->value('id');
        $perawatId     = DB::table('roles')->where('name', 'perawat')->value('id');
        $rekamMedisId  = DB::table('roles')->where('name', 'rekam_medis')->value('id');

        $users = [
            // ── Super Admin ──────────────────────────────
            [
                'name'              => 'Administrator EMIRA',
                'email'             => 'superadmin@emira.app',
                'password'          => Hash::make('emira@superadmin'),
                'role_id'           => $superadminId,
                'is_active'         => 1,
                'email_verified_at' => now(),
            ],

            // ── Dokter ───────────────────────────────────
            [
                'name'              => 'dr. Andi Wijaya, Sp.PD',
                'email'             => 'andi.wijaya@emira.app',
                'password'          => Hash::make('dokter123'),
                'role_id'           => $dokterId,
                'is_active'         => 1,
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'dr. Siti Rahayu, Sp.A',
                'email'             => 'siti.rahayu@emira.app',
                'password'          => Hash::make('dokter123'),
                'role_id'           => $dokterId,
                'is_active'         => 1,
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'drg. Budi Santoso',
                'email'             => 'budi.santoso@emira.app',
                'password'          => Hash::make('dokter123'),
                'role_id'           => $dokterId,
                'is_active'         => 1,
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'dr. Maya Putri, Sp.OG',
                'email'             => 'maya.putri@emira.app',
                'password'          => Hash::make('dokter123'),
                'role_id'           => $dokterId,
                'is_active'         => 1,
                'email_verified_at' => now(),
            ],

            // ── Perawat ──────────────────────────────────
            [
                'name'              => 'Ns. Rina Susanti, S.Kep',
                'email'             => 'rina.susanti@emira.app',
                'password'          => Hash::make('perawat123'),
                'role_id'           => $perawatId,
                'is_active'         => 1,
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Ns. Doni Prasetyo, S.Kep',
                'email'             => 'doni.prasetyo@emira.app',
                'password'          => Hash::make('perawat123'),
                'role_id'           => $perawatId,
                'is_active'         => 1,
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Ns. Lestari Dewi, S.Kep',
                'email'             => 'lestari.dewi@emira.app',
                'password'          => Hash::make('perawat123'),
                'role_id'           => $perawatId,
                'is_active'         => 1,
                'email_verified_at' => now(),
            ],

            // ── Rekam Medis ──────────────────────────────
            [
                'name'              => 'Ahmad Fauzi, A.Md.RMIK',
                'email'             => 'ahmad.fauzi@emira.app',
                'password'          => Hash::make('rekammedis123'),
                'role_id'           => $rekamMedisId,
                'is_active'         => 1,
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Dewi Kurniawati, A.Md.RMIK',
                'email'             => 'dewi.kurniawati@emira.app',
                'password'          => Hash::make('rekammedis123'),
                'role_id'           => $rekamMedisId,
                'is_active'         => 1,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(['email' => $user['email']], array_merge($user, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ UserSeeder: 10 user EMIRA berhasil dibuat.');
        $this->command->table(
            ['Email', 'Role', 'Password'],
            [
                ['superadmin@emira.app',    'Super Admin',  'emira@superadmin'],
                ['andi.wijaya@emira.app',   'Dokter',       'dokter123'],
                ['siti.rahayu@emira.app',   'Dokter',       'dokter123'],
                ['budi.santoso@emira.app',  'Dokter',       'dokter123'],
                ['maya.putri@emira.app',    'Dokter',       'dokter123'],
                ['rina.susanti@emira.app',  'Perawat',      'perawat123'],
                ['doni.prasetyo@emira.app', 'Perawat',      'perawat123'],
                ['lestari.dewi@emira.app',  'Perawat',      'perawat123'],
                ['ahmad.fauzi@emira.app',   'Rekam Medis',  'rekammedis123'],
                ['dewi.kurniawati@emira.app','Rekam Medis', 'rekammedis123'],
            ]
        );
    }
}
```

---

### PoliSeeder.php
```php
<?php
// database/seeders/PoliSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        $polis = [
            ['kode_poli' => 'UMUM',    'nama_poli' => 'Poli Umum',          'deskripsi' => 'Pelayanan kesehatan umum untuk semua keluhan', 'lantai' => '1'],
            ['kode_poli' => 'DALAM',   'nama_poli' => 'Poli Penyakit Dalam', 'deskripsi' => 'Penanganan penyakit dalam dan metabolik',       'lantai' => '1'],
            ['kode_poli' => 'ANAK',    'nama_poli' => 'Poli Anak',          'deskripsi' => 'Pelayanan kesehatan anak (pediatri)',            'lantai' => '1'],
            ['kode_poli' => 'GIGI',    'nama_poli' => 'Poli Gigi & Mulut',  'deskripsi' => 'Pelayanan kesehatan gigi dan mulut',             'lantai' => '2'],
            ['kode_poli' => 'KANDUNGAN','nama_poli'=> 'Poli Kandungan',     'deskripsi' => 'Pelayanan obstetri dan ginekologi',              'lantai' => '2'],
            ['kode_poli' => 'UGD',     'nama_poli' => 'Unit Gawat Darurat', 'deskripsi' => 'Penanganan kasus gawat darurat 24 jam',          'lantai' => '1'],
        ];

        foreach ($polis as $poli) {
            DB::table('polis')->updateOrInsert(['kode_poli' => $poli['kode_poli']], array_merge($poli, [
                'is_active'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ PoliSeeder: 6 poli berhasil dibuat.');
    }
}
```

---

### DokterSeeder.php
```php
<?php
// database/seeders/DokterSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $poliUmum      = DB::table('polis')->where('kode_poli', 'UMUM')->value('id');
        $poliDalam     = DB::table('polis')->where('kode_poli', 'DALAM')->value('id');
        $poliAnak      = DB::table('polis')->where('kode_poli', 'ANAK')->value('id');
        $poliGigi      = DB::table('polis')->where('kode_poli', 'GIGI')->value('id');
        $poliKandungan = DB::table('polis')->where('kode_poli', 'KANDUNGAN')->value('id');

        $userAndi  = DB::table('users')->where('email', 'andi.wijaya@emira.app')->value('id');
        $userSiti  = DB::table('users')->where('email', 'siti.rahayu@emira.app')->value('id');
        $userBudi  = DB::table('users')->where('email', 'budi.santoso@emira.app')->value('id');
        $userMaya  = DB::table('users')->where('email', 'maya.putri@emira.app')->value('id');

        $dokters = [
            [
                'user_id'      => $userAndi,
                'nip'          => 'NIP-2019-001',
                'no_sip'       => 'SIP/DKI/2019/001234',
                'no_str'       => 'STR/PD/2019/005678',
                'gelar_depan'  => 'dr.',
                'nama_lengkap' => 'Andi Wijaya',
                'gelar_belakang' => 'Sp.PD',
                'spesialisasi' => 'Spesialis Penyakit Dalam',
                'poli_id'      => $poliDalam,
                'no_hp'        => '081234567801',
            ],
            [
                'user_id'      => $userSiti,
                'nip'          => 'NIP-2020-002',
                'no_sip'       => 'SIP/DKI/2020/002345',
                'no_str'       => 'STR/A/2020/006789',
                'gelar_depan'  => 'dr.',
                'nama_lengkap' => 'Siti Rahayu',
                'gelar_belakang' => 'Sp.A',
                'spesialisasi' => 'Spesialis Anak',
                'poli_id'      => $poliAnak,
                'no_hp'        => '081234567802',
            ],
            [
                'user_id'      => $userBudi,
                'nip'          => 'NIP-2018-003',
                'no_sip'       => 'SIP/DKI/2018/003456',
                'no_str'       => 'STR/GIG/2018/007890',
                'gelar_depan'  => 'drg.',
                'nama_lengkap' => 'Budi Santoso',
                'gelar_belakang' => null,
                'spesialisasi' => 'Dokter Gigi Umum',
                'poli_id'      => $poliGigi,
                'no_hp'        => '081234567803',
            ],
            [
                'user_id'      => $userMaya,
                'nip'          => 'NIP-2021-004',
                'no_sip'       => 'SIP/DKI/2021/004567',
                'no_str'       => 'STR/OG/2021/008901',
                'gelar_depan'  => 'dr.',
                'nama_lengkap' => 'Maya Putri',
                'gelar_belakang' => 'Sp.OG',
                'spesialisasi' => 'Spesialis Obstetri & Ginekologi',
                'poli_id'      => $poliKandungan,
                'no_hp'        => '081234567804',
            ],
        ];

        foreach ($dokters as $dokter) {
            DB::table('dokters')->updateOrInsert(['user_id' => $dokter['user_id']], array_merge($dokter, [
                'is_active'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ DokterSeeder: 4 dokter berhasil dibuat.');
    }
}
```

---

### JadwalDokterSeeder.php
```php
<?php
// database/seeders/JadwalDokterSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalDokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokterAndi  = DB::table('dokters')->whereHas ?? DB::table('dokters')->where('nama_lengkap', 'Andi Wijaya')->value('id');
        $dokterSiti  = DB::table('dokters')->where('nama_lengkap', 'Siti Rahayu')->value('id');
        $dokterBudi  = DB::table('dokters')->where('nama_lengkap', 'Budi Santoso')->value('id');
        $dokterMaya  = DB::table('dokters')->where('nama_lengkap', 'Maya Putri')->value('id');

        $poliDalam     = DB::table('polis')->where('kode_poli', 'DALAM')->value('id');
        $poliAnak      = DB::table('polis')->where('kode_poli', 'ANAK')->value('id');
        $poliGigi      = DB::table('polis')->where('kode_poli', 'GIGI')->value('id');
        $poliKandungan = DB::table('polis')->where('kode_poli', 'KANDUNGAN')->value('id');

        $jadwals = [
            // dr. Andi — Penyakit Dalam: Senin-Jumat pagi
            ['dokter_id' => $dokterAndi, 'poli_id' => $poliDalam, 'hari' => 'senin',  'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],
            ['dokter_id' => $dokterAndi, 'poli_id' => $poliDalam, 'hari' => 'selasa', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],
            ['dokter_id' => $dokterAndi, 'poli_id' => $poliDalam, 'hari' => 'rabu',   'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],
            ['dokter_id' => $dokterAndi, 'poli_id' => $poliDalam, 'hari' => 'kamis',  'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],
            ['dokter_id' => $dokterAndi, 'poli_id' => $poliDalam, 'hari' => 'jumat',  'jam_mulai' => '08:00', 'jam_selesai' => '11:00', 'kuota_pasien' => 15],

            // dr. Siti — Anak: Senin, Rabu, Jumat pagi + Selasa sore
            ['dokter_id' => $dokterSiti, 'poli_id' => $poliAnak, 'hari' => 'senin',  'jam_mulai' => '09:00', 'jam_selesai' => '13:00', 'kuota_pasien' => 25],
            ['dokter_id' => $dokterSiti, 'poli_id' => $poliAnak, 'hari' => 'selasa', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterSiti, 'poli_id' => $poliAnak, 'hari' => 'rabu',   'jam_mulai' => '09:00', 'jam_selesai' => '13:00', 'kuota_pasien' => 25],
            ['dokter_id' => $dokterSiti, 'poli_id' => $poliAnak, 'hari' => 'jumat',  'jam_mulai' => '09:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],

            // drg. Budi — Gigi: Selasa-Sabtu
            ['dokter_id' => $dokterBudi, 'poli_id' => $poliGigi, 'hari' => 'selasa', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterBudi, 'poli_id' => $poliGigi, 'hari' => 'rabu',   'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterBudi, 'poli_id' => $poliGigi, 'hari' => 'kamis',  'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterBudi, 'poli_id' => $poliGigi, 'hari' => 'jumat',  'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterBudi, 'poli_id' => $poliGigi, 'hari' => 'sabtu',  'jam_mulai' => '08:00', 'jam_selesai' => '11:00', 'kuota_pasien' => 8],

            // dr. Maya — Kandungan: Senin, Kamis pagi + Rabu sore
            ['dokter_id' => $dokterMaya, 'poli_id' => $poliKandungan, 'hari' => 'senin', 'jam_mulai' => '10:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterMaya, 'poli_id' => $poliKandungan, 'hari' => 'rabu',  'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 12],
            ['dokter_id' => $dokterMaya, 'poli_id' => $poliKandungan, 'hari' => 'kamis', 'jam_mulai' => '10:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 15],
        ];

        DB::table('jadwal_dokters')->delete();
        foreach ($jadwals as $jadwal) {
            DB::table('jadwal_dokters')->insert(array_merge($jadwal, [
                'is_active'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ JadwalDokterSeeder: 17 jadwal praktik berhasil dibuat.');
    }
}
```

---

### RuanganSeeder.php
```php
<?php
// database/seeders/RuanganSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $ruangans = [
            ['kode_ruangan' => 'VIP-01',   'nama_ruangan' => 'Ruang VIP Mawar',      'jenis' => 'vip',       'kapasitas' => 1, 'lantai' => '3'],
            ['kode_ruangan' => 'VIP-02',   'nama_ruangan' => 'Ruang VIP Melati',     'jenis' => 'vip',       'kapasitas' => 1, 'lantai' => '3'],
            ['kode_ruangan' => 'KELAS1-A', 'nama_ruangan' => 'Kelas 1 - Anggrek A', 'jenis' => 'rawat_inap','kapasitas' => 2, 'lantai' => '2'],
            ['kode_ruangan' => 'KELAS1-B', 'nama_ruangan' => 'Kelas 1 - Anggrek B', 'jenis' => 'rawat_inap','kapasitas' => 2, 'lantai' => '2'],
            ['kode_ruangan' => 'KELAS2-A', 'nama_ruangan' => 'Kelas 2 - Dahlia A',  'jenis' => 'rawat_inap','kapasitas' => 4, 'lantai' => '2'],
            ['kode_ruangan' => 'KELAS2-B', 'nama_ruangan' => 'Kelas 2 - Dahlia B',  'jenis' => 'rawat_inap','kapasitas' => 4, 'lantai' => '2'],
            ['kode_ruangan' => 'KELAS3-A', 'nama_ruangan' => 'Kelas 3 - Flamboyan', 'jenis' => 'rawat_inap','kapasitas' => 6, 'lantai' => '2'],
            ['kode_ruangan' => 'ICU-01',   'nama_ruangan' => 'ICU Umum',             'jenis' => 'icu',       'kapasitas' => 4, 'lantai' => '3'],
            ['kode_ruangan' => 'ISO-01',   'nama_ruangan' => 'Ruang Isolasi A',      'jenis' => 'isolasi',   'kapasitas' => 2, 'lantai' => '3'],
        ];

        foreach ($ruangans as $ruangan) {
            DB::table('ruangans')->updateOrInsert(['kode_ruangan' => $ruangan['kode_ruangan']], array_merge($ruangan, [
                'is_active'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ RuanganSeeder: 9 ruangan berhasil dibuat.');
    }
}
```

---

### Icd10Seeder.php
```php
<?php
// database/seeders/Icd10Seeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Icd10Seeder extends Seeder
{
    public function run(): void
    {
        $icd10s = [
            // Infeksi & Parasit
            ['kode' => 'A09',  'nama_penyakit_indonesia' => 'Diare dan Gastroenteritis',           'nama_penyakit_inggris' => 'Diarrhoea and Gastroenteritis',         'kategori' => 'Penyakit Infeksi'],
            ['kode' => 'A15',  'nama_penyakit_indonesia' => 'Tuberkulosis Paru',                   'nama_penyakit_inggris' => 'Tuberculosis of Lungs',                 'kategori' => 'Penyakit Infeksi'],
            ['kode' => 'A90',  'nama_penyakit_indonesia' => 'Demam Berdarah Dengue',               'nama_penyakit_inggris' => 'Dengue Haemorrhagic Fever',             'kategori' => 'Penyakit Infeksi'],
            ['kode' => 'A91',  'nama_penyakit_indonesia' => 'Demam Dengue',                        'nama_penyakit_inggris' => 'Dengue Fever',                          'kategori' => 'Penyakit Infeksi'],
            ['kode' => 'B34.9','nama_penyakit_indonesia' => 'Infeksi Virus Tidak Spesifik',        'nama_penyakit_inggris' => 'Viral Infection Unspecified',           'kategori' => 'Penyakit Infeksi'],

            // Penyakit Tidak Menular
            ['kode' => 'E10',  'nama_penyakit_indonesia' => 'Diabetes Melitus Tipe 1',             'nama_penyakit_inggris' => 'Type 1 Diabetes Mellitus',              'kategori' => 'Penyakit Metabolik'],
            ['kode' => 'E11',  'nama_penyakit_indonesia' => 'Diabetes Melitus Tipe 2',             'nama_penyakit_inggris' => 'Type 2 Diabetes Mellitus',              'kategori' => 'Penyakit Metabolik'],
            ['kode' => 'E78',  'nama_penyakit_indonesia' => 'Dislipidemia / Kolesterol Tinggi',    'nama_penyakit_inggris' => 'Disorders of Lipoprotein Metabolism',   'kategori' => 'Penyakit Metabolik'],
            ['kode' => 'E66',  'nama_penyakit_indonesia' => 'Obesitas',                            'nama_penyakit_inggris' => 'Obesity',                               'kategori' => 'Penyakit Metabolik'],

            // Penyakit Kardiovaskular
            ['kode' => 'I10',  'nama_penyakit_indonesia' => 'Hipertensi Esensial (Primer)',        'nama_penyakit_inggris' => 'Essential (Primary) Hypertension',      'kategori' => 'Penyakit Kardiovaskular'],
            ['kode' => 'I20',  'nama_penyakit_indonesia' => 'Angina Pektoris',                     'nama_penyakit_inggris' => 'Angina Pectoris',                       'kategori' => 'Penyakit Kardiovaskular'],
            ['kode' => 'I21',  'nama_penyakit_indonesia' => 'Infark Miokard Akut',                 'nama_penyakit_inggris' => 'Acute Myocardial Infarction',           'kategori' => 'Penyakit Kardiovaskular'],
            ['kode' => 'I50',  'nama_penyakit_indonesia' => 'Gagal Jantung',                       'nama_penyakit_inggris' => 'Heart Failure',                         'kategori' => 'Penyakit Kardiovaskular'],

            // Penyakit Pernapasan
            ['kode' => 'J00',  'nama_penyakit_indonesia' => 'Nasofaringitis Akut (Pilek)',         'nama_penyakit_inggris' => 'Acute Nasopharyngitis (Common Cold)',   'kategori' => 'Penyakit Pernapasan'],
            ['kode' => 'J06',  'nama_penyakit_indonesia' => 'Infeksi Saluran Napas Atas Akut',    'nama_penyakit_inggris' => 'Acute Upper Respiratory Infections',    'kategori' => 'Penyakit Pernapasan'],
            ['kode' => 'J18',  'nama_penyakit_indonesia' => 'Pneumonia',                           'nama_penyakit_inggris' => 'Pneumonia',                             'kategori' => 'Penyakit Pernapasan'],
            ['kode' => 'J45',  'nama_penyakit_indonesia' => 'Asma',                                'nama_penyakit_inggris' => 'Asthma',                                'kategori' => 'Penyakit Pernapasan'],
            ['kode' => 'J20',  'nama_penyakit_indonesia' => 'Bronkitis Akut',                      'nama_penyakit_inggris' => 'Acute Bronchitis',                      'kategori' => 'Penyakit Pernapasan'],

            // Penyakit Pencernaan
            ['kode' => 'K21',  'nama_penyakit_indonesia' => 'Penyakit Refluks Gastroesofageal',   'nama_penyakit_inggris' => 'Gastro-Oesophageal Reflux Disease',    'kategori' => 'Penyakit Pencernaan'],
            ['kode' => 'K25',  'nama_penyakit_indonesia' => 'Ulkus Gaster (Tukak Lambung)',        'nama_penyakit_inggris' => 'Gastric Ulcer',                         'kategori' => 'Penyakit Pencernaan'],
            ['kode' => 'K29',  'nama_penyakit_indonesia' => 'Gastritis dan Duodenitis',            'nama_penyakit_inggris' => 'Gastritis and Duodenitis',              'kategori' => 'Penyakit Pencernaan'],
            ['kode' => 'K35',  'nama_penyakit_indonesia' => 'Apendisitis Akut',                    'nama_penyakit_inggris' => 'Acute Appendicitis',                    'kategori' => 'Penyakit Pencernaan'],
            ['kode' => 'K80',  'nama_penyakit_indonesia' => 'Kolelitiasis (Batu Empedu)',          'nama_penyakit_inggris' => 'Cholelithiasis',                        'kategori' => 'Penyakit Pencernaan'],

            // Penyakit Saraf
            ['kode' => 'G43',  'nama_penyakit_indonesia' => 'Migrain',                             'nama_penyakit_inggris' => 'Migraine',                              'kategori' => 'Penyakit Saraf'],
            ['kode' => 'G47',  'nama_penyakit_indonesia' => 'Gangguan Tidur (Insomnia)',           'nama_penyakit_inggris' => 'Sleep Disorders',                       'kategori' => 'Penyakit Saraf'],
            ['kode' => 'I63',  'nama_penyakit_indonesia' => 'Infark Serebral (Stroke Iskemik)',    'nama_penyakit_inggris' => 'Cerebral Infarction',                   'kategori' => 'Penyakit Saraf'],
            ['kode' => 'I64',  'nama_penyakit_indonesia' => 'Stroke Tidak Spesifik',               'nama_penyakit_inggris' => 'Stroke Not Specified',                  'kategori' => 'Penyakit Saraf'],

            // Gangguan Muskuloskeletal
            ['kode' => 'M06',  'nama_penyakit_indonesia' => 'Artritis Reumatoid',                  'nama_penyakit_inggris' => 'Rheumatoid Arthritis',                  'kategori' => 'Muskuloskeletal'],
            ['kode' => 'M10',  'nama_penyakit_indonesia' => 'Gout (Asam Urat)',                    'nama_penyakit_inggris' => 'Gout',                                  'kategori' => 'Muskuloskeletal'],
            ['kode' => 'M54',  'nama_penyakit_indonesia' => 'Nyeri Punggung Bawah (LBP)',          'nama_penyakit_inggris' => 'Dorsalgia (Low Back Pain)',             'kategori' => 'Muskuloskeletal'],
            ['kode' => 'M79',  'nama_penyakit_indonesia' => 'Mialgia (Nyeri Otot)',                'nama_penyakit_inggris' => 'Myalgia',                               'kategori' => 'Muskuloskeletal'],

            // Penyakit Kulit
            ['kode' => 'L20',  'nama_penyakit_indonesia' => 'Dermatitis Atopik',                   'nama_penyakit_inggris' => 'Atopic Dermatitis',                     'kategori' => 'Penyakit Kulit'],
            ['kode' => 'L50',  'nama_penyakit_indonesia' => 'Urtikaria (Biduran)',                 'nama_penyakit_inggris' => 'Urticaria',                             'kategori' => 'Penyakit Kulit'],

            // Cedera & Kecelakaan
            ['kode' => 'S00',  'nama_penyakit_indonesia' => 'Cedera Superfisial Kepala',           'nama_penyakit_inggris' => 'Superficial Injury of Head',            'kategori' => 'Cedera'],
            ['kode' => 'T14',  'nama_penyakit_indonesia' => 'Luka pada Bagian Tubuh Tidak Spesifik','nama_penyakit_inggris'=> 'Injury of Unspecified Body Region',     'kategori' => 'Cedera'],

            // Kehamilan & Persalinan
            ['kode' => 'O14',  'nama_penyakit_indonesia' => 'Preeklamsia',                         'nama_penyakit_inggris' => 'Pre-Eclampsia',                         'kategori' => 'Kehamilan'],
            ['kode' => 'O80',  'nama_penyakit_indonesia' => 'Persalinan Normal',                   'nama_penyakit_inggris' => 'Single Spontaneous Delivery',           'kategori' => 'Kehamilan'],
        ];

        foreach ($icd10s as $icd10) {
            DB::table('icd10_masters')->updateOrInsert(['kode' => $icd10['kode']], array_merge($icd10, [
                'is_active'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ Icd10Seeder: ' . count($icd10s) . ' kode ICD-10 berhasil dibuat.');
    }
}
```

---

### MasterTindakanSeeder.php
```php
<?php
// database/seeders/MasterTindakanSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterTindakanSeeder extends Seeder
{
    public function run(): void
    {
        $tindakans = [
            // Pemeriksaan Umum
            ['kode_tindakan' => 'PU-001', 'nama_tindakan' => 'Pemeriksaan Fisik Lengkap',       'kategori' => 'Pemeriksaan Umum'],
            ['kode_tindakan' => 'PU-002', 'nama_tindakan' => 'Konsultasi Dokter Spesialis',      'kategori' => 'Pemeriksaan Umum'],
            ['kode_tindakan' => 'PU-003', 'nama_tindakan' => 'Pengukuran Tekanan Darah',         'kategori' => 'Pemeriksaan Umum'],
            ['kode_tindakan' => 'PU-004', 'nama_tindakan' => 'Pemeriksaan EKG (Elektrokardiogram)','kategori' => 'Pemeriksaan Umum'],

            // Tindakan Minor
            ['kode_tindakan' => 'TM-001', 'nama_tindakan' => 'Pemasangan Infus',                 'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-002', 'nama_tindakan' => 'Injeksi Intravena (IV)',           'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-003', 'nama_tindakan' => 'Injeksi Intramuskular (IM)',       'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-004', 'nama_tindakan' => 'Perawatan Luka Sederhana',         'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-005', 'nama_tindakan' => 'Perawatan Luka Kompleks',          'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-006', 'nama_tindakan' => 'Penjahitan Luka (per jahitan)',    'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-007', 'nama_tindakan' => 'Pelepasan Jahitan',                'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-008', 'nama_tindakan' => 'Insisi Abses',                     'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-009', 'nama_tindakan' => 'Nebulisasi / Inhalasi',            'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-010', 'nama_tindakan' => 'Pemasangan Kateter Urin',          'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-011', 'nama_tindakan' => 'Pemasangan NGT (Nasogastric Tube)','kategori' => 'Tindakan Minor'],

            // Tindakan Gigi
            ['kode_tindakan' => 'GG-001', 'nama_tindakan' => 'Pencabutan Gigi Susu',             'kategori' => 'Tindakan Gigi'],
            ['kode_tindakan' => 'GG-002', 'nama_tindakan' => 'Pencabutan Gigi Permanen',         'kategori' => 'Tindakan Gigi'],
            ['kode_tindakan' => 'GG-003', 'nama_tindakan' => 'Penambalan Gigi (Komposit)',       'kategori' => 'Tindakan Gigi'],
            ['kode_tindakan' => 'GG-004', 'nama_tindakan' => 'Skeling / Pembersihan Karang Gigi','kategori' => 'Tindakan Gigi'],
            ['kode_tindakan' => 'GG-005', 'nama_tindakan' => 'Perawatan Saluran Akar (per kunjungan)', 'kategori' => 'Tindakan Gigi'],

            // Tindakan Kebidanan
            ['kode_tindakan' => 'KB-001', 'nama_tindakan' => 'Pemeriksaan Kehamilan (ANC)',      'kategori' => 'Tindakan Kebidanan'],
            ['kode_tindakan' => 'KB-002', 'nama_tindakan' => 'USG Obstetri',                     'kategori' => 'Tindakan Kebidanan'],
            ['kode_tindakan' => 'KB-003', 'nama_tindakan' => 'Persalinan Normal',                'kategori' => 'Tindakan Kebidanan'],
            ['kode_tindakan' => 'KB-004', 'nama_tindakan' => 'Pemasangan IUD',                   'kategori' => 'Tindakan Kebidanan'],
            ['kode_tindakan' => 'KB-005', 'nama_tindakan' => 'Pap Smear',                        'kategori' => 'Tindakan Kebidanan'],

            // Keperawatan
            ['kode_tindakan' => 'KP-001', 'nama_tindakan' => 'Pemberian Oksigen',                'kategori' => 'Keperawatan'],
            ['kode_tindakan' => 'KP-002', 'nama_tindakan' => 'Suction / Penghisapan Lendir',    'kategori' => 'Keperawatan'],
            ['kode_tindakan' => 'KP-003', 'nama_tindakan' => 'Monitor Tanda-Tanda Vital',        'kategori' => 'Keperawatan'],
            ['kode_tindakan' => 'KP-004', 'nama_tindakan' => 'Pemasangan Pulse Oximeter',        'kategori' => 'Keperawatan'],
        ];

        foreach ($tindakans as $t) {
            DB::table('master_tindakans')->updateOrInsert(['kode_tindakan' => $t['kode_tindakan']], array_merge($t, [
                'keterangan' => null,
                'is_active'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ MasterTindakanSeeder: ' . count($tindakans) . ' tindakan berhasil dibuat.');
    }
}
```

---

### PengaturanSeeder.php
```php
<?php
// database/seeders/PengaturanSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        $pengaturans = [
            // Grup: Umum
            ['key' => 'app_name',           'value' => 'EMIRA',                                         'group' => 'umum', 'deskripsi' => 'Nama aplikasi'],
            ['key' => 'app_fullname',        'value' => 'Electronic Medical Integrated Record & Administration', 'group' => 'umum', 'deskripsi' => 'Nama lengkap aplikasi'],
            ['key' => 'nama_faskes',         'value' => 'Klinik Sehat Bersama',                         'group' => 'umum', 'deskripsi' => 'Nama fasilitas kesehatan'],
            ['key' => 'jenis_faskes',        'value' => 'Klinik Pratama',                               'group' => 'umum', 'deskripsi' => 'Jenis fasilitas kesehatan'],
            ['key' => 'alamat_faskes',       'value' => 'Jl. Kesehatan No. 1, Jakarta Pusat 10110',    'group' => 'umum', 'deskripsi' => 'Alamat lengkap fasilitas kesehatan'],
            ['key' => 'no_telp_faskes',      'value' => '(021) 555-0100',                               'group' => 'umum', 'deskripsi' => 'Nomor telepon fasilitas kesehatan'],
            ['key' => 'email_faskes',        'value' => 'info@kliniksehatbersama.co.id',               'group' => 'umum', 'deskripsi' => 'Email fasilitas kesehatan'],
            ['key' => 'no_izin_faskes',      'value' => 'No. 503/KLINIK/2020/001',                     'group' => 'umum', 'deskripsi' => 'Nomor izin operasional'],
            ['key' => 'tagline',             'value' => 'Satu Sistem, Rekam Medis Terintegrasi.',      'group' => 'umum', 'deskripsi' => 'Tagline EMIRA'],
            ['key' => 'jam_buka',            'value' => '07:00',                                        'group' => 'umum', 'deskripsi' => 'Jam buka operasional'],
            ['key' => 'jam_tutup',           'value' => '20:00',                                        'group' => 'umum', 'deskripsi' => 'Jam tutup operasional'],

            // Grup: Tampilan
            ['key' => 'warna_primer',        'value' => '#0A6EBD',                                      'group' => 'tampilan', 'deskripsi' => 'Warna primer sistem'],
            ['key' => 'warna_sekunder',      'value' => '#17B169',                                      'group' => 'tampilan', 'deskripsi' => 'Warna sekunder sistem'],
            ['key' => 'logo_path',           'value' => 'images/logo-emira.png',                        'group' => 'tampilan', 'deskripsi' => 'Path logo EMIRA'],
            ['key' => 'items_per_page',      'value' => '25',                                            'group' => 'tampilan', 'deskripsi' => 'Jumlah item per halaman di tabel'],

            // Grup: Cetak / Format Nomor
            ['key' => 'format_no_rm',        'value' => 'EMIRA-RM-{YYYY}-{000000}',                    'group' => 'cetak', 'deskripsi' => 'Format nomor rekam medis'],
            ['key' => 'format_no_kunjungan', 'value' => 'EMIRA-KJN-{YYYYMMDD}-{0000}',                'group' => 'cetak', 'deskripsi' => 'Format nomor kunjungan'],
            ['key' => 'format_no_antrian',   'value' => '{PREFIX}{000}',                               'group' => 'cetak', 'deskripsi' => 'Format nomor antrian (PREFIX = kode poli)'],
            ['key' => 'format_no_surat_rujukan', 'value' => 'EMIRA/RJK/{ROMAWI}/{YYYY}/{000}',        'group' => 'cetak', 'deskripsi' => 'Format nomor surat rujukan'],
            ['key' => 'format_no_surat_sakit',   'value' => 'EMIRA/SKS/{ROMAWI}/{YYYY}/{000}',        'group' => 'cetak', 'deskripsi' => 'Format nomor surat keterangan sakit'],
            ['key' => 'format_no_surat_sehat',   'value' => 'EMIRA/SKH/{ROMAWI}/{YYYY}/{000}',        'group' => 'cetak', 'deskripsi' => 'Format nomor surat keterangan sehat'],
            ['key' => 'kop_dokter_penanda_tangan','value' => 'Dokter Pemeriksa',                       'group' => 'cetak', 'deskripsi' => 'Label dokter penanda tangan di surat'],
        ];

        foreach ($pengaturans as $p) {
            DB::table('pengaturans')->updateOrInsert(['key' => $p['key']], array_merge($p, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ PengaturanSeeder: ' . count($pengaturans) . ' pengaturan EMIRA berhasil dibuat.');
    }
}
```

---

### PasienSeeder.php
```php
<?php
// database/seeders/PasienSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        $pasiens = [
            [
                'no_rm'            => 'EMIRA-RM-2024-000001',
                'nik'              => '3171050101900001',
                'nama_lengkap'     => 'Budi Santoso',
                'nama_panggilan'   => 'Budi',
                'tempat_lahir'     => 'Jakarta',
                'tanggal_lahir'    => '1990-01-01',
                'jenis_kelamin'    => 'L',
                'golongan_darah'   => 'O',
                'rhesus'           => '+',
                'agama'            => 'Islam',
                'status_pernikahan'=> 'menikah',
                'pekerjaan'        => 'Karyawan Swasta',
                'no_hp'            => '081234567890',
                'alamat'           => 'Jl. Merdeka No. 10, Jakarta Pusat',
                'kelurahan'        => 'Gambir',
                'kecamatan'        => 'Gambir',
                'kabupaten_kota'   => 'Jakarta Pusat',
                'provinsi'         => 'DKI Jakarta',
                'kode_pos'         => '10110',
                'jenis_pembayaran' => 'bpjs',
                'no_bpjs'          => '0001234567890',
                'catatan_alergi'   => null,
            ],
            [
                'no_rm'            => 'EMIRA-RM-2024-000002',
                'nik'              => '3171056505850002',
                'nama_lengkap'     => 'Siti Aminah',
                'nama_panggilan'   => 'Siti',
                'tempat_lahir'     => 'Bandung',
                'tanggal_lahir'    => '1985-05-25',
                'jenis_kelamin'    => 'P',
                'golongan_darah'   => 'A',
                'rhesus'           => '+',
                'agama'            => 'Islam',
                'status_pernikahan'=> 'menikah',
                'pekerjaan'        => 'Ibu Rumah Tangga',
                'no_hp'            => '081234567891',
                'alamat'           => 'Jl. Kebayoran Baru No. 5, Jakarta Selatan',
                'kelurahan'        => 'Kebayoran Baru',
                'kecamatan'        => 'Kebayoran Baru',
                'kabupaten_kota'   => 'Jakarta Selatan',
                'provinsi'         => 'DKI Jakarta',
                'kode_pos'         => '12110',
                'jenis_pembayaran' => 'umum',
                'no_bpjs'          => null,
                'catatan_alergi'   => 'Alergi penisilin',
            ],
            [
                'no_rm'            => 'EMIRA-RM-2024-000003',
                'nik'              => '3171051203780003',
                'nama_lengkap'     => 'Rudi Hermawan',
                'nama_panggilan'   => 'Rudi',
                'tempat_lahir'     => 'Surabaya',
                'tanggal_lahir'    => '1978-03-12',
                'jenis_kelamin'    => 'L',
                'golongan_darah'   => 'B',
                'rhesus'           => '+',
                'agama'            => 'Kristen',
                'status_pernikahan'=> 'menikah',
                'pekerjaan'        => 'Wiraswasta',
                'no_hp'            => '081234567892',
                'alamat'           => 'Jl. Sudirman No. 88, Jakarta Pusat',
                'kelurahan'        => 'Tanah Abang',
                'kecamatan'        => 'Tanah Abang',
                'kabupaten_kota'   => 'Jakarta Pusat',
                'provinsi'         => 'DKI Jakarta',
                'kode_pos'         => '10250',
                'jenis_pembayaran' => 'bpjs',
                'no_bpjs'          => '0001234567891',
                'catatan_alergi'   => null,
            ],
            [
                'no_rm'            => 'EMIRA-RM-2024-000004',
                'nik'              => '3171044408920004',
                'nama_lengkap'     => 'Dewi Lestari',
                'nama_panggilan'   => 'Dewi',
                'tempat_lahir'     => 'Yogyakarta',
                'tanggal_lahir'    => '1992-08-04',
                'jenis_kelamin'    => 'P',
                'golongan_darah'   => 'AB',
                'rhesus'           => '+',
                'agama'            => 'Islam',
                'status_pernikahan'=> 'menikah',
                'pekerjaan'        => 'Guru',
                'no_hp'            => '081234567893',
                'alamat'           => 'Jl. Fatmawati No. 33, Jakarta Selatan',
                'kelurahan'        => 'Cipete',
                'kecamatan'        => 'Cilandak',
                'kabupaten_kota'   => 'Jakarta Selatan',
                'provinsi'         => 'DKI Jakarta',
                'kode_pos'         => '12430',
                'jenis_pembayaran' => 'umum',
                'no_bpjs'          => null,
                'catatan_alergi'   => 'Alergi sulfa',
            ],
            [
                'no_rm'            => 'EMIRA-RM-2024-000005',
                'nik'              => '3171052910650005',
                'nama_lengkap'     => 'Hendra Gunawan',
                'nama_panggilan'   => 'Hendra',
                'tempat_lahir'     => 'Medan',
                'tanggal_lahir'    => '1965-10-29',
                'jenis_kelamin'    => 'L',
                'golongan_darah'   => 'O',
                'rhesus'           => '-',
                'agama'            => 'Buddha',
                'status_pernikahan'=> 'menikah',
                'pekerjaan'        => 'Pensiunan',
                'no_hp'            => '081234567894',
                'no_hp_darurat'    => '081234567895',
                'nama_kontak_darurat' => 'Linda Gunawan',
                'hubungan_kontak_darurat' => 'Istri',
                'alamat'           => 'Jl. Pluit Raya No. 15, Jakarta Utara',
                'kelurahan'        => 'Pluit',
                'kecamatan'        => 'Penjaringan',
                'kabupaten_kota'   => 'Jakarta Utara',
                'provinsi'         => 'DKI Jakarta',
                'kode_pos'         => '14450',
                'jenis_pembayaran' => 'bpjs',
                'no_bpjs'          => '0001234567892',
                'catatan_alergi'   => 'Alergi aspirin, NSAID',
            ],
            [
                'no_rm'            => 'EMIRA-RM-2024-000006',
                'nik'              => '3171046607010006',
                'nama_lengkap'     => 'Putri Handayani',
                'nama_panggilan'   => 'Putri',
                'tempat_lahir'     => 'Semarang',
                'tanggal_lahir'    => '2001-07-26',
                'jenis_kelamin'    => 'P',
                'golongan_darah'   => 'A',
                'rhesus'           => '+',
                'agama'            => 'Katholik',
                'status_pernikahan'=> 'belum_menikah',
                'pekerjaan'        => 'Mahasiswa',
                'no_hp'            => '081234567896',
                'no_hp_darurat'    => '081234567897',
                'nama_kontak_darurat' => 'Handayani',
                'hubungan_kontak_darurat' => 'Ibu',
                'alamat'           => 'Jl. Tebet Raya No. 77, Jakarta Selatan',
                'kelurahan'        => 'Tebet',
                'kecamatan'        => 'Tebet',
                'kabupaten_kota'   => 'Jakarta Selatan',
                'provinsi'         => 'DKI Jakarta',
                'kode_pos'         => '12820',
                'jenis_pembayaran' => 'umum',
                'no_bpjs'          => null,
                'catatan_alergi'   => null,
            ],
            [
                'no_rm'            => 'EMIRA-RM-2024-000007',
                'nik'              => '3171052307720007',
                'nama_lengkap'     => 'Agus Setiawan',
                'nama_panggilan'   => 'Agus',
                'tempat_lahir'     => 'Malang',
                'tanggal_lahir'    => '1972-07-23',
                'jenis_kelamin'    => 'L',
                'golongan_darah'   => 'B',
                'rhesus'           => '+',
                'agama'            => 'Islam',
                'status_pernikahan'=> 'menikah',
                'pekerjaan'        => 'PNS',
                'no_hp'            => '081234567898',
                'alamat'           => 'Jl. Cempaka Putih No. 12, Jakarta Pusat',
                'kelurahan'        => 'Cempaka Putih',
                'kecamatan'        => 'Cempaka Putih',
                'kabupaten_kota'   => 'Jakarta Pusat',
                'provinsi'         => 'DKI Jakarta',
                'kode_pos'         => '10510',
                'jenis_pembayaran' => 'bpjs',
                'no_bpjs'          => '0001234567893',
                'catatan_alergi'   => null,
                'catatan_khusus'   => 'Pasien dengan riwayat hipertensi dan DM tipe 2',
            ],
            [
                'no_rm'            => 'EMIRA-RM-2025-000001',
                'nik'              => '3171055109900008',
                'nama_lengkap'     => 'Linda Kartika',
                'nama_panggilan'   => 'Linda',
                'tempat_lahir'     => 'Jakarta',
                'tanggal_lahir'    => '1990-09-11',
                'jenis_kelamin'    => 'P',
                'golongan_darah'   => 'O',
                'rhesus'           => '+',
                'agama'            => 'Islam',
                'status_pernikahan'=> 'menikah',
                'pekerjaan'        => 'Dokter',
                'no_hp'            => '081234567899',
                'alamat'           => 'Jl. Kemang Raya No. 20, Jakarta Selatan',
                'kelurahan'        => 'Kemang',
                'kecamatan'        => 'Mampang Prapatan',
                'kabupaten_kota'   => 'Jakarta Selatan',
                'provinsi'         => 'DKI Jakarta',
                'kode_pos'         => '12730',
                'jenis_pembayaran' => 'umum',
                'no_bpjs'          => null,
                'catatan_alergi'   => null,
            ],
            [
                'no_rm'            => 'EMIRA-RM-2025-000002',
                'nik'              => '3171051512080009',
                'nama_lengkap'     => 'Rizky Pratama',
                'nama_panggilan'   => 'Rizky',
                'tempat_lahir'     => 'Jakarta',
                'tanggal_lahir'    => '2008-12-15',
                'jenis_kelamin'    => 'L',
                'golongan_darah'   => 'A',
                'rhesus'           => '+',
                'agama'            => 'Islam',
                'status_pernikahan'=> 'belum_menikah',
                'pekerjaan'        => 'Pelajar',
                'no_hp'            => '081234567900',
                'no_hp_darurat'    => '081234567901',
                'nama_kontak_darurat' => 'Pratama',
                'hubungan_kontak_darurat' => 'Ayah',
                'alamat'           => 'Jl. Rawamangun No. 45, Jakarta Timur',
                'kelurahan'        => 'Rawamangun',
                'kecamatan'        => 'Pulogadung',
                'kabupaten_kota'   => 'Jakarta Timur',
                'provinsi'         => 'DKI Jakarta',
                'kode_pos'         => '13220',
                'jenis_pembayaran' => 'bpjs',
                'no_bpjs'          => '0001234567894',
                'catatan_alergi'   => 'Alergi seafood',
            ],
            [
                'no_rm'            => 'EMIRA-RM-2025-000003',
                'nik'              => '3171044402580010',
                'nama_lengkap'     => 'Sri Wahyuni',
                'nama_panggilan'   => 'Sri',
                'tempat_lahir'     => 'Solo',
                'tanggal_lahir'    => '1958-02-04',
                'jenis_kelamin'    => 'P',
                'golongan_darah'   => 'AB',
                'rhesus'           => '+',
                'agama'            => 'Islam',
                'status_pernikahan'=> 'cerai_mati',
                'pekerjaan'        => 'Pensiunan',
                'no_hp'            => '081234567902',
                'no_hp_darurat'    => '081234567903',
                'nama_kontak_darurat' => 'Eko Wahyuno',
                'hubungan_kontak_darurat' => 'Anak',
                'alamat'           => 'Jl. Matraman Raya No. 8, Jakarta Timur',
                'kelurahan'        => 'Matraman',
                'kecamatan'        => 'Matraman',
                'kabupaten_kota'   => 'Jakarta Timur',
                'provinsi'         => 'DKI Jakarta',
                'kode_pos'         => '13140',
                'jenis_pembayaran' => 'bpjs',
                'no_bpjs'          => '0001234567895',
                'catatan_alergi'   => null,
                'catatan_khusus'   => 'Lansia, riwayat diabetes dan hipertensi. Mobilitas terbatas.',
            ],
        ];

        foreach ($pasiens as $pasien) {
            $data = array_merge([
                'no_hp_darurat'           => null,
                'nama_kontak_darurat'     => null,
                'hubungan_kontak_darurat' => null,
                'email'                   => null,
                'kelurahan'               => null,
                'kecamatan'               => null,
                'kabupaten_kota'          => null,
                'provinsi'                => null,
                'kode_pos'                => null,
                'foto'                    => null,
                'catatan_alergi'          => null,
                'catatan_khusus'          => null,
                'pendidikan'              => null,
                'is_active'               => 1,
                'created_at'              => now(),
                'updated_at'              => now(),
            ], $pasien);

            DB::table('pasiens')->updateOrInsert(['no_rm' => $pasien['no_rm']], $data);
        }

        $this->command->info('✅ PasienSeeder: 10 pasien contoh berhasil dibuat.');
    }
}
```

---

### AntrianKunjunganSeeder.php
```php
<?php
// database/seeders/AntrianKunjunganSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AntrianKunjunganSeeder extends Seeder
{
    public function run(): void
    {
        $today       = Carbon::today()->toDateString();
        $yesterday   = Carbon::yesterday()->toDateString();

        $dokterAndi  = DB::table('dokters')->where('nama_lengkap', 'Andi Wijaya')->value('id');
        $dokterSiti  = DB::table('dokters')->where('nama_lengkap', 'Siti Rahayu')->value('id');
        $dokterBudi  = DB::table('dokters')->where('nama_lengkap', 'Budi Santoso')->value('id');
        $dokterMaya  = DB::table('dokters')->where('nama_lengkap', 'Maya Putri')->value('id');

        $poliDalam     = DB::table('polis')->where('kode_poli', 'DALAM')->value('id');
        $poliAnak      = DB::table('polis')->where('kode_poli', 'ANAK')->value('id');
        $poliGigi      = DB::table('polis')->where('kode_poli', 'GIGI')->value('id');
        $poliKandungan = DB::table('polis')->where('kode_poli', 'KANDUNGAN')->value('id');

        $userRegistrasi = DB::table('users')->where('email', 'ahmad.fauzi@emira.app')->value('id');
        $perawatId      = DB::table('users')->where('email', 'rina.susanti@emira.app')->value('id');

        $pasienIds = DB::table('pasiens')->orderBy('id')->pluck('id')->toArray();

        // ────────────────────────────────────────────────────────────
        // ANTRIAN & KUNJUNGAN HARI INI (mix status untuk demo)
        // ────────────────────────────────────────────────────────────
        $dataHariIni = [
            // Penyakit Dalam — dr. Andi
            ['pasien_idx' => 0, 'dokter_id' => $dokterAndi, 'poli_id' => $poliDalam,
             'kode' => 'PDL-001', 'status_antrian' => 'selesai', 'status_kunjungan' => 'selesai',
             'keluhan' => 'Kontrol gula darah dan tekanan darah tinggi', 'jenis' => 'rawat_jalan'],

            ['pasien_idx' => 2, 'dokter_id' => $dokterAndi, 'poli_id' => $poliDalam,
             'kode' => 'PDL-002', 'status_antrian' => 'selesai', 'status_kunjungan' => 'selesai',
             'keluhan' => 'Sesak napas dan nyeri dada sejak kemarin malam', 'jenis' => 'rawat_jalan'],

            ['pasien_idx' => 4, 'dokter_id' => $dokterAndi, 'poli_id' => $poliDalam,
             'kode' => 'PDL-003', 'status_antrian' => 'dalam_pelayanan', 'status_kunjungan' => 'dalam_pemeriksaan',
             'keluhan' => 'Nyeri perut kanan atas dan mual sejak 3 hari lalu', 'jenis' => 'rawat_jalan'],

            ['pasien_idx' => 6, 'dokter_id' => $dokterAndi, 'poli_id' => $poliDalam,
             'kode' => 'PDL-004', 'status_antrian' => 'menunggu', 'status_kunjungan' => 'menunggu',
             'keluhan' => 'Kontrol rutin diabetes tipe 2', 'jenis' => 'kontrol'],

            // Poli Anak — dr. Siti
            ['pasien_idx' => 8, 'dokter_id' => $dokterSiti, 'poli_id' => $poliAnak,
             'kode' => 'ANK-001', 'status_antrian' => 'selesai', 'status_kunjungan' => 'selesai',
             'keluhan' => 'Demam 3 hari, batuk pilek, tidak nafsu makan', 'jenis' => 'rawat_jalan'],

            ['pasien_idx' => 1, 'dokter_id' => $dokterSiti, 'poli_id' => $poliAnak,
             'kode' => 'ANK-002', 'status_antrian' => 'dipanggil', 'status_kunjungan' => 'dipanggil',
             'keluhan' => 'Ruam kemerahan di seluruh tubuh anak', 'jenis' => 'rawat_jalan'],

            // Poli Gigi — drg. Budi
            ['pasien_idx' => 3, 'dokter_id' => $dokterBudi, 'poli_id' => $poliGigi,
             'kode' => 'GGI-001', 'status_antrian' => 'selesai', 'status_kunjungan' => 'selesai',
             'keluhan' => 'Gigi berlubang dan ngilu saat makan', 'jenis' => 'rawat_jalan'],

            ['pasien_idx' => 5, 'dokter_id' => $dokterBudi, 'poli_id' => $poliGigi,
             'kode' => 'GGI-002', 'status_antrian' => 'menunggu', 'status_kunjungan' => 'menunggu',
             'keluhan' => 'Kontrol scaling dan pembersihan karang gigi', 'jenis' => 'kontrol'],

            // Poli Kandungan — dr. Maya
            ['pasien_idx' => 7, 'dokter_id' => $dokterMaya, 'poli_id' => $poliKandungan,
             'kode' => 'KDG-001', 'status_antrian' => 'selesai', 'status_kunjungan' => 'selesai',
             'keluhan' => 'ANC rutin usia kehamilan 32 minggu, keluhan kaki bengkak', 'jenis' => 'kontrol'],
        ];

        $antriIds    = [];
        $kunjungIds  = [];

        foreach ($dataHariIni as $i => $row) {
            $pasienId = $pasienIds[$row['pasien_idx']] ?? $pasienIds[0];
            $jamDaftar = Carbon::today()->setTime(7 + $i, rand(0, 59));

            // Insert antrian
            $antriId = DB::table('antrians')->insertGetId([
                'kode_antrian'  => $row['kode'],
                'no_urut'       => $i + 1,
                'pasien_id'     => $pasienId,
                'poli_id'       => $row['poli_id'],
                'dokter_id'     => $row['dokter_id'],
                'tanggal'       => $today,
                'sumber'        => 'loket',
                'status'        => $row['status_antrian'],
                'jam_daftar'    => $jamDaftar,
                'jam_dipanggil' => in_array($row['status_antrian'], ['dipanggil','dalam_pelayanan','selesai'])
                    ? $jamDaftar->copy()->addMinutes(rand(5, 30)) : null,
                'jam_selesai'   => $row['status_antrian'] === 'selesai'
                    ? $jamDaftar->copy()->addMinutes(rand(35, 90)) : null,
                'created_at'    => $jamDaftar,
                'updated_at'    => now(),
            ]);

            // Insert kunjungan
            $noKunjungan = 'EMIRA-KJN-' . Carbon::today()->format('Ymd') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);
            $kunjId = DB::table('kunjungans')->insertGetId([
                'no_kunjungan'       => $noKunjungan,
                'pasien_id'          => $pasienId,
                'dokter_id'          => $row['dokter_id'],
                'poli_id'            => $row['poli_id'],
                'antrian_id'         => $antriId,
                'tanggal_kunjungan'  => $today,
                'jam_datang'         => $jamDaftar->format('H:i:s'),
                'jam_dilayani'       => in_array($row['status_kunjungan'], ['dalam_pemeriksaan','selesai'])
                    ? $jamDaftar->copy()->addMinutes(rand(10, 40))->format('H:i:s') : null,
                'jam_selesai'        => $row['status_kunjungan'] === 'selesai'
                    ? $jamDaftar->copy()->addMinutes(rand(50, 100))->format('H:i:s') : null,
                'jenis_kunjungan'    => $row['jenis'],
                'jenis_pembayaran'   => 'umum',
                'keluhan_utama'      => $row['keluhan'],
                'status'             => $row['status_kunjungan'],
                'registered_by'      => $userRegistrasi,
                'created_at'         => $jamDaftar,
                'updated_at'         => now(),
            ]);

            $antriIds[]   = $antriId;
            $kunjungIds[] = ['id' => $kunjId, 'dokter_id' => $row['dokter_id'], 'pasien_id' => $pasienId, 'status' => $row['status_kunjungan']];
        }

        $this->command->info('✅ AntrianKunjunganSeeder: ' . count($dataHariIni) . ' antrian & kunjungan hari ini berhasil dibuat.');

        // ────────────────────────────────────────────────────────────
        // KUNJUNGAN KEMARIN (selesai semua — untuk data riwayat)
        // ────────────────────────────────────────────────────────────
        $dataKemarin = [
            ['pasien_idx' => 0, 'dokter_id' => $dokterAndi, 'poli_id' => $poliDalam, 'keluhan' => 'Kontrol DM — kadar gula masih tinggi'],
            ['pasien_idx' => 9, 'dokter_id' => $dokterAndi, 'poli_id' => $poliDalam, 'keluhan' => 'Hipertensi tidak terkontrol, kepala berat'],
            ['pasien_idx' => 1, 'dokter_id' => $dokterMaya, 'poli_id' => $poliKandungan, 'keluhan' => 'ANC rutin trimester 2, keluhan mual'],
        ];

        foreach ($dataKemarin as $j => $row) {
            $pasienId = $pasienIds[$row['pasien_idx']] ?? $pasienIds[0];
            $jamDaftar = Carbon::yesterday()->setTime(8 + $j, rand(0, 59));

            $antriId = DB::table('antrians')->insertGetId([
                'kode_antrian'  => substr(str_replace('PDL','KMR',$row['poli_id']),0,3).'-'.str_pad($j+1,3,'0',STR_PAD_LEFT),
                'no_urut'       => $j + 1,
                'pasien_id'     => $pasienId,
                'poli_id'       => $row['poli_id'],
                'dokter_id'     => $row['dokter_id'],
                'tanggal'       => $yesterday,
                'sumber'        => 'loket',
                'status'        => 'selesai',
                'jam_daftar'    => $jamDaftar,
                'jam_dipanggil' => $jamDaftar->copy()->addMinutes(20),
                'jam_selesai'   => $jamDaftar->copy()->addMinutes(70),
                'created_at'    => $jamDaftar,
                'updated_at'    => $jamDaftar->copy()->addMinutes(70),
            ]);

            $noKunjungan = 'EMIRA-KJN-' . Carbon::yesterday()->format('Ymd') . '-' . str_pad($j + 1, 4, '0', STR_PAD_LEFT);
            DB::table('kunjungans')->insertGetId([
                'no_kunjungan'      => $noKunjungan,
                'pasien_id'         => $pasienId,
                'dokter_id'         => $row['dokter_id'],
                'poli_id'           => $row['poli_id'],
                'antrian_id'        => $antriId,
                'tanggal_kunjungan' => $yesterday,
                'jam_datang'        => $jamDaftar->format('H:i:s'),
                'jam_dilayani'      => $jamDaftar->copy()->addMinutes(25)->format('H:i:s'),
                'jam_selesai'       => $jamDaftar->copy()->addMinutes(65)->format('H:i:s'),
                'jenis_kunjungan'   => 'rawat_jalan',
                'jenis_pembayaran'  => 'umum',
                'keluhan_utama'     => $row['keluhan'],
                'status'            => 'selesai',
                'registered_by'     => $userRegistrasi,
                'created_at'        => $jamDaftar,
                'updated_at'        => $jamDaftar->copy()->addMinutes(65),
            ]);
        }

        $this->command->info('✅ AntrianKunjunganSeeder: ' . count($dataKemarin) . ' kunjungan kemarin (riwayat) berhasil dibuat.');
    }
}
```

---

### RekamMedisSeeder.php
```php
<?php
// database/seeders/RekamMedisSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekamMedisSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil kunjungan yang sudah selesai untuk dibuatkan rekam medis
        $kunjungansSelesai = DB::table('kunjungans')
            ->where('status', 'selesai')
            ->get();

        if ($kunjungansSelesai->isEmpty()) {
            $this->command->warn('⚠️  Tidak ada kunjungan selesai — RekamMedisSeeder dilewati.');
            return;
        }

        $perawatId = DB::table('users')->where('email', 'rina.susanti@emira.app')->value('id');

        $anamnesisContoh = [
            'Pasien datang dengan keluhan utama yang sudah berlangsung beberapa hari. Tidak ada riwayat penyakit berat sebelumnya yang relevan. Pasien rutin kontrol dan mengikuti anjuran medis.',
            'Keluhan dirasakan memberat dalam 2-3 hari terakhir. Pasien sudah mencoba istirahat namun tidak membaik. Tidak ada riwayat alergi obat yang diketahui.',
            'Keluhan sudah dirasakan sejak seminggu lalu, awalnya ringan kemudian semakin terasa. Riwayat keluarga tidak ada yang sakit serupa.',
        ];

        $rencanaContoh = [
            'Kontrol kembali 1 minggu. Lanjutkan pengobatan yang diberikan. Perhatikan pola makan dan istirahat cukup.',
            'Evaluasi kondisi dalam 3 hari. Segera kembali jika gejala memburuk atau muncul gejala baru.',
            'Kontrol 2 minggu untuk evaluasi. Jaga pola hidup sehat dan rutin minum obat sesuai anjuran.',
        ];

        $icd10Map = [
            // pasien dengan hipertensi/DM → ICD I10, E11
            0 => ['I10', 'E11'],
            2 => ['K29', 'I10'],
            3 => ['K25'],
            7 => ['O14'],
            8 => ['J06'],
            1 => ['L20'],
            9 => ['I10'],
        ];

        $tindakanMap = [
            'PU-001' => null, 'PU-003' => null, 'TM-001' => null,
        ];

        $counter = 0;
        foreach ($kunjungansSelesai as $idx => $kunjungan) {
            $noRmKunjungan = 'EMIRA-RMK-' . Carbon::parse($kunjungan->tanggal_kunjungan)->format('Ymd') . '-' . str_pad($counter + 1, 4, '0', STR_PAD_LEFT);

            // Insert Rekam Medis
            $rekamMedisId = DB::table('rekam_medis')->insertGetId([
                'no_rm_kunjungan'          => $noRmKunjungan,
                'kunjungan_id'             => $kunjungan->id,
                'pasien_id'                => $kunjungan->pasien_id,
                'dokter_id'                => $kunjungan->dokter_id,
                'tanggal_periksa'          => Carbon::parse($kunjungan->tanggal_kunjungan)->setTime(rand(8,15), rand(0,59)),
                'anamnesis'                => $anamnesisContoh[$idx % 3],
                'riwayat_penyakit_dahulu'  => 'Tidak ada riwayat penyakit kronis yang signifikan.',
                'riwayat_penyakit_keluarga'=> 'Ayah riwayat hipertensi.',
                'riwayat_alergi'           => 'Tidak ada riwayat alergi yang diketahui.',
                'riwayat_obat_rutin'       => 'Tidak sedang konsumsi obat rutin.',
                'catatan_dokter'           => 'Pasien kooperatif. Pemeriksaan fisik dalam batas normal kecuali yang tercatat. Terapi diberikan sesuai kondisi klinis.',
                'rencana_tindak_lanjut'    => $rencanaContoh[$idx % 3],
                'created_at'               => now(),
                'updated_at'               => now(),
            ]);

            // Insert Vital Sign
            DB::table('vital_signs')->insert([
                'kunjungan_id'          => $kunjungan->id,
                'pasien_id'             => $kunjungan->pasien_id,
                'tekanan_darah_sistol'  => rand(110, 160),
                'tekanan_darah_diastol' => rand(70, 100),
                'nadi'                  => rand(60, 100),
                'pernapasan'            => rand(16, 22),
                'suhu'                  => round(rand(365, 380) / 10, 1),
                'saturasi_oksigen'      => rand(95, 100),
                'berat_badan'           => rand(50, 90),
                'tinggi_badan'          => rand(155, 175),
                'bmi'                   => round(rand(180, 300) / 10, 1),
                'kesadaran'             => 'composmentis',
                'catatan'               => null,
                'recorded_by'           => $perawatId,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);

            // Insert Diagnosa (sesuai pasien)
            $pasienIdx = array_search($kunjungan->pasien_id, DB::table('pasiens')->orderBy('id')->pluck('id')->toArray());
            $kodeIcds  = $icd10Map[$pasienIdx] ?? ['J06'];

            $jenisArr = ['utama', 'sekunder', 'komplikasi'];
            foreach ($kodeIcds as $ki => $kodeIcd) {
                $icd10Id = DB::table('icd10_masters')->where('kode', $kodeIcd)->value('id');
                if ($icd10Id) {
                    DB::table('diagnosas')->insert([
                        'rekam_medis_id'       => $rekamMedisId,
                        'icd10_id'             => $icd10Id,
                        'jenis'                => $jenisArr[$ki] ?? 'sekunder',
                        'keterangan_tambahan'  => null,
                        'created_at'           => now(),
                        'updated_at'           => now(),
                    ]);
                }
            }

            // Insert Tindakan Medis (2 tindakan per kunjungan)
            $tindakanKodes = ['PU-001', 'PU-003'];
            foreach ($tindakanKodes as $tk) {
                $masterTindakanId = DB::table('master_tindakans')->where('kode_tindakan', $tk)->value('id');
                if ($masterTindakanId) {
                    DB::table('tindakan_medis')->insert([
                        'rekam_medis_id'      => $rekamMedisId,
                        'kunjungan_id'        => $kunjungan->id,
                        'master_tindakan_id'  => $masterTindakanId,
                        'dilakukan_oleh'      => $kunjungan->dokter_id,
                        'tanggal_tindakan'    => $kunjungan->tanggal_kunjungan,
                        'jam_tindakan'        => Carbon::now()->format('H:i:s'),
                        'jumlah'              => 1,
                        'keterangan'          => 'Tindakan dilakukan sesuai indikasi klinis.',
                        'hasil'               => 'Pasien toleran, tidak ada komplikasi.',
                        'created_at'          => now(),
                        'updated_at'          => now(),
                    ]);
                }
            }

            // Insert Tindakan Keperawatan
            $tindakanKeperawatanList = [
                'Pengukuran tanda-tanda vital',
                'Pemasangan infus D5% 20 tpm',
                'Edukasi pasien tentang pola makan sehat',
            ];
            DB::table('tindakan_keperawatans')->insert([
                'kunjungan_id'    => $kunjungan->id,
                'pasien_id'       => $kunjungan->pasien_id,
                'perawat_id'      => $perawatId,
                'jenis_tindakan'  => $tindakanKeperawatanList[$counter % 3],
                'deskripsi'       => 'Tindakan keperawatan dilakukan sesuai instruksi dokter dan standar asuhan keperawatan.',
                'waktu_tindakan'  => Carbon::parse($kunjungan->tanggal_kunjungan)->setTime(rand(8,14), rand(0,59)),
                'respons_pasien'  => 'Pasien kooperatif dan tidak ada keluhan berarti pasca tindakan.',
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);

            $counter++;
        }

        $this->command->info("✅ RekamMedisSeeder: {$counter} rekam medis + vital sign + diagnosa + tindakan berhasil dibuat.");
    }
}
```

---

## 🚀 CARA MENJALANKAN SEEDER EMIRA

```bash
# 1. Pastikan database sudah dibuat dan .env sudah dikonfigurasi
DB_DATABASE=emira_db
DB_USERNAME=root
DB_PASSWORD=

# 2. Jalankan migrasi
php artisan migrate

# 3. Jalankan semua seeder EMIRA
php artisan db:seed

# 4. Atau reset total dan seed ulang
php artisan migrate:fresh --seed

# Output yang diharapkan:
# ✅ RoleSeeder: 4 role EMIRA berhasil dibuat.
# ✅ UserSeeder: 10 user EMIRA berhasil dibuat.
# ✅ PoliSeeder: 6 poli berhasil dibuat.
# ✅ DokterSeeder: 4 dokter berhasil dibuat.
# ✅ JadwalDokterSeeder: 17 jadwal praktik berhasil dibuat.
# ✅ RuanganSeeder: 9 ruangan berhasil dibuat.
# ✅ Icd10Seeder: 35 kode ICD-10 berhasil dibuat.
# ✅ MasterTindakanSeeder: 29 tindakan berhasil dibuat.
# ✅ PengaturanSeeder: 22 pengaturan EMIRA berhasil dibuat.
# ✅ PasienSeeder: 10 pasien contoh berhasil dibuat.
# ✅ AntrianKunjunganSeeder: 8 antrian & kunjungan hari ini berhasil dibuat.
# ✅ AntrianKunjunganSeeder: 3 kunjungan kemarin (riwayat) berhasil dibuat.
# ✅ RekamMedisSeeder: X rekam medis + vital sign + diagnosa + tindakan berhasil dibuat.
```

---

## 🔑 AKUN LOGIN DEMO EMIRA

| Email | Password | Role |
|-------|----------|------|
| `superadmin@emira.app` | `emira@superadmin` | 🔴 Super Admin |
| `andi.wijaya@emira.app` | `dokter123` | 🔵 Dokter (Sp.PD) |
| `siti.rahayu@emira.app` | `dokter123` | 🔵 Dokter (Sp.A) |
| `budi.santoso@emira.app` | `dokter123` | 🔵 Dokter (Gigi) |
| `maya.putri@emira.app` | `dokter123` | 🔵 Dokter (Sp.OG) |
| `rina.susanti@emira.app` | `perawat123` | 🟢 Perawat |
| `doni.prasetyo@emira.app` | `perawat123` | 🟢 Perawat |
| `lestari.dewi@emira.app` | `perawat123` | 🟢 Perawat |
| `ahmad.fauzi@emira.app` | `rekammedis123` | 🟡 Rekam Medis |
| `dewi.kurniawati@emira.app` | `rekammedis123` | 🟡 Rekam Medis |

---

## 📊 DATA YANG TERSEDIA SETELAH SEEDER

| Data | Jumlah |
|------|--------|
| Role | 4 |
| User | 10 |
| Poli | 6 |
| Dokter | 4 |
| Jadwal Dokter | 17 slot |
| Ruangan | 9 |
| Kode ICD-10 | 35 |
| Master Tindakan | 29 |
| Pengaturan Sistem | 22 |
| Pasien | 10 |
| Antrian Hari Ini | 8 (mix status) |
| Kunjungan Hari Ini | 8 (mix status) |
| Kunjungan Kemarin | 3 (selesai) |
| Rekam Medis | ≥ 8 (kunjungan selesai) |
| Vital Sign | ≥ 8 |
| Diagnosa | ≥ 10 |
| Tindakan Medis | ≥ 16 |
| Tindakan Keperawatan | ≥ 8 |

---

*© 2025 EMIRA · Electronic Medical Integrated Record & Administration*
*"Satu Sistem, Rekam Medis Terintegrasi."*