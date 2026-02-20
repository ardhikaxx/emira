<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Models\RekamMedis;
use App\Models\Diagnosa;
use App\Models\TindakanMedis;
use App\Models\VitalSign;
use App\Models\Icd10Master;
use App\Models\MasterTindakan;
use App\Models\ActivityLog;
use App\Models\Dokter;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $query = RekamMedis::with(['pasien', 'dokter', 'kunjungan.poli']);

        if ($request->search) {
            $query->whereHas('pasien', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('no_rm', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->dokter_id) {
            $query->where('dokter_id', $request->dokter_id);
        }

        $rekamMedis = $query->orderBy('tanggal_periksa', 'desc')->paginate(10);
        $dokters = Dokter::where('is_active', 1)->get();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'view',
            'module' => 'rekam_medis',
            'deskripsi' => 'Melihat daftar rekam medis',
            'created_at' => now(),
        ]);

        return view('rekam_medis.index', compact('rekamMedis', 'dokters'));
    }

    public function create(Kunjungan $kunjungan)
    {
        $kunjungan->load(['pasien', 'dokter', 'poli', 'vitalSigns']);
        
        $icd10s = Icd10Master::where('is_active', 1)->orderBy('kode')->get();
        $tindakans = MasterTindakan::where('is_active', 1)->orderBy('kategori')->orderBy('nama_tindakan')->get();

        return view('rekam_medis.create', compact('kunjungan', 'icd10s', 'tindakans'));
    }

    public function store(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'anamnesis' => 'required',
        ]);

        $no_rm_kunjungan = $kunjungan->no_kunjungan . '-RM';

        $rekamMedis = RekamMedis::create([
            'no_rm_kunjungan' => $no_rm_kunjungan,
            'kunjungan_id' => $kunjungan->id,
            'pasien_id' => $kunjungan->pasien_id,
            'dokter_id' => $kunjungan->dokter_id,
            'tanggal_periksa' => now(),
            'anamnesis' => $request->anamnesis,
            'riwayat_penyakit_dahulu' => $request->riwayat_penyakit_dahulu,
            'riwayat_penyakit_keluarga' => $request->riwayat_penyakit_keluarga,
            'riwayat_alergi' => $request->riwayat_alergi,
            'riwayat_obat_rutin' => $request->riwayat_obat_rutin,
            'catatan_dokter' => $request->catatan_dokter,
            'rencana_tindak_lanjut' => $request->rencana_tindak_lanjut,
        ]);

        if ($request->icd10_id) {
            foreach ($request->icd10_id as $index => $icd10_id) {
                Diagnosa::create([
                    'rekam_medis_id' => $rekamMedis->id,
                    'icd10_id' => $icd10_id,
                    'jenis' => $request->jenis_diagnosa[$index] ?? 'utama',
                ]);
            }
        }

        if ($request->tindakan_id) {
            foreach ($request->tindakan_id as $index => $tindakan_id) {
                TindakanMedis::create([
                    'rekam_medis_id' => $rekamMedis->id,
                    'kunjungan_id' => $kunjungan->id,
                    'master_tindakan_id' => $tindakan_id,
                    'dilakukan_oleh' => Auth::id(),
                    'tanggal_tindakan' => today(),
                    'jam_tindakan' => now()->format('H:i:s'),
                    'jumlah' => $request->jumlah_tindakan[$index] ?? 1,
                    'keterangan' => $request->keterangan_tindakan[$index] ?? null,
                ]);
            }
        }

        $kunjungan->update(['status' => 'selesai']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'module' => 'rekam_medis',
            'referensi_id' => $rekamMedis->id,
            'deskripsi' => 'Membuat rekam medis untuk pasien',
            'created_at' => now(),
        ]);

        return redirect()->route('rekam_medis.show', $rekamMedis->id)->with('success', 'Rekam medis berhasil disimpan.');
    }

    public function show(RekamMedis $rekam_medis)
    {
        $rekam_medis->load(['pasien', 'dokter', 'kunjungan.poli', 'diagnosas.icd10', 'tindakanMedis.masterTindakan']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'view',
            'module' => 'rekam_medis',
            'referensi_id' => $rekam_medis->id,
            'deskripsi' => 'Melihat detail rekam medis',
            'created_at' => now(),
        ]);

        return view('rekam_medis.show', compact('rekam_medis'));
    }

    public function edit(RekamMedis $rekam_medis)
    {
        $rekam_medis->load(['pasien', 'dokter', 'kunjungan.poli', 'diagnosas.icd10', 'tindakanMedis.masterTindakan']);
        $icd10s = Icd10Master::where('is_active', 1)->orderBy('kode')->get();
        $tindakans = MasterTindakan::where('is_active', 1)->orderBy('kategori')->orderBy('nama_tindakan')->get();

        return view('rekam_medis.edit', compact('rekam_medis', 'icd10s', 'tindakans'));
    }

    public function update(Request $request, RekamMedis $rekam_medis)
    {
        $request->validate([
            'anamnesis' => 'required',
        ]);

        $rekam_medis->update([
            'anamnesis' => $request->anamnesis,
            'riwayat_penyakit_dahulu' => $request->riwayat_penyakit_dahulu,
            'riwayat_penyakit_keluarga' => $request->riwayat_penyakit_keluarga,
            'riwayat_alergi' => $request->riwayat_alergi,
            'riwayat_obat_rutin' => $request->riwayat_obat_rutin,
            'catatan_dokter' => $request->catatan_dokter,
            'rencana_tindak_lanjut' => $request->rencana_tindak_lanjut,
        ]);

        if (isset($request->diagnosa_ids)) {
            foreach ($request->diagnosa_ids as $index => $diagnosa_id) {
                if ($diagnosa_id) {
                    Diagnosa::where('id', $diagnosa_id)->update([
                        'icd10_id' => $request->icd10_id[$index],
                        'jenis' => $request->jenis_diagnosa[$index] ?? 'utama',
                    ]);
                } elseif (isset($request->icd10_id[$index])) {
                    Diagnosa::create([
                        'rekam_medis_id' => $rekam_medis->id,
                        'icd10_id' => $request->icd10_id[$index],
                        'jenis' => $request->jenis_diagnosa[$index] ?? 'utama',
                    ]);
                }
            }
        }

        if (isset($request->tindakan_ids)) {
            foreach ($request->tindakan_ids as $index => $tindakan_id) {
                if ($tindakan_id) {
                    TindakanMedis::where('id', $tindakan_id)->update([
                        'master_tindakan_id' => $request->tindakan_id[$index],
                        'jumlah' => $request->jumlah_tindakan[$index] ?? 1,
                        'keterangan' => $request->keterangan_tindakan[$index] ?? null,
                    ]);
                } elseif (isset($request->tindakan_id[$index])) {
                    TindakanMedis::create([
                        'rekam_medis_id' => $rekam_medis->id,
                        'kunjungan_id' => $rekam_medis->kunjungan_id,
                        'master_tindakan_id' => $request->tindakan_id[$index],
                        'dilakukan_oleh' => Auth::id(),
                        'tanggal_tindakan' => today(),
                        'jam_tindakan' => now()->format('H:i:s'),
                        'jumlah' => $request->jumlah_tindakan[$index] ?? 1,
                        'keterangan' => $request->keterangan_tindakan[$index] ?? null,
                    ]);
                }
            }
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'module' => 'rekam_medis',
            'referensi_id' => $rekam_medis->id,
            'deskripsi' => 'Mengupdate rekam medis',
            'created_at' => now(),
        ]);

        return redirect()->route('rekam_medis.show', $rekam_medis->id)->with('success', 'Rekam medis berhasil diperbarui.');
    }
}
