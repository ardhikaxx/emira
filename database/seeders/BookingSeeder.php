<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data yang diperlukan
        $pasiens = DB::table('pasiens')->limit(8)->get();
        $polis = DB::table('polis')->get();
        
        if ($pasiens->isEmpty() || $polis->isEmpty()) {
            $this->command->warn('⚠️ BookingSeeder: Data pasien atau poli tidak ditemukan. Jalankan PasienSeeder dan PoliSeeder terlebih dahulu.');
            return;
        }

        $bookings = [];
        $bookingCount = 0;

        // Booking untuk hari ini (pending & confirmed)
        foreach ($pasiens->take(3) as $index => $pasien) {
            $poli = $polis->random();
            $dokter = DB::table('dokters')->where('poli_id', $poli->id)->first();
            
            if (!$dokter) continue;

            $jadwal = DB::table('jadwal_dokters')
                ->where('dokter_id', $dokter->id)
                ->where('poli_id', $poli->id)
                ->where('hari', strtolower(Carbon::now()->locale('id')->dayName))
                ->first();

            if (!$jadwal) {
                // Cari jadwal hari lain
                $jadwal = DB::table('jadwal_dokters')
                    ->where('dokter_id', $dokter->id)
                    ->where('poli_id', $poli->id)
                    ->first();
            }

            if (!$jadwal) continue;

            $status = $index === 0 ? 'pending' : 'confirmed';
            $kode_booking = 'BKG-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            $bookings[] = [
                'kode_booking' => $kode_booking,
                'pasien_id' => $pasien->id,
                'poli_id' => $poli->id,
                'dokter_id' => $dokter->id,
                'jadwal_dokter_id' => $jadwal->id,
                'tanggal_booking' => Carbon::today(),
                'jam_booking' => Carbon::parse($jadwal->jam_mulai)->format('H:i:s'),
                'jenis_pembayaran' => $index % 2 === 0 ? 'umum' : 'bpjs',
                'no_bpjs' => $index % 2 === 0 ? null : '0001234567890',
                'keluhan' => $this->getRandomKeluhan(),
                'status' => $status,
                'confirmed_at' => $status === 'confirmed' ? Carbon::now()->subHours(2) : null,
                'created_at' => Carbon::now()->subHours(3),
                'updated_at' => Carbon::now()->subHours(2),
            ];
            $bookingCount++;
        }

        // Booking untuk besok (pending & confirmed)
        foreach ($pasiens->skip(3)->take(3) as $index => $pasien) {
            $poli = $polis->random();
            $dokter = DB::table('dokters')->where('poli_id', $poli->id)->first();
            
            if (!$dokter) continue;

            $tomorrow = Carbon::tomorrow();
            $jadwal = DB::table('jadwal_dokters')
                ->where('dokter_id', $dokter->id)
                ->where('poli_id', $poli->id)
                ->where('hari', strtolower($tomorrow->locale('id')->dayName))
                ->first();

            if (!$jadwal) {
                $jadwal = DB::table('jadwal_dokters')
                    ->where('dokter_id', $dokter->id)
                    ->where('poli_id', $poli->id)
                    ->first();
            }

            if (!$jadwal) continue;

            $status = $index === 0 ? 'pending' : 'confirmed';
            $kode_booking = 'BKG-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            $bookings[] = [
                'kode_booking' => $kode_booking,
                'pasien_id' => $pasien->id,
                'poli_id' => $poli->id,
                'dokter_id' => $dokter->id,
                'jadwal_dokter_id' => $jadwal->id,
                'tanggal_booking' => $tomorrow,
                'jam_booking' => Carbon::parse($jadwal->jam_mulai)->format('H:i:s'),
                'jenis_pembayaran' => $index % 2 === 0 ? 'bpjs' : 'umum',
                'no_bpjs' => $index % 2 === 0 ? '0009876543210' : null,
                'keluhan' => $this->getRandomKeluhan(),
                'status' => $status,
                'confirmed_at' => $status === 'confirmed' ? Carbon::now()->subHour() : null,
                'created_at' => Carbon::now()->subHours(5),
                'updated_at' => Carbon::now()->subHour(),
            ];
            $bookingCount++;
        }

        // Booking kemarin (completed & cancelled)
        foreach ($pasiens->skip(6)->take(2) as $index => $pasien) {
            $poli = $polis->random();
            $dokter = DB::table('dokters')->where('poli_id', $poli->id)->first();
            
            if (!$dokter) continue;

            $yesterday = Carbon::yesterday();
            $jadwal = DB::table('jadwal_dokters')
                ->where('dokter_id', $dokter->id)
                ->where('poli_id', $poli->id)
                ->where('hari', strtolower($yesterday->locale('id')->dayName))
                ->first();

            if (!$jadwal) {
                $jadwal = DB::table('jadwal_dokters')
                    ->where('dokter_id', $dokter->id)
                    ->where('poli_id', $poli->id)
                    ->first();
            }

            if (!$jadwal) continue;

            $status = $index === 0 ? 'completed' : 'cancelled';
            $kode_booking = 'BKG-' . $yesterday->format('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            $bookings[] = [
                'kode_booking' => $kode_booking,
                'pasien_id' => $pasien->id,
                'poli_id' => $poli->id,
                'dokter_id' => $dokter->id,
                'jadwal_dokter_id' => $jadwal->id,
                'tanggal_booking' => $yesterday,
                'jam_booking' => Carbon::parse($jadwal->jam_mulai)->format('H:i:s'),
                'jenis_pembayaran' => 'umum',
                'no_bpjs' => null,
                'keluhan' => $this->getRandomKeluhan(),
                'status' => $status,
                'confirmed_at' => $status === 'completed' ? $yesterday->copy()->addHours(2) : null,
                'cancelled_at' => $status === 'cancelled' ? $yesterday->copy()->addHours(3) : null,
                'catatan_pembatalan' => $status === 'cancelled' ? 'Pasien berubah pikiran dan tidak jadi datang' : null,
                'created_at' => $yesterday->copy()->subHours(6),
                'updated_at' => $yesterday->copy()->addHours(3),
            ];
            $bookingCount++;
        }

        // Insert bookings
        foreach ($bookings as $booking) {
            DB::table('bookings')->insert($booking);
        }

        $this->command->info("✅ BookingSeeder: {$bookingCount} booking berhasil dibuat.");
        $this->command->table(
            ['Status', 'Jumlah'],
            [
                ['Pending', collect($bookings)->where('status', 'pending')->count()],
                ['Confirmed', collect($bookings)->where('status', 'confirmed')->count()],
                ['Completed', collect($bookings)->where('status', 'completed')->count()],
                ['Cancelled', collect($bookings)->where('status', 'cancelled')->count()],
            ]
        );
    }

    private function getRandomKeluhan(): string
    {
        $keluhans = [
            'Demam tinggi sejak 2 hari yang lalu',
            'Batuk dan pilek tidak kunjung sembuh',
            'Sakit kepala berkepanjangan',
            'Nyeri perut dan mual',
            'Gigi berlubang dan sakit',
            'Kontrol rutin kesehatan',
            'Pemeriksaan kehamilan rutin',
            'Sakit tenggorokan dan susah menelan',
            'Gatal-gatal pada kulit',
            'Nyeri sendi dan pegal-pegal',
            'Sesak napas',
            'Mata merah dan berair',
            'Telinga sakit dan berdengung',
            'Luka yang tidak kunjung sembuh',
            'Kontrol tekanan darah tinggi',
        ];

        return $keluhans[array_rand($keluhans)];
    }
}
