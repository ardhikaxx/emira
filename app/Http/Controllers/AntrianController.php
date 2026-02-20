<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Antrian;
use App\Models\Kunjungan;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AntrianController extends Controller
{
    public function index(Request $request)
    {
        $query = Antrian::with(['pasien', 'poli', 'dokter', 'kunjungan'])
            ->whereDate('tanggal', today())
            ->orderBy('no_urut');

        if ($request->poli_id) {
            $query->where('poli_id', $request->poli_id);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $antrians = $query->orderBy('no_urut')->paginate(10);
        $polis = Poli::where('is_active', 1)->get();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'view',
            'module' => 'antrian',
            'deskripsi' => 'Melihat daftar antrian',
            'created_at' => now(),
        ]);

        return view('antrian.index', compact('antrians', 'polis'));
    }

    public function create()
    {
        $pasiens = Pasien::where('is_active', 1)->orderBy('nama_lengkap')->get();
        $polis = Poli::where('is_active', 1)->get();
        return view('antrian.create', compact('pasiens', 'polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'poli_id' => 'required|exists:polis,id',
            'dokter_id' => 'required|exists:dokters,id',
        ]);

        $lastAntrian = Antrian::where('poli_id', $request->poli_id)
            ->whereDate('tanggal', today())
            ->orderBy('no_urut', 'desc')
            ->first();

        $no_urut = $lastAntrian ? $lastAntrian->no_urut + 1 : 1;
        $kode_antrian = $request->poli_id . str_pad($no_urut, 3, '0', STR_PAD_LEFT);

        $antrian = Antrian::create([
            'kode_antrian' => $kode_antrian,
            'no_urut' => $no_urut,
            'pasien_id' => $request->pasien_id,
            'poli_id' => $request->poli_id,
            'dokter_id' => $request->dokter_id,
            'tanggal' => today(),
            'sumber' => 'loket',
            'status' => 'menunggu',
            'jam_daftar' => now(),
        ]);

        $no_kunjungan = 'EMIRA-KJN-' . date('Ymd') . '-' . str_pad(Antrian::count(), 4, '0', STR_PAD_LEFT);

        Kunjungan::create([
            'no_kunjungan' => $no_kunjungan,
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'poli_id' => $request->poli_id,
            'antrian_id' => $antrian->id,
            'tanggal_kunjungan' => today(),
            'jam_datang' => now()->format('H:i:s'),
            'jenis_kunjungan' => 'rawat_jalan',
            'jenis_pembayaran' => $request->jenis_pembayaran ?? 'umum',
            'status' => 'menunggu',
            'registered_by' => Auth::id(),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'module' => 'antrian',
            'referensi_id' => $antrian->id,
            'deskripsi' => 'Mendaftarkan antrian baru',
            'created_at' => now(),
        ]);

        return redirect()->route('antrian.index')->with('success', 'Antrian berhasil dibuat. No. Antrian: ' . $no_urut);
    }

    public function panggil(Antrian $antrian)
    {
        if ($antrian->status != 'menunggu') {
            return back()->with('error', 'Antrian tidak dapat dipanggil.');
        }

        $antrian->update([
            'status' => 'dipanggil',
            'jam_dipanggil' => now(),
        ]);

        Kunjungan::where('antrian_id', $antrian->id)->update([
            'status' => 'dipanggil',
            'jam_dilayani' => now()->format('H:i:s'),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'module' => 'antrian',
            'referensi_id' => $antrian->id,
            'deskripsi' => 'Memanggil antrian: ' . $antrian->kode_antrian,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Antrian ' . $antrian->kode_antrian . ' dipanggil.');
    }

    public function layani(Antrian $antrian)
    {
        if (!in_array($antrian->status, ['dipanggil', 'dalam_pelayanan'])) {
            return back()->with('error', 'Antrian tidak dapat dilayani.');
        }

        $antrian->update(['status' => 'dalam_pelayanan']);

        Kunjungan::where('antrian_id', $antrian->id)->update([
            'status' => 'dalam_pemeriksaan',
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'module' => 'antrian',
            'referensi_id' => $antrian->id,
            'deskripsi' => 'Melayani antrian: ' . $antrian->kode_antrian,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Pasien sedang dilayani.');
    }

    public function selesai(Antrian $antrian)
    {
        if (!in_array($antrian->status, ['dipanggil', 'dalam_pelayanan'])) {
            return back()->with('error', 'Antrian belum dapat diselesaikan.');
        }

        $antrian->update([
            'status' => 'selesai',
            'jam_selesai' => now(),
        ]);

        Kunjungan::where('antrian_id', $antrian->id)->update([
            'status' => 'selesai',
            'jam_selesai' => now()->format('H:i:s'),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'module' => 'antrian',
            'referensi_id' => $antrian->id,
            'deskripsi' => 'Menyelesaikan antrian: ' . $antrian->kode_antrian,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Antrian selesai.');
    }

    public function getDoktersByPoli(Request $request)
    {
        $dokters = Dokter::where('poli_id', $request->poli_id)
            ->where('is_active', 1)
            ->get(['id', 'nama_lengkap', 'gelar_depan', 'gelar_belakang']);

        return response()->json($dokters);
    }
}
