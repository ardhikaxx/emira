<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superadminId = DB::table('roles')->where('name', 'superadmin')->value('id');
        $dokterId = DB::table('roles')->where('name', 'dokter')->value('id');
        $perawatId = DB::table('roles')->where('name', 'perawat')->value('id');
        $rekamMedisId = DB::table('roles')->where('name', 'rekam_medis')->value('id');

        $users = [
            // Superadmin
            ['name' => 'Administrator EMIRA', 'email' => 'superadmin@emira.app', 'password' => Hash::make('password'), 'role_id' => $superadminId],
            
            // Dokter Spesialis
            ['name' => 'dr. Andi Wijaya, Sp.PD', 'email' => 'andi.wijaya@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Siti Rahayu, Sp.A', 'email' => 'siti.rahayu@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'drg. Budi Santoso', 'email' => 'budi.santoso@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Maya Putri, Sp.OG', 'email' => 'maya.putri@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Hendra Gunawan, Sp.B', 'email' => 'hendra.gunawan@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Lisa Permata, Sp.M', 'email' => 'lisa.permata@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Robertus Adi, Sp.JP', 'email' => 'robertus.adi@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Nita Wahyuni, Sp.PD-KGEH', 'email' => 'nita.wahyuni@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Ferdianto, Sp.THT-KL', 'email' => 'ferdianto@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Yuni Astuti, Sp.KK', 'email' => 'yuni.astuti@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Reza Pahlevi, Sp.BS', 'email' => 'reza.pahlevi@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Ratna Sari, Sp.KGA', 'email' => 'ratna.sari@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Herman Wijaya, Sp.U', 'email' => 'herman.wijaya@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            ['name' => 'dr. Dewi Malinda, Sp.Par', 'email' => 'dewi.malinda@emira.app', 'password' => Hash::make('password'), 'role_id' => $dokterId],
            
            // Perawat
            ['name' => 'Ns. Rina Susanti, S.Kep', 'email' => 'rina.susanti@emira.app', 'password' => Hash::make('password'), 'role_id' => $perawatId],
            ['name' => 'Ns. Doni Prasetyo, S.Kep', 'email' => 'doni.prasetyo@emira.app', 'password' => Hash::make('password'), 'role_id' => $perawatId],
            ['name' => 'Ns. Lestari Dewi, S.Kep', 'email' => 'lestari.dewi@emira.app', 'password' => Hash::make('password'), 'role_id' => $perawatId],
            ['name' => 'Ns. Ahmad SYahputra, S.Kep', 'email' => 'ahmad.syahputra@emira.app', 'password' => Hash::make('password'), 'role_id' => $perawatId],
            ['name' => 'Ns. Melati Indah, S.Kep', 'email' => 'melati.indah@emira.app', 'password' => Hash::make('password'), 'role_id' => $perawatId],
            ['name' => 'Ns. Toni Hartono, S.Kep', 'email' => 'toni.hartono@emira.app', 'password' => Hash::make('password'), 'role_id' => $perawatId],
            ['name' => 'Ns. Siti Nurhaliza, S.Kep', 'email' => 'siti.nurhaliza@emira.app', 'password' => Hash::make('password'), 'role_id' => $perawatId],
            ['name' => 'Ns. Bagus Prakoso, S.Kep', 'email' => 'bagus.prakoso@emira.app', 'password' => Hash::make('password'), 'role_id' => $perawatId],
            
            // Rekam Medis
            ['name' => 'Ahmad Fauzi, A.Md.RMIK', 'email' => 'ahmad.fauzi@emira.app', 'password' => Hash::make('password'), 'role_id' => $rekamMedisId],
            ['name' => 'Dewi Kurniawati, A.Md.RMIK', 'email' => 'dewi.kurniawati@emira.app', 'password' => Hash::make('password'), 'role_id' => $rekamMedisId],
            ['name' => 'Rizki Pratama, A.Md.RMIK', 'email' => 'rizki.pratama@emira.app', 'password' => Hash::make('password'), 'role_id' => $rekamMedisId],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(['email' => $user['email']], array_merge($user, [
                'is_active' => 1,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ UserSeeder: ' . count($users) . ' user EMIRA berhasil dibuat.');
    }
}
