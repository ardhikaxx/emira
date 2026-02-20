<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        $pasiens = [
            ['no_rm' => 'EMIRA-RM-2026-000001', 'nik' => '3171050101900001', 'nama_lengkap' => 'Budi Santoso', 'nama_panggilan' => 'Budi', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '1990-01-01', 'jenis_kelamin' => 'L', 'golongan_darah' => 'O', 'rhesus' => '+', 'agama' => 'Islam', 'status_pernikahan' => 'menikah', 'pendidikan' => 'S1', 'pekerjaan' => 'Karyawan', 'no_hp' => '081234567890', 'alamat' => 'Jl. Merdeka No. 1, Jakarta Pusat', 'jenis_pembayaran' => 'umum'],
            ['no_rm' => 'EMIRA-RM-2026-000002', 'nik' => '3171050202900002', 'nama_lengkap' => 'Siti Aminah', 'nama_panggilan' => 'Siti', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '1985-05-15', 'jenis_kelamin' => 'P', 'golongan_darah' => 'A', 'rhesus' => '+', 'agama' => 'Islam', 'status_pernikahan' => 'menikah', 'pendidikan' => 'S1', 'pekerjaan' => 'Guru', 'no_hp' => '081234567891', 'alamat' => 'Jl. Sudirman No. 10, Jakarta Selatan', 'jenis_pembayaran' => 'bpjs', 'no_bpjs' => '0001234567890'],
            ['no_rm' => 'EMIRA-RM-2026-000003', 'nik' => '3171050303900003', 'nama_lengkap' => 'Ahmad Fauzi', 'nama_panggilan' => 'Ahmad', 'tempat_lahir' => 'Bandung', 'tanggal_lahir' => '1995-03-20', 'jenis_kelamin' => 'L', 'golongan_darah' => 'B', 'rhesus' => '+', 'agama' => 'Islam', 'status_pernikahan' => 'belum_menikah', 'pendidikan' => 'SMA', 'pekerjaan' => 'Wiraswasta', 'no_hp' => '081234567892', 'alamat' => 'Jl. Asia Afrika No. 5, Bandung', 'jenis_pembayaran' => 'umum'],
            ['no_rm' => 'EMIRA-RM-2026-000004', 'nik' => '3171050404900004', 'nama_lengkap' => 'Dewi Lestari', 'nama_panggilan' => 'Dewi', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '1988-08-25', 'jenis_kelamin' => 'P', 'golongan_darah' => 'AB', 'rhesus' => '-', 'agama' => 'Kristen', 'status_pernikahan' => 'menikah', 'pendidikan' => 'S2', 'pekerjaan' => 'Dosen', 'no_hp' => '081234567893', 'alamat' => 'Jl. Gatot Subroto No. 15, Jakarta Selatan', 'jenis_pembayaran' => 'bpjs', 'no_bpjs' => '0001234567891'],
            ['no_rm' => 'EMIRA-RM-2026-000005', 'nik' => '3171050505900005', 'nama_lengkap' => 'Rudi Hermawan', 'nama_panggilan' => 'Rudi', 'tempat_lahir' => 'Surabaya', 'tanggal_lahir' => '1992-12-10', 'jenis_kelamin' => 'L', 'golongan_darah' => 'O', 'rhesus' => '+', 'agama' => 'Islam', 'status_pernikahan' => 'belum_menikah', 'pendidikan' => 'D3', 'pekerjaan' => 'Teknisi', 'no_hp' => '081234567894', 'alamat' => 'Jl. Ahmad Yani No. 20, Surabaya', 'jenis_pembayaran' => 'umum'],
            ['no_rm' => 'EMIRA-RM-2026-000006', 'nik' => '3171050606900006', 'nama_lengkap' => 'Lina Kartika', 'nama_panggilan' => 'Lina', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '1998-06-05', 'jenis_kelamin' => 'P', 'golongan_darah' => 'A', 'rhesus' => '+', 'agama' => 'Islam', 'status_pernikahan' => 'belum_menikah', 'pendidikan' => 'SMA', 'pekerjaan' => 'Mahasiswa', 'no_hp' => '081234567895', 'alamat' => 'Jl. Kemang No. 8, Jakarta Selatan', 'jenis_pembayaran' => 'umum'],
            ['no_rm' => 'EMIRA-RM-2026-000007', 'nik' => '3171050707900007', 'nama_lengkap' => 'Hendra Wijaya', 'nama_panggilan' => 'Hendra', 'tempat_lahir' => 'Medan', 'tanggal_lahir' => '1982-07-18', 'jenis_kelamin' => 'L', 'golongan_darah' => 'B', 'rhesus' => '+', 'agama' => 'Buddha', 'status_pernikahan' => 'menikah', 'pendidikan' => 'S1', 'pekerjaan' => 'Manajer', 'no_hp' => '081234567896', 'alamat' => 'Jl. Diponegoro No. 12, Medan', 'jenis_pembayaran' => 'bpjs', 'no_bpjs' => '0001234567892'],
            ['no_rm' => 'EMIRA-RM-2026-000008', 'nik' => '3171050808900008', 'nama_lengkap' => 'Nisa Rahmawati', 'nama_panggilan' => 'Nisa', 'tempat_lahir' => 'Yogyakarta', 'tanggal_lahir' => '2000-08-30', 'jenis_kelamin' => 'P', 'golongan_darah' => 'O', 'rhesus' => '-', 'agama' => 'Islam', 'status_pernikahan' => 'belum_menikah', 'pendidikan' => 'SMA', 'pekerjaan' => 'Pelajar', 'no_hp' => '081234567897', 'alamat' => 'Jl. Malioboro No. 25, Yogyakarta', 'jenis_pembayaran' => 'umum'],
            ['no_rm' => 'EMIRA-RM-2026-000009', 'nik' => '3171050909900009', 'nama_lengkap' => 'Doni Prasetyo', 'nama_panggilan' => 'Doni', 'tempat_lahir' => 'Semarang', 'tanggal_lahir' => '1993-09-12', 'jenis_kelamin' => 'L', 'golongan_darah' => 'AB', 'rhesus' => '+', 'agama' => 'Islam', 'status_pernikahan' => 'menikah', 'pendidikan' => 'S1', 'pekerjaan' => 'Karyawan', 'no_hp' => '081234567898', 'alamat' => 'Jl. Pahlawan No. 7, Semarang', 'jenis_pembayaran' => 'umum'],
            ['no_rm' => 'EMIRA-RM-2026-000010', 'nik' => '3171051010900010', 'nama_lengkap' => 'Yuni Astuti', 'nama_panggilan' => 'Yuni', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '1987-10-22', 'jenis_kelamin' => 'P', 'golongan_darah' => 'A', 'rhesus' => '+', 'agama' => 'Islam', 'status_pernikahan' => 'cerai_hidup', 'pendidikan' => 'S1', 'pekerjaan' => 'Akuntan', 'no_hp' => '081234567899', 'alamat' => 'Jl. Thamrin No. 18, Jakarta Pusat', 'jenis_pembayaran' => 'bpjs', 'no_bpjs' => '0001234567893'],
        ];

        foreach ($pasiens as $pasien) {
            DB::table('pasiens')->updateOrInsert(['no_rm' => $pasien['no_rm']], array_merge($pasien, [
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ PasienSeeder: ' . count($pasiens) . ' pasien berhasil dibuat.');
    }
}
