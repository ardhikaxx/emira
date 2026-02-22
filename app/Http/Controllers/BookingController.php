<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\Antrian;
use App\Models\Kunjungan;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Public: Form booking untuk pasien
    public function create()
    {
        $polis = Poli::where('is_active', 1)->get();
        return view('booking.create', compact('polis'));
    }

    // Public: Cek pasien by No. RM atau NIK
    public function checkPasien(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string'
        ]);

        $pasien = Pasien::where('no_rm', $request->identifier)
            ->orWhere('nik', $request->identifier)
            ->first();

        if (!$pasien) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'pasien' => [
                'id' => $pasien->id,
                'no_rm' => $pasien->no_rm,
                'nama_lengkap' => $pasien->nama_lengkap,
                'tanggal_lahir' => $pasien->tanggal_lahir->format('d/m/Y'),
                'jenis_kelamin' => $pasien->jenis_kelamin,
                'no_hp' => $pasien->no_hp,
            ]
        ]);
    }

    // Public: Get jadwal dokter by poli dan tanggal
    public function getJadwalDokter(Request $request)
    {
        $request->validate([
            'poli_id' => 'required|exists:polis,id',
            'tanggal' => 'required|date'
        ]);

        $tanggal = Carbon::parse($request->tanggal);
        $hari = $this->getHariIndonesia($tanggal->dayOfWeek);

        $jadwals = JadwalDokter::with(['dokter', 'poli'])
            ->where('poli_id', $request->poli_id)
            ->where('hari', $hari)
            ->where('is_active', 1)
            ->get();

        $result = [];
        foreach ($jadwals as $jadwal) {
            // Hitung booking yang sudah ada
            $bookingCount = Booking::where('jadwal_dokter_id', $jadwal->id)
                ->where('tanggal_booking', $tanggal->format('Y-m-d'))
                ->whereIn('status', ['pending', 'confirmed'])
                ->count();

            $sisaKuota = $jadwal->kuota_pasien - $bookingCount;

            if ($sisaKuota > 0) {
                $result[] = [
                    'id' => $jadwal->id,
                    'dokter_id' => $jadwal->dokter_id,
                    'dokter_nama' => $jadwal->dokter->gelar_depan . ' ' . $jadwal->dokter->nama_lengkap . 
                                    ($jadwal->dokter->gelar_belakang ? ', ' . $jadwal->dokter->gelar_belakang : ''),
                    'spesialisasi' => $jadwal->dokter->spesialisasi,
                    'jam_mulai' => Carbon::parse($jadwal->jam_mulai)->format('H:i'),
                    'jam_selesai' => Carbon::parse($jadwal->jam_selesai)->format('H:i'),
                    'kuota_pasien' => $jadwal->kuota_pasien,
                    'sisa_kuota' => $sisaKuota,
                ];
            }
        }

        return response()->json($result);
    }

    // Public: Store booking
    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'poli_id' => 'required|exists:polis,id',
            'dokter_id' => 'required|exists:dokters,id',
            'jadwal_dokter_id' => 'required|exists:jadwal_dokters,id',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jenis_pembayaran' => 'required|in:umum,bpjs',
            'no_bpjs' => 'required_if:jenis_pembayaran,bpjs',
            'keluhan' => 'nullable|string|max:500',
        ]);

        // Cek kuota
        $jadwal = JadwalDokter::findOrFail($request->jadwal_dokter_id);
        $bookingCount = Booking::where('jadwal_dokter_id', $request->jadwal_dokter_id)
            ->where('tanggal_booking', $request->tanggal_booking)
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();

        if ($bookingCount >= $jadwal->kuota_pasien) {
            return back()->with('error', 'Kuota booking untuk jadwal ini sudah penuh.');
        }

        // Generate kode booking
        $kode_booking = 'BKG-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

        $booking = Booking::create([
            'kode_booking' => $kode_booking,
            'pasien_id' => $request->pasien_id,
            'poli_id' => $request->poli_id,
            'dokter_id' => $request->dokter_id,
            'jadwal_dokter_id' => $request->jadwal_dokter_id,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_booking' => Carbon::parse($jadwal->jam_mulai)->format('H:i:s'),
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'no_bpjs' => $request->no_bpjs,
            'keluhan' => $request->keluhan,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.success', $booking->kode_booking);
    }

    // Public: Success page
    public function success($kode_booking)
    {
        $booking = Booking::with(['pasien', 'poli', 'dokter', 'jadwalDokter'])
            ->where('kode_booking', $kode_booking)
            ->firstOrFail();

        return view('booking.success', compact('booking'));
    }

    // Public: Cek status booking
    public function checkStatus()
    {
        return view('booking.check');
    }

    public function getStatus(Request $request)
    {
        $request->validate([
            'kode_booking' => 'required|string'
        ]);

        $booking = Booking::with(['pasien', 'poli', 'dokter', 'jadwalDokter', 'antrian'])
            ->where('kode_booking', $request->kode_booking)
            ->first();

        if (!$booking) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'booking' => [
                'kode_booking' => $booking->kode_booking,
                'pasien_nama' => $booking->pasien->nama_lengkap,
                'poli' => $booking->poli->nama_poli,
                'dokter' => $booking->dokter->gelar_depan . ' ' . $booking->dokter->nama_lengkap,
                'tanggal' => $booking->tanggal_booking->format('d/m/Y'),
                'jam' => Carbon::parse($booking->jam_booking)->format('H:i'),
                'status' => $booking->status_text,
                'status_badge' => $booking->status_badge,
                'no_antrian' => $booking->antrian?->no_urut,
            ]
        ]);
    }

    // Admin: Daftar booking
    public function index(Request $request)
    {
        $query = Booking::with(['pasien', 'poli', 'dokter', 'jadwalDokter'])
            ->orderBy('tanggal_booking', 'desc')
            ->orderBy('created_at', 'desc');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->tanggal) {
            $query->whereDate('tanggal_booking', $request->tanggal);
        }

        $bookings = $query->paginate(20);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'view',
            'module' => 'booking',
            'deskripsi' => 'Melihat daftar booking online',
            'created_at' => now(),
        ]);

        return view('booking.index', compact('bookings'));
    }

    // Admin: Konfirmasi booking
    public function confirm(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking tidak dapat dikonfirmasi.');
        }

        DB::beginTransaction();
        try {
            // Update booking
            $booking->update([
                'status' => 'confirmed',
                'confirmed_at' => now(),
            ]);

            // Buat antrian otomatis jika tanggal booking = hari ini
            if ($booking->tanggal_booking->isToday()) {
                $lastAntrian = Antrian::where('poli_id', $booking->poli_id)
                    ->whereDate('tanggal', today())
                    ->orderBy('no_urut', 'desc')
                    ->first();

                $no_urut = $lastAntrian ? $lastAntrian->no_urut + 1 : 1;
                $kode_antrian = $booking->poli_id . str_pad($no_urut, 3, '0', STR_PAD_LEFT);

                $antrian = Antrian::create([
                    'kode_antrian' => $kode_antrian,
                    'no_urut' => $no_urut,
                    'pasien_id' => $booking->pasien_id,
                    'poli_id' => $booking->poli_id,
                    'dokter_id' => $booking->dokter_id,
                    'tanggal' => today(),
                    'sumber' => 'online',
                    'status' => 'menunggu',
                    'jam_daftar' => now(),
                ]);

                $no_kunjungan = 'EMIRA-KJN-' . date('Ymd') . '-' . str_pad(Kunjungan::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

                Kunjungan::create([
                    'no_kunjungan' => $no_kunjungan,
                    'pasien_id' => $booking->pasien_id,
                    'dokter_id' => $booking->dokter_id,
                    'poli_id' => $booking->poli_id,
                    'antrian_id' => $antrian->id,
                    'tanggal_kunjungan' => today(),
                    'jam_datang' => now()->format('H:i:s'),
                    'jenis_kunjungan' => 'rawat_jalan',
                    'jenis_pembayaran' => $booking->jenis_pembayaran,
                    'no_bpjs_kunjungan' => $booking->no_bpjs,
                    'keluhan_utama' => $booking->keluhan,
                    'status' => 'menunggu',
                    'registered_by' => Auth::id(),
                ]);

                $booking->update(['antrian_id' => $antrian->id]);
            }

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'update',
                'module' => 'booking',
                'referensi_id' => $booking->id,
                'deskripsi' => 'Mengkonfirmasi booking: ' . $booking->kode_booking,
                'created_at' => now(),
            ]);

            DB::commit();
            return back()->with('success', 'Booking berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengkonfirmasi booking: ' . $e->getMessage());
        }
    }

    // Admin: Batalkan booking
    public function cancel(Request $request, Booking $booking)
    {
        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'Booking tidak dapat dibatalkan.');
        }

        $booking->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'catatan_pembatalan' => $request->catatan_pembatalan,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'module' => 'booking',
            'referensi_id' => $booking->id,
            'deskripsi' => 'Membatalkan booking: ' . $booking->kode_booking,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }

    // Admin: Detail booking (AJAX)
    public function detail(Booking $booking)
    {
        $booking->load(['pasien', 'poli', 'dokter', 'jadwalDokter', 'antrian']);

        return response()->json([
            'success' => true,
            'booking' => [
                'id' => $booking->id,
                'kode_booking' => $booking->kode_booking,
                'status' => $booking->status,
                'status_text' => $booking->status_text,
                'status_badge' => $booking->status_badge,
                'tanggal_booking' => $booking->tanggal_booking->format('d/m/Y'),
                'jam_booking' => Carbon::parse($booking->jam_booking)->format('H:i'),
                'jenis_pembayaran' => $booking->jenis_pembayaran,
                'no_bpjs' => $booking->no_bpjs,
                'keluhan' => $booking->keluhan,
                'catatan_pembatalan' => $booking->catatan_pembatalan,
                'created_at' => $booking->created_at->format('d/m/Y H:i'),
                'confirmed_at' => $booking->confirmed_at ? $booking->confirmed_at->format('d/m/Y H:i') : null,
                'cancelled_at' => $booking->cancelled_at ? $booking->cancelled_at->format('d/m/Y H:i') : null,
                'pasien' => [
                    'id' => $booking->pasien->id,
                    'no_rm' => $booking->pasien->no_rm,
                    'nik' => $booking->pasien->nik,
                    'nama_lengkap' => $booking->pasien->nama_lengkap,
                    'no_hp' => $booking->pasien->no_hp,
                ],
                'poli' => [
                    'id' => $booking->poli->id,
                    'nama_poli' => $booking->poli->nama_poli,
                ],
                'dokter_nama' => $booking->dokter->gelar_depan . ' ' . $booking->dokter->nama_lengkap . 
                                ($booking->dokter->gelar_belakang ? ', ' . $booking->dokter->gelar_belakang : ''),
                'antrian' => $booking->antrian ? [
                    'id' => $booking->antrian->id,
                    'kode_antrian' => $booking->antrian->kode_antrian,
                    'no_urut' => $booking->antrian->no_urut,
                ] : null,
            ]
        ]);
    }

    private function getHariIndonesia($dayOfWeek): string
    {
        return match($dayOfWeek) {
            0 => 'minggu',
            1 => 'senin',
            2 => 'selasa',
            3 => 'rabu',
            4 => 'kamis',
            5 => 'jumat',
            6 => 'sabtu',
        };
    }
}
