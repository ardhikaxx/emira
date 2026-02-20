<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        $polis = [
            ['kode_poli' => 'UMUM', 'nama_poli' => 'Poli Umum', 'deskripsi' => 'Pelayanan kesehatan umum untuk semua keluhan', 'lantai' => '1'],
            ['kode_poli' => 'DALAM', 'nama_poli' => 'Poli Penyakit Dalam', 'deskripsi' => 'Penanganan penyakit dalam dan metabolik', 'lantai' => '1'],
            ['kode_poli' => 'ANAK', 'nama_poli' => 'Poli Anak', 'deskripsi' => 'Pelayanan kesehatan anak (pediatri)', 'lantai' => '1'],
            ['kode_poli' => 'GIGI', 'nama_poli' => 'Poli Gigi & Mulut', 'deskripsi' => 'Pelayanan kesehatan gigi dan mulut', 'lantai' => '2'],
            ['kode_poli' => 'KANDUNGAN', 'nama_poli' => 'Poli Kandungan', 'deskripsi' => 'Pelayanan obstetri dan ginekologi', 'lantai' => '2'],
            ['kode_poli' => 'UGD', 'nama_poli' => 'Unit Gawat Darurat', 'deskripsi' => 'Penanganan kasus gawat darurat 24 jam', 'lantai' => '1'],
        ];

        foreach ($polis as $poli) {
            DB::table('polis')->updateOrInsert(['kode_poli' => $poli['kode_poli']], array_merge($poli, [
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ PoliSeeder: 6 poli berhasil dibuat.');
    }
}
