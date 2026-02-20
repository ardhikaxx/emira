<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterTindakanSeeder extends Seeder
{
    public function run(): void
    {
        $tindakans = [
            ['kode_tindakan' => 'PU-001', 'nama_tindakan' => 'Pemeriksaan Fisik Lengkap', 'kategori' => 'Pemeriksaan Umum'],
            ['kode_tindakan' => 'PU-002', 'nama_tindakan' => 'Konsultasi Dokter Spesialis', 'kategori' => 'Pemeriksaan Umum'],
            ['kode_tindakan' => 'PU-003', 'nama_tindakan' => 'Pengukuran Tekanan Darah', 'kategori' => 'Pemeriksaan Umum'],
            ['kode_tindakan' => 'PU-004', 'nama_tindakan' => 'Pemeriksaan EKG (Elektrokardiogram)', 'kategori' => 'Pemeriksaan Umum'],
            ['kode_tindakan' => 'TM-001', 'nama_tindakan' => 'Pemasangan Infus', 'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-002', 'nama_tindakan' => 'Injeksi Intravena (IV)', 'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-003', 'nama_tindakan' => 'Injeksi Intramuskular (IM)', 'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-004', 'nama_tindakan' => 'Perawatan Luka Sederhana', 'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-005', 'nama_tindakan' => 'Perawatan Luka Kompleks', 'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-006', 'nama_tindakan' => 'Penjahitan Luka (per jahitan)', 'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-007', 'nama_tindakan' => 'Pelepasan Jahitan', 'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-008', 'nama_tindakan' => 'Insisi Abses', 'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-009', 'nama_tindakan' => 'Nebulisasi / Inhalasi', 'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'TM-010', 'nama_tindakan' => 'Pemasangan Kateter Urin', 'kategori' => 'Tindakan Minor'],
            ['kode_tindakan' => 'GG-001', 'nama_tindakan' => 'Pencabutan Gigi Susu', 'kategori' => 'Tindakan Gigi'],
            ['kode_tindakan' => 'GG-002', 'nama_tindakan' => 'Pencabutan Gigi Permanen', 'kategori' => 'Tindakan Gigi'],
            ['kode_tindakan' => 'GG-003', 'nama_tindakan' => 'Penambalan Gigi (Komposit)', 'kategori' => 'Tindakan Gigi'],
            ['kode_tindakan' => 'GG-004', 'nama_tindakan' => 'Skeling / Pembersihan Karang Gigi', 'kategori' => 'Tindakan Gigi'],
            ['kode_tindakan' => 'KB-001', 'nama_tindakan' => 'Pemeriksaan Kehamilan (ANC)', 'kategori' => 'Tindakan Kebidanan'],
            ['kode_tindakan' => 'KB-002', 'nama_tindakan' => 'USG Obstetri', 'kategori' => 'Tindakan Kebidanan'],
            ['kode_tindakan' => 'KB-003', 'nama_tindakan' => 'Persalinan Normal', 'kategori' => 'Tindakan Kebidanan'],
            ['kode_tindakan' => 'KP-001', 'nama_tindakan' => 'Pemberian Oksigen', 'kategori' => 'Keperawatan'],
            ['kode_tindakan' => 'KP-002', 'nama_tindakan' => 'Suction / Penghisapan Lendir', 'kategori' => 'Keperawatan'],
            ['kode_tindakan' => 'KP-003', 'nama_tindakan' => 'Monitor Tanda-Tanda Vital', 'kategori' => 'Keperawatan'],
        ];

        foreach ($tindakans as $t) {
            DB::table('master_tindakans')->updateOrInsert(['kode_tindakan' => $t['kode_tindakan']], array_merge($t, [
                'keterangan' => null,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ MasterTindakanSeeder: ' . count($tindakans) . ' tindakan berhasil dibuat.');
    }
}
