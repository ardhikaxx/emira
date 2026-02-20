<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;
use App\Models\VitalSign;
use App\Models\TindakanKeperawatan;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class VitalSignController extends Controller
{
    public function index(Request $request)
    {
        $query = VitalSign::with(['pasien', 'kunjungan']);

        if ($request->search) {
            $query->whereHas('pasien', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('no_rm', 'like', '%' . $request->search . '%');
            });
        }

        $vitalSigns = $query->latest()->paginate(10);
        return view('vital_sign.index', compact('vitalSigns'));
    }

    public function store(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'tekanan_darah_sistol' => 'required|integer',
            'tekanan_darah_diastol' => 'required|integer',
            'nadi' => 'required|integer',
            'pernapasan' => 'required|integer',
            'suhu' => 'required|numeric',
        ]);

        $bmi = null;
        if ($request->berat_badan && $request->tinggi_badan) {
            $tinggiMeter = $request->tinggi_badan / 100;
            $bmi = round($request->berat_badan / ($tinggiMeter * $tinggiMeter), 2);
        }

        $vitalSign = VitalSign::create([
            'kunjungan_id' => $kunjungan->id,
            'pasien_id' => $kunjungan->pasien_id,
            'tekanan_darah_sistol' => $request->tekanan_darah_sistol,
            'tekanan_darah_diastol' => $request->tekanan_darah_diastol,
            'nadi' => $request->nadi,
            'pernapasan' => $request->pernapasan,
            'suhu' => $request->suhu,
            'saturasi_oksigen' => $request->saturasi_oksigen,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'bmi' => $bmi,
            'lingkar_perut' => $request->lingkar_perut,
            'gula_darah_sewaktu' => $request->gula_darah_sewaktu,
            'kesadaran' => $request->kesadaran,
            'catatan' => $request->catatan,
            'recorded_by' => Auth::id(),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'module' => 'vital_sign',
            'referensi_id' => $vitalSign->id,
            'deskripsi' => 'Mencatat vital sign pasien',
            'created_at' => now(),
        ]);

        return back()->with('success', 'Vital sign berhasil disimpan.');
    }
}
