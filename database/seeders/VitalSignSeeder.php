<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VitalSignSeeder extends Seeder
{
    public function run(): void
    {
        $kunjungans = DB::table('kunjungans')->limit(6)->get();
        $userPerawat = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', 'perawat')
            ->first();

        if ($kunjungans->isEmpty()) {
            $this->command->info('⚠️ Tidak ada kunjungan, VitalSignSeeder dilewati.');
            return;
        }

        $vitalSigns = [
            [
                'kunjungan_id' => $kunjungans[0]->id,
                'pasien_id' => $kunjungans[0]->pasien_id,
                'tekanan_darah_sistol' => 120,
                'tekanan_darah_diastol' => 80,
                'nadi' => 72,
                'pernapasan' => 18,
                'suhu' => 36.5,
                'saturasi_oksigen' => 98,
                'berat_badan' => 65,
                'tinggi_badan' => 170,
                'bmi' => 22.49,
                'kesadaran' => 'composmentis',
                'recorded_by' => $userPerawat?->id ?? 1,
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'kunjungan_id' => $kunjungans[1]->id,
                'pasien_id' => $kunjungans[1]->pasien_id,
                'tekanan_darah_sistol' => 130,
                'tekanan_darah_diastol' => 85,
                'nadi' => 80,
                'pernapasan' => 20,
                'suhu' => 37.0,
                'saturasi_oksigen' => 97,
                'berat_badan' => 70,
                'tinggi_badan' => 165,
                'bmi' => 25.71,
                'kesadaran' => 'composmentis',
                'recorded_by' => $userPerawat?->id ?? 1,
                'created_at' => now()->subHours(1),
                'updated_at' => now()->subHours(1),
            ],
            [
                'kunjungan_id' => $kunjungans[2]->id,
                'pasien_id' => $kunjungans[2]->pasien_id,
                'tekanan_darah_sistol' => 110,
                'tekanan_darah_diastol' => 70,
                'nadi' => 68,
                'pernapasan' => 16,
                'suhu' => 36.2,
                'saturasi_oksigen' => 99,
                'berat_badan' => 55,
                'tinggi_badan' => 160,
                'bmi' => 21.48,
                'kesadaran' => 'composmentis',
                'recorded_by' => $userPerawat?->id ?? 1,
                'created_at' => now()->subMinutes(45),
                'updated_at' => now()->subMinutes(45),
            ],
            [
                'kunjungan_id' => $kunjungans[3]->id,
                'pasien_id' => $kunjungans[3]->pasien_id,
                'tekanan_darah_sistol' => 140,
                'tekanan_darah_diastol' => 90,
                'nadi' => 76,
                'pernapasan' => 22,
                'suhu' => 37.5,
                'saturasi_oksigen' => 96,
                'berat_badan' => 80,
                'tinggi_badan' => 175,
                'bmi' => 26.12,
                'kesadaran' => 'composmentis',
                'recorded_by' => $userPerawat?->id ?? 1,
                'created_at' => now()->subMinutes(30),
                'updated_at' => now()->subMinutes(30),
            ],
            [
                'kunjungan_id' => $kunjungans[4]->id,
                'pasien_id' => $kunjungans[4]->pasien_id,
                'tekanan_darah_sistol' => 125,
                'tekanan_darah_diastol' => 82,
                'nadi' => 74,
                'pernapasan' => 19,
                'suhu' => 36.8,
                'saturasi_oksigen' => 98,
                'berat_badan' => 62,
                'tinggi_badan' => 168,
                'bmi' => 21.97,
                'kesadaran' => 'composmentis',
                'recorded_by' => $userPerawat?->id ?? 1,
                'created_at' => now()->subMinutes(15),
                'updated_at' => now()->subMinutes(15),
            ],
            [
                'kunjungan_id' => $kunjungans[5]->id,
                'pasien_id' => $kunjungans[5]->pasien_id,
                'tekanan_darah_sistol' => 118,
                'tekanan_darah_diastol' => 78,
                'nadi' => 70,
                'pernapasan' => 17,
                'suhu' => 36.4,
                'saturasi_oksigen' => 99,
                'berat_badan' => 58,
                'tinggi_badan' => 162,
                'bmi' => 22.10,
                'kesadaran' => 'composmentis',
                'recorded_by' => $userPerawat?->id ?? 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($vitalSigns as $vs) {
            DB::table('vital_signs')->insert($vs);
        }

        $this->command->info('✅ VitalSignSeeder: ' . count($vitalSigns) . ' data vital sign berhasil dibuat.');
    }
}
