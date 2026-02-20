<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $poliUmum = DB::table('polis')->where('kode_poli', 'UMUM')->value('id');
        $poliDalam = DB::table('polis')->where('kode_poli', 'DALAM')->value('id');
        $poliAnak = DB::table('polis')->where('kode_poli', 'ANAK')->value('id');
        $poliGigi = DB::table('polis')->where('kode_poli', 'GIGI')->value('id');
        $poliKandungan = DB::table('polis')->where('kode_poli', 'KANDUNGAN')->value('id');

        $userAndi = DB::table('users')->where('email', 'andi.wijaya@emira.app')->value('id');
        $userSiti = DB::table('users')->where('email', 'siti.rahayu@emira.app')->value('id');
        $userBudi = DB::table('users')->where('email', 'budi.santoso@emira.app')->value('id');
        $userMaya = DB::table('users')->where('email', 'maya.putri@emira.app')->value('id');
        $userHendra = DB::table('users')->where('email', 'hendra.gunawan@emira.app')->value('id');
        $userLisa = DB::table('users')->where('email', 'lisa.permata@emira.app')->value('id');
        $userRobertus = DB::table('users')->where('email', 'robertus.adi@emira.app')->value('id');
        $userNita = DB::table('users')->where('email', 'nita.wahyuni@emira.app')->value('id');
        $userFerdianto = DB::table('users')->where('email', 'ferdianto@emira.app')->value('id');
        $userYuni = DB::table('users')->where('email', 'yuni.astuti@emira.app')->value('id');
        $userReza = DB::table('users')->where('email', 'reza.pahlevi@emira.app')->value('id');
        $userRatna = DB::table('users')->where('email', 'ratna.sari@emira.app')->value('id');
        $userHerman = DB::table('users')->where('email', 'herman.wijaya@emira.app')->value('id');
        $userDewiM = DB::table('users')->where('email', 'dewi.malinda@emira.app')->value('id');

        $dokters = [
            // Poli Umum
            ['user_id' => $userAndi, 'nip' => 'NIP-2019-001', 'no_sip' => 'SIP/DKI/2019/001234', 'no_str' => 'STR/PD/2019/005678', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Andi Wijaya', 'gelar_belakang' => 'Sp.PD', 'spesialisasi' => 'Spesialis Penyakit Dalam', 'poli_id' => $poliUmum, 'no_hp' => '081234567801'],
            
            // Poli Dalam
            ['user_id' => $userNita, 'nip' => 'NIP-2022-010', 'no_sip' => 'SIP/DKI/2022/010234', 'no_str' => 'STR/PD/2022/015678', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Nita Wahyuni', 'gelar_belakang' => 'Sp.PD-KGEH', 'spesialisasi' => 'Spesialis Penyakit Dalam - Gastro Hepatologi', 'poli_id' => $poliDalam, 'no_hp' => '081234567810'],
            
            // Poli Anak
            ['user_id' => $userSiti, 'nip' => 'NIP-2020-002', 'no_sip' => 'SIP/DKI/2020/002345', 'no_str' => 'STR/A/2020/006789', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Siti Rahayu', 'gelar_belakang' => 'Sp.A', 'spesialisasi' => 'Spesialis Anak', 'poli_id' => $poliAnak, 'no_hp' => '081234567802'],
            
            // Poli Gigi
            ['user_id' => $userBudi, 'nip' => 'NIP-2018-003', 'no_sip' => 'SIP/DKI/2018/003456', 'no_str' => 'STR/GIG/2018/007890', 'gelar_depan' => 'drg.', 'nama_lengkap' => 'Budi Santoso', 'gelar_belakang' => null, 'spesialisasi' => 'Dokter Gigi Umum', 'poli_id' => $poliGigi, 'no_hp' => '081234567803'],
            ['user_id' => $userRatna, 'nip' => 'NIP-2023-013', 'no_sip' => 'SIP/DKI/2023/013456', 'no_str' => 'STR/KGA/2023/018901', 'gelar_depan' => 'drg.', 'nama_lengkap' => 'Ratna Sari', 'gelar_belakang' => null, 'spesialisasi' => 'Dokter Gigi Anak', 'poli_id' => $poliGigi, 'no_hp' => '081234567813'],
            
            // Poli Kandungan
            ['user_id' => $userMaya, 'nip' => 'NIP-2021-004', 'no_sip' => 'SIP/DKI/2021/004567', 'no_str' => 'STR/OG/2021/008901', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Maya Putri', 'gelar_belakang' => 'Sp.OG', 'spesialisasi' => 'Spesialis Obstetri & Ginekologi', 'poli_id' => $poliKandungan, 'no_hp' => '081234567804'],
            
            // Poli Bedah
            ['user_id' => $userHendra, 'nip' => 'NIP-2017-005', 'no_sip' => 'SIP/DKI/2017/005678', 'no_str' => 'STR/B/2017/009012', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Hendra Gunawan', 'gelar_belakang' => 'Sp.B', 'spesialisasi' => 'Spesialis Bedah Umum', 'poli_id' => $poliDalam, 'no_hp' => '081234567805'],
            ['user_id' => $userReza, 'nip' => 'NIP-2022-012', 'no_sip' => 'SIP/DKI/2022/012345', 'no_str' => 'STR/BS/2022/017890', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Reza Pahlevi', 'gelar_belakang' => 'Sp.BS', 'spesialisasi' => 'Spesialis Bedah Saraf', 'poli_id' => $poliDalam, 'no_hp' => '081234567812'],
            
            // Poli Mata
            ['user_id' => $userLisa, 'nip' => 'NIP-2020-006', 'no_sip' => 'SIP/DKI/2020/006789', 'no_str' => 'STR/M/2020/010123', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Lisa Permata', 'gelar_belakang' => 'Sp.M', 'spesialisasi' => 'Spesialis Mata', 'poli_id' => $poliUmum, 'no_hp' => '081234567806'],
            
            // Poli Jantung
            ['user_id' => $userRobertus, 'nip' => 'NIP-2019-007', 'no_sip' => 'SIP/DKI/2019/007890', 'no_str' => 'STR/JP/2019/011234', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Robertus Adi', 'gelar_belakang' => 'Sp.JP', 'spesialisasi' => 'Spesialis Jantung dan Pembuluh Darah', 'poli_id' => $poliDalam, 'no_hp' => '081234567807'],
            
            // Poli THT
            ['user_id' => $userFerdianto, 'nip' => 'NIP-2021-009', 'no_sip' => 'SIP/DKI/2021/009012', 'no_str' => 'STR/THT/2021/013456', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Ferdianto', 'gelar_belakang' => 'Sp.THT-KL', 'spesialisasi' => 'Spesialis THT - Kepala Leher', 'poli_id' => $poliUmum, 'no_hp' => '081234567809'],
            
            // Poli Kulit
            ['user_id' => $userYuni, 'nip' => 'NIP-2022-011', 'no_sip' => 'SIP/DKI/2022/011234', 'no_str' => 'STR/KK/2022/014567', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Yuni Astuti', 'gelar_belakang' => 'Sp.KK', 'spesialisasi' => 'Spesialis Kulit dan Kelamin', 'poli_id' => $poliUmum, 'no_hp' => '081234567811'],
            
            // Poli Paru
            ['user_id' => $userDewiM, 'nip' => 'NIP-2023-014', 'no_sip' => 'SIP/DKI/2023/014567', 'no_str' => 'STR/PAR/2023/019012', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Dewi Malinda', 'gelar_belakang' => 'Sp.P', 'spesialisasi' => 'Spesialis Pulmonologi dan Kedokteran Respirasi', 'poli_id' => $poliDalam, 'no_hp' => '081234567814'],
            
            // Poli Urologi
            ['user_id' => $userHerman, 'nip' => 'NIP-2020-015', 'no_sip' => 'SIP/DKI/2020/015678', 'no_str' => 'STR/U/2020/020123', 'gelar_depan' => 'dr.', 'nama_lengkap' => 'Herman Wijaya', 'gelar_belakang' => 'Sp.U', 'spesialisasi' => 'Spesialis Urologi', 'poli_id' => $poliDalam, 'no_hp' => '081234567815'],
        ];

        foreach ($dokters as $dokter) {
            DB::table('dokters')->updateOrInsert(['user_id' => $dokter['user_id']], array_merge($dokter, [
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ DokterSeeder: ' . count($dokters) . ' dokter berhasil dibuat.');
    }
}
