<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    public function index(Request $request)
    {
        $query = JadwalDokter::with(['dokter', 'poli']);

        if ($request->dokter_id) {
            $query->where('dokter_id', $request->dokter_id);
        }

        if ($request->poli_id) {
            $query->where('poli_id', $request->poli_id);
        }

        $jadwals = $query->orderBy('hari')->orderBy('jam_mulai')->paginate(10);
        $dokters = Dokter::where('is_active', 1)->get();
        $polis = Poli::where('is_active', 1)->get();
        return view('jadwal.index', compact('jadwals', 'dokters', 'polis'));
    }

    public function create()
    {
        $dokters = Dokter::where('is_active', 1)->get();
        $polis = Poli::where('is_active', 1)->get();
        return view('jadwal.create', compact('dokters', 'polis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'poli_id' => 'required|exists:polis,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kuota_pasien' => 'required|integer|min:1',
        ]);

        $validated['is_active'] = $request->has('is_active');

        JadwalDokter::create($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal dokter berhasil ditambahkan');
    }

    public function edit(JadwalDokter $jadwal)
    {
        $dokters = Dokter::where('is_active', 1)->get();
        $polis = Poli::where('is_active', 1)->get();
        return view('jadwal.edit', compact('jadwal', 'dokters', 'polis'));
    }

    public function update(Request $request, JadwalDokter $jadwal)
    {
        $validated = $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'poli_id' => 'required|exists:polis,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kuota_pasien' => 'required|integer|min:1',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $jadwal->update($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal dokter berhasil diperbarui');
    }

    public function destroy(JadwalDokter $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal dokter berhasil dihapus');
    }
}
