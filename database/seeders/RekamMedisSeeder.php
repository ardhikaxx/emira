<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekamMedisSeeder extends Seeder
{
    public function run(): void
    {
        $dokterAndi = DB::table('dokters')->where('nama_lengkap', 'Andi Wijaya')->first();
        $dokterSiti = DB::table('dokters')->where('nama_lengkap', 'Siti Rahayu')->first();
        $dokterBudi = DB::table('dokters')->where('nama_lengkap', 'Budi Santoso')->first();

        $kunjungans = DB::table('kunjungans')->limit(6)->get();

        $icd10s = DB::table('icd10_masters')->limit(5)->pluck('id')->toArray();
        $tindakans = DB::table('master_tindakans')->limit(5)->pluck('id')->toArray();

        $userDokter = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', 'dokter')
            ->first();

        $keluhan = [
            'Pasien mengeluh pusing dan mual sejak 2 hari yang lalu',
            'Pasien mengeluh nyeri gigi berlubang bagian belakang',
            'Pasien demam tinggi disertai batuk pilek',
            'Pasien kontrol rutin penyakit diabetes',
            'Pasien pemeriksaan kesehatan rutin (check up)',
            'Pasien keluhan sakit perut dan mual'
        ];
        
        $riwayatDahulu = [
            'Hipertensi seit 5 tahun, DM seit 3 tahun',
            'Tidak ada riwayat penyakit serius',
            'Asma seit kecil',
            'Tidak ada',
            'Maag kronis',
            'Riwayat operasi us appendiktomi seit 2018'
        ];
        
        $catatanDokter = [
            'Pasien disarankan diet rendah garam, kontrol 1 minggu lagi',
            'Pasien perlu perawatan saluran akar gigi',
            'Pasien diberikan obat antipiretik, istirahat yang cukup',
            'Pasien diminta mempertahankan pola makan dan olahraga teratur',
            'Hasil pemeriksaan fisik dalam batas normal',
            'Pasien diberikan obat maag dan pengencer darah'
        ];
        
        $tindakLanjut = [
            'Kontrol 1 minggu lagi dengan hasil labs',
            'Kembali 2 minggu lagi untuk evaluasi pengobatan',
            'Istirahat cukup, minum banyak air',
            'Lanjutkan obat rutin dan monitor gula darah',
            'Pemeriksaan labs lengkap bulan depan',
            'Kontrol 3 hari lagi jika keluhan tidak membaik'
        ];

        foreach ($kunjungans as $index => $kunjungan) {
            $rekamMedisId = DB::table('rekam_medis')->insertGetId([
                'no_rm_kunjungan' => $kunjungan->no_kunjungan . '-RM',
                'kunjungan_id' => $kunjungan->id,
                'pasien_id' => $kunjungan->pasien_id,
                'dokter_id' => $kunjungan->dokter_id,
                'tanggal_periksa' => now()->subHours($index + 1),
                'anamnesis' => $keluhan[$index] ?? 'Tidak ada keluhan',
                'riwayat_penyakit_dahulu' => $riwayatDahulu[$index] ?? 'Tidak ada',
                'riwayat_penyakit_keluarga' => 'Tidak ada',
                'riwayat_alergi' => null,
                'riwayat_obat_rutin' => null,
                'catatan_dokter' => $catatanDokter[$index] ?? 'Pasien dalam pengawasan',
                'rencana_tindak_lanjut' => $tindakLanjut[$index] ?? 'Kontrol sesuai jadwal',
                'created_at' => now()->subHours($index + 1),
                'updated_at' => now()->subHours($index + 1),
            ]);

            if (!empty($icd10s)) {
                DB::table('diagnosas')->insert([
                    'rekam_medis_id' => $rekamMedisId,
                    'icd10_id' => $icd10s[$index % count($icd10s)],
                    'jenis' => 'utama',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            if (!empty($tindakans)) {
                DB::table('tindakan_medis')->insert([
                    'rekam_medis_id' => $rekamMedisId,
                    'kunjungan_id' => $kunjungan->id,
                    'master_tindakan_id' => $tindakans[$index % count($tindakans)],
                    'dilakukan_oleh' => $userDokter->id,
                    'tanggal_tindakan' => today(),
                    'jam_tindakan' => now()->format('H:i:s'),
                    'jumlah' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('✅ RekamMedisSeeder: Rekam medis berhasil dibuat.');
    }
}
