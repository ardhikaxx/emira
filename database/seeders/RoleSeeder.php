<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'superadmin', 'display_name' => 'Super Admin', 'description' => 'Akses penuh ke seluruh sistem EMIRA'],
            ['name' => 'dokter', 'display_name' => 'Dokter', 'description' => 'Input rekam medis, diagnosa, tindakan medis, dan surat keterangan'],
            ['name' => 'perawat', 'display_name' => 'Perawat', 'description' => 'Kelola antrian, vital sign, dan tindakan keperawatan'],
            ['name' => 'rekam_medis', 'display_name' => 'Rekam Medis', 'description' => 'Registrasi pasien, arsip rekam medis, dan laporan EMIRA'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(['name' => $role['name']], array_merge($role, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ RoleSeeder: 4 role EMIRA berhasil dibuat.');
    }
}
