<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        $pengaturans = [
            ['key' => 'app_name', 'value' => 'EMIRA', 'group' => 'umum', 'deskripsi' => 'Nama aplikasi'],
            ['key' => 'app_fullname', 'value' => 'Electronic Medical Integrated Record & Administration', 'group' => 'umum', 'deskripsi' => 'Nama lengkap aplikasi'],
            ['key' => 'nama_faskes', 'value' => 'Klinik Sehat Bersama', 'group' => 'umum', 'deskripsi' => 'Nama fasilitas kesehatan'],
            ['key' => 'jenis_faskes', 'value' => 'Klinik Pratama', 'group' => 'umum', 'deskripsi' => 'Jenis fasilitas kesehatan'],
            ['key' => 'alamat_faskes', 'value' => 'Jl. Kesehatan No. 1, Jakarta Pusat 10110', 'group' => 'umum', 'deskripsi' => 'Alamat lengkap fasilitas kesehatan'],
            ['key' => 'no_telp_faskes', 'value' => '(021) 555-0100', 'group' => 'umum', 'deskripsi' => 'Nomor telepon fasilitas kesehatan'],
            ['key' => 'email_faskes', 'value' => 'info@kliniksehatbersama.co.id', 'group' => 'umum', 'deskripsi' => 'Email fasilitas kesehatan'],
            ['key' => 'warna_primer', 'value' => '#0A6EBD', 'group' => 'tampilan', 'deskripsi' => 'Warna primer sistem'],
            ['key' => 'warna_sekunder', 'value' => '#17B169', 'group' => 'tampilan', 'deskripsi' => 'Warna sekunder sistem'],
            ['key' => 'format_no_rm', 'value' => 'EMIRA-RM-{YYYY}-{000000}', 'group' => 'cetak', 'deskripsi' => 'Format nomor rekam medis'],
            ['key' => 'format_no_kunjungan', 'value' => 'EMIRA-KJN-{YYYYMMDD}-{0000}', 'group' => 'cetak', 'deskripsi' => 'Format nomor kunjungan'],
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
