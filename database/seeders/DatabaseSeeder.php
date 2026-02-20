<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PoliSeeder::class,
            DokterSeeder::class,
            JadwalDokterSeeder::class,
            RuanganSeeder::class,
            Icd10Seeder::class,
            MasterTindakanSeeder::class,
            PengaturanSeeder::class,
            PasienSeeder::class,
            AntrianKunjunganSeeder::class,
            RekamMedisSeeder::class,
            VitalSignSeeder::class,
        ]);
    }
}
