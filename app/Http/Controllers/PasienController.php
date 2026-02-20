<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $query = Pasien::query()->orderBy('created_at', 'desc');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('no_rm', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%')
                  ->orWhere('no_hp', 'like', '%' . $request->search . '%');
            });
        }

        $pasiens = $query->paginate(10);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'view',
            'module' => 'pasien',
            'deskripsi' => 'Melihat daftar pasien',
            'created_at' => now(),
        ]);

        return view('pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:pasiens,nik',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        $lastPasien = Pasien::orderBy('id', 'desc')->first();
        $no_rm = 'EMIRA-RM-' . date('Y') . '-' . str_pad(($lastPasien ? $lastPasien->id + 1 : 1), 6, '0', STR_PAD_LEFT);

        $pasien = Pasien::create(array_merge($request->all(), ['no_rm' => $no_rm]));

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'module' => 'pasien',
            'referensi_id' => $pasien->id,
            'referensi_type' => 'pasien',
            'deskripsi' => 'Menambah pasien baru: ' . $pasien->nama_lengkap,
            'created_at' => now(),
        ]);

        return redirect()->route('pasien.show', $pasien->id)->with('success', 'Pasien berhasil didaftarkan dengan No. RM: ' . $no_rm);
    }

    public function show(Pasien $pasien)
    {
        $pasien->load(['kunjungan.poli', 'kunjungan.dokter', 'rekamMedis']);
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'view',
            'module' => 'pasien',
            'referensi_id' => $pasien->id,
            'deskripsi' => 'Melihat detail pasien: ' . $pasien->nama_lengkap,
            'created_at' => now(),
        ]);

        return view('pasien.show', compact('pasien'));
    }

    public function edit(Pasien $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nik' => 'required|unique:pasiens,nik,' . $pasien->id,
            'nama_lengkap' => 'required',
        ]);

        $pasien->update($request->all());

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'module' => 'pasien',
            'referensi_id' => $pasien->id,
            'deskripsi' => 'Mengubah data pasien: ' . $pasien->nama_lengkap,
            'created_at' => now(),
        ]);

        return redirect()->route('pasien.show', $pasien->id)->with('success', 'Data pasien berhasil diperbarui.');
    }
}
