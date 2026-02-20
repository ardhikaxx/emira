<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $ruangans = [
            ['kode_ruangan' => 'VIP-01', 'nama_ruangan' => 'Ruang VIP Mawar', 'jenis' => 'vip', 'kapasitas' => 1, 'lantai' => '3'],
            ['kode_ruangan' => 'VIP-02', 'nama_ruangan' => 'Ruang VIP Melati', 'jenis' => 'vip', 'kapasitas' => 1, 'lantai' => '3'],
            ['kode_ruangan' => 'KELAS1-A', 'nama_ruangan' => 'Kelas 1 - Anggrek A', 'jenis' => 'rawat_inap', 'kapasitas' => 2, 'lantai' => '2'],
            ['kode_ruangan' => 'KELAS1-B', 'nama_ruangan' => 'Kelas 1 - Anggrek B', 'jenis' => 'rawat_inap', 'kapasitas' => 2, 'lantai' => '2'],
            ['kode_ruangan' => 'KELAS2-A', 'nama_ruangan' => 'Kelas 2 - Dahlia A', 'jenis' => 'rawat_inap', 'kapasitas' => 4, 'lantai' => '2'],
            ['kode_ruangan' => 'KELAS2-B', 'nama_ruangan' => 'Kelas 2 - Dahlia B', 'jenis' => 'rawat_inap', 'kapasitas' => 4, 'lantai' => '2'],
            ['kode_ruangan' => 'KELAS3-A', 'nama_ruangan' => 'Kelas 3 - Flamboyan', 'jenis' => 'rawat_inap', 'kapasitas' => 6, 'lantai' => '2'],
            ['kode_ruangan' => 'ICU-01', 'nama_ruangan' => 'ICU Umum', 'jenis' => 'icu', 'kapasitas' => 4, 'lantai' => '3'],
            ['kode_ruangan' => 'ISO-01', 'nama_ruangan' => 'Ruang Isolasi A', 'jenis' => 'isolasi', 'kapasitas' => 2, 'lantai' => '3'],
        ];

        foreach ($ruangans as $ruangan) {
            DB::table('ruangans')->updateOrInsert(['kode_ruangan' => $ruangan['kode_ruangan']], array_merge($ruangan, [
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ RuanganSeeder: 9 ruangan berhasil dibuat.');
    }
}
