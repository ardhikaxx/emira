<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AntrianKunjunganSeeder extends Seeder
{
    public function run(): void
    {
        $dokterAndi = DB::table('dokters')->where('nama_lengkap', 'Andi Wijaya')->first();
        $dokterSiti = DB::table('dokters')->where('nama_lengkap', 'Siti Rahayu')->first();
        $dokterBudi = DB::table('dokters')->where('nama_lengkap', 'Budi Santoso')->first();
        $dokterMaya = DB::table('dokters')->where('nama_lengkap', 'Maya Putri')->first();

        $poliDalam = DB::table('polis')->where('kode_poli', 'DALAM')->first();
        $poliAnak = DB::table('polis')->where('kode_poli', 'ANAK')->first();
        $poliGigi = DB::table('polis')->where('kode_poli', 'GIGI')->first();
        $poliKandungan = DB::table('polis')->where('kode_poli', 'KANDUNGAN')->first();

        $pasiens = DB::table('pasiens')->limit(6)->pluck('id')->toArray();

        $antrians = [
            ['pasien_id' => $pasiens[0], 'poli_id' => $poliDalam->id, 'dokter_id' => $dokterAndi->id, 'no_urut' => 1, 'kode_antrian' => 'DLM001', 'antrian_status' => 'menunggu', 'kunjungan_status' => 'menunggu'],
            ['pasien_id' => $pasiens[1], 'poli_id' => $poliDalam->id, 'dokter_id' => $dokterAndi->id, 'no_urut' => 2, 'kode_antrian' => 'DLM002', 'antrian_status' => 'dipanggil', 'kunjungan_status' => 'dipanggil'],
            ['pasien_id' => $pasiens[2], 'poli_id' => $poliAnak->id, 'dokter_id' => $dokterSiti->id, 'no_urut' => 1, 'kode_antrian' => 'ANK001', 'antrian_status' => 'menunggu', 'kunjungan_status' => 'menunggu'],
            ['pasien_id' => $pasiens[3], 'poli_id' => $poliGigi->id, 'dokter_id' => $dokterBudi->id, 'no_urut' => 1, 'kode_antrian' => 'GGI001', 'antrian_status' => 'selesai', 'kunjungan_status' => 'selesai'],
            ['pasien_id' => $pasiens[4], 'poli_id' => $poliKandungan->id, 'dokter_id' => $dokterMaya->id, 'no_urut' => 1, 'kode_antrian' => 'KDG001', 'antrian_status' => 'menunggu', 'kunjungan_status' => 'menunggu'],
            ['pasien_id' => $pasiens[5], 'poli_id' => $poliAnak->id, 'dokter_id' => $dokterSiti->id, 'no_urut' => 2, 'kode_antrian' => 'ANK002', 'antrian_status' => 'dalam_pelayanan', 'kunjungan_status' => 'dalam_pemeriksaan'],
        ];

        $userSuperAdmin = DB::table('users')->where('email', 'superadmin@emira.app')->first();

        foreach ($antrians as $index => $antrian) {
            $antrianData = [
                'pasien_id' => $antrian['pasien_id'],
                'poli_id' => $antrian['poli_id'],
                'dokter_id' => $antrian['dokter_id'],
                'no_urut' => $antrian['no_urut'],
                'kode_antrian' => $antrian['kode_antrian'],
                'status' => $antrian['antrian_status'],
                'tanggal' => today(),
                'sumber' => 'loket',
                'jam_daftar' => now()->subMinutes(rand(30, 120)),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $antrianId = DB::table('antrians')->insertGetId($antrianData);

            $noKunjungan = 'EMIRA-KJN-' . date('Ymd') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);

            $kunjunganId = DB::table('kunjungans')->insertGetId([
                'no_kunjungan' => $noKunjungan,
                'pasien_id' => $antrian['pasien_id'],
                'dokter_id' => $antrian['dokter_id'],
                'poli_id' => $antrian['poli_id'],
                'antrian_id' => $antrianId,
                'tanggal_kunjungan' => today(),
                'jam_datang' => now()->subMinutes(rand(30, 120))->format('H:i:s'),
                'jenis_kunjungan' => 'rawat_jalan',
                'jenis_pembayaran' => 'umum',
                'status' => $antrian['kunjungan_status'],
                'registered_by' => $userSuperAdmin->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ AntrianKunjunganSeeder: ' . count($antrians) . ' antrian dan kunjungan berhasil dibuat.');
    }
}
