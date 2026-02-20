<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalDokterSeeder extends Seeder
{
    public function run(): void
    {
        $poliUmum = DB::table('polis')->where('kode_poli', 'UMUM')->value('id');
        $poliDalam = DB::table('polis')->where('kode_poli', 'DALAM')->value('id');
        $poliAnak = DB::table('polis')->where('kode_poli', 'ANAK')->value('id');
        $poliGigi = DB::table('polis')->where('kode_poli', 'GIGI')->value('id');
        $poliKandungan = DB::table('polis')->where('kode_poli', 'KANDUNGAN')->value('id');

        $dokterAndi = DB::table('dokters')->where('nama_lengkap', 'Andi Wijaya')->value('id');
        $dokterSiti = DB::table('dokters')->where('nama_lengkap', 'Siti Rahayu')->value('id');
        $dokterBudi = DB::table('dokters')->where('nama_lengkap', 'Budi Santoso')->value('id');
        $dokterMaya = DB::table('dokters')->where('nama_lengkap', 'Maya Putri')->value('id');
        $dokterHendra = DB::table('dokters')->where('nama_lengkap', 'Hendra Gunawan')->value('id');
        $dokterLisa = DB::table('dokters')->where('nama_lengkap', 'Lisa Permata')->value('id');
        $dokterRobertus = DB::table('dokters')->where('nama_lengkap', 'Robertus Adi')->value('id');
        $dokterNita = DB::table('dokters')->where('nama_lengkap', 'Nita Wahyuni')->value('id');
        $dokterFerdianto = DB::table('dokters')->where('nama_lengkap', 'Ferdianto')->value('id');
        $dokterYuni = DB::table('dokters')->where('nama_lengkap', 'Yuni Astuti')->value('id');
        $dokterReza = DB::table('dokters')->where('nama_lengkap', 'Reza Pahlevi')->value('id');
        $dokterRatna = DB::table('dokters')->where('nama_lengkap', 'Ratna Sari')->value('id');
        $dokterHerman = DB::table('dokters')->where('nama_lengkap', 'Herman Wijaya')->value('id');
        $dokterDewiM = DB::table('dokters')->where('nama_lengkap', 'Dewi Malinda')->value('id');

        $jadwals = [
            // dr. Andi Wijaya, Sp.PD - Poli Umum
            ['dokter_id' => $dokterAndi, 'poli_id' => $poliUmum, 'hari' => 'senin', 'jam_mulai' => '08:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 25],
            ['dokter_id' => $dokterAndi, 'poli_id' => $poliUmum, 'hari' => 'selasa', 'jam_mulai' => '08:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 25],
            ['dokter_id' => $dokterAndi, 'poli_id' => $poliUmum, 'hari' => 'rabu', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],
            ['dokter_id' => $dokterAndi, 'poli_id' => $poliUmum, 'hari' => 'kamis', 'jam_mulai' => '08:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 25],
            ['dokter_id' => $dokterAndi, 'poli_id' => $poliUmum, 'hari' => 'jumat', 'jam_mulai' => '08:00', 'jam_selesai' => '11:00', 'kuota_pasien' => 15],

            // dr. Nita Wahyuni, Sp.PD-KGEH - Poli Dalam
            ['dokter_id' => $dokterNita, 'poli_id' => $poliDalam, 'hari' => 'senin', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterNita, 'poli_id' => $poliDalam, 'hari' => 'selasa', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],
            ['dokter_id' => $dokterNita, 'poli_id' => $poliDalam, 'hari' => 'rabu', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterNita, 'poli_id' => $poliDalam, 'hari' => 'kamis', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],
            ['dokter_id' => $dokterNita, 'poli_id' => $poliDalam, 'hari' => 'sabtu', 'jam_mulai' => '09:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 15],

            // dr. Siti Rahayu, Sp.A - Poli Anak
            ['dokter_id' => $dokterSiti, 'poli_id' => $poliAnak, 'hari' => 'senin', 'jam_mulai' => '09:00', 'jam_selesai' => '13:00', 'kuota_pasien' => 25],
            ['dokter_id' => $dokterSiti, 'poli_id' => $poliAnak, 'hari' => 'selasa', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterSiti, 'poli_id' => $poliAnak, 'hari' => 'rabu', 'jam_mulai' => '09:00', 'jam_selesai' => '13:00', 'kuota_pasien' => 25],
            ['dokter_id' => $dokterSiti, 'poli_id' => $poliAnak, 'hari' => 'kamis', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterSiti, 'poli_id' => $poliAnak, 'hari' => 'jumat', 'jam_mulai' => '09:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],

            // drg. Budi Santoso - Poli Gigi
            ['dokter_id' => $dokterBudi, 'poli_id' => $poliGigi, 'hari' => 'senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterBudi, 'poli_id' => $poliGigi, 'hari' => 'selasa', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterBudi, 'poli_id' => $poliGigi, 'hari' => 'rabu', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterBudi, 'poli_id' => $poliGigi, 'hari' => 'kamis', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterBudi, 'poli_id' => $poliGigi, 'hari' => 'jumat', 'jam_mulai' => '08:00', 'jam_selesai' => '11:00', 'kuota_pasien' => 8],

            // drg. Ratna Sari - Poli Gigi
            ['dokter_id' => $dokterRatna, 'poli_id' => $poliGigi, 'hari' => 'senin', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterRatna, 'poli_id' => $poliGigi, 'hari' => 'selasa', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterRatna, 'poli_id' => $poliGigi, 'hari' => 'rabu', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterRatna, 'poli_id' => $poliGigi, 'hari' => 'sabtu', 'jam_mulai' => '09:00', 'jam_selesai' => '13:00', 'kuota_pasien' => 8],

            // dr. Maya Putri, Sp.OG - Poli Kandungan
            ['dokter_id' => $dokterMaya, 'poli_id' => $poliKandungan, 'hari' => 'senin', 'jam_mulai' => '10:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterMaya, 'poli_id' => $poliKandungan, 'hari' => 'selasa', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 12],
            ['dokter_id' => $dokterMaya, 'poli_id' => $poliKandungan, 'hari' => 'rabu', 'jam_mulai' => '10:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterMaya, 'poli_id' => $poliKandungan, 'hari' => 'kamis', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 12],
            ['dokter_id' => $dokterMaya, 'poli_id' => $poliKandungan, 'hari' => 'jumat', 'jam_mulai' => '10:00', 'jam_selesai' => '13:00', 'kuota_pasien' => 10],

            // dr. Hendra Gunawan, Sp.B - Poli Dalam (Bedah)
            ['dokter_id' => $dokterHendra, 'poli_id' => $poliDalam, 'hari' => 'senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterHendra, 'poli_id' => $poliDalam, 'hari' => 'rabu', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterHendra, 'poli_id' => $poliDalam, 'hari' => 'jumat', 'jam_mulai' => '08:00', 'jam_selesai' => '11:00', 'kuota_pasien' => 10],

            // dr. Reza Pahlevi, Sp.BS - Poli Dalam (Bedah Saraf)
            ['dokter_id' => $dokterReza, 'poli_id' => $poliDalam, 'hari' => 'selasa', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterReza, 'poli_id' => $poliDalam, 'hari' => 'kamis', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 10],
            ['dokter_id' => $dokterReza, 'poli_id' => $poliDalam, 'hari' => 'sabtu', 'jam_mulai' => '09:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 8],

            // dr. Lisa Permata, Sp.M - Poli Umum (Mata)
            ['dokter_id' => $dokterLisa, 'poli_id' => $poliUmum, 'hari' => 'senin', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterLisa, 'poli_id' => $poliUmum, 'hari' => 'selasa', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],
            ['dokter_id' => $dokterLisa, 'poli_id' => $poliUmum, 'hari' => 'kamis', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterLisa, 'poli_id' => $poliUmum, 'hari' => 'sabtu', 'jam_mulai' => '09:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 12],

            // dr. Robertus Adi, Sp.JP - Poli Dalam (Jantung)
            ['dokter_id' => $dokterRobertus, 'poli_id' => $poliDalam, 'hari' => 'senin', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 12],
            ['dokter_id' => $dokterRobertus, 'poli_id' => $poliDalam, 'hari' => 'selasa', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 12],
            ['dokter_id' => $dokterRobertus, 'poli_id' => $poliDalam, 'hari' => 'rabu', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterRobertus, 'poli_id' => $poliDalam, 'hari' => 'jumat', 'jam_mulai' => '08:00', 'jam_selesai' => '11:00', 'kuota_pasien' => 10],

            // dr. Ferdianto, Sp.THT-KL - Poli Umum (THT)
            ['dokter_id' => $dokterFerdianto, 'poli_id' => $poliUmum, 'hari' => 'senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],
            ['dokter_id' => $dokterFerdianto, 'poli_id' => $poliUmum, 'hari' => 'rabu', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],
            ['dokter_id' => $dokterFerdianto, 'poli_id' => $poliUmum, 'hari' => 'jumat', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15],

            // dr. Yuni Astuti, Sp.KK - Poli Umum (Kulit)
            ['dokter_id' => $dokterYuni, 'poli_id' => $poliUmum, 'hari' => 'selasa', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15],
            ['dokter_id' => $dokterYuni, 'poli_id' => $poliUmum, 'hari' => 'kamis', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20],
            ['dokter_id' => $dokterYuni, 'poli_id' => $poliUmum, 'hari' => 'sabtu', 'jam_mulai' => '09:00', 'jam_selesai' => '13:00', 'kuota_pasien' => 12],

            // dr. Dewi Malinda, Sp.P - Poli Dalam (Paru)
            ['dokter_id' => $dokterDewiM, 'poli_id' => $poliDalam, 'hari' => 'senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 18],
            ['dokter_id' => $dokterDewiM, 'poli_id' => $poliDalam, 'hari' => 'selasa', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 12],
            ['dokter_id' => $dokterDewiM, 'poli_id' => $poliDalam, 'hari' => 'kamis', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 18],

            // dr. Herman Wijaya, Sp.U - Poli Dalam (Urologi)
            ['dokter_id' => $dokterHerman, 'poli_id' => $poliDalam, 'hari' => 'rabu', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 12],
            ['dokter_id' => $dokterHerman, 'poli_id' => $poliDalam, 'hari' => 'jumat', 'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 12],
            ['dokter_id' => $dokterHerman, 'poli_id' => $poliDalam, 'hari' => 'sabtu', 'jam_mulai' => '10:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 10],
        ];

        foreach ($jadwals as $jadwal) {
            DB::table('jadwal_dokters')->insert(array_merge($jadwal, [
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ JadwalDokterSeeder: ' . count($jadwals) . ' jadwal praktik berhasil dibuat.');
    }
}
