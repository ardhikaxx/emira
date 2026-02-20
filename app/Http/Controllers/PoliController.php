<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    public function index(Request $request)
    {
        $query = Poli::query();

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_poli', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_poli', 'like', '%' . $request->search . '%');
            });
        }

        $polis = $query->orderBy('nama_poli')->paginate(10);
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'view',
            'module' => 'poli',
            'deskripsi' => 'Melihat daftar poli',
            'created_at' => now(),
        ]);

        return view('poli.index', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_poli' => 'required|unique:polis,kode_poli',
            'nama_poli' => 'required',
        ]);

        $poli = Poli::create($request->all());

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'module' => 'poli',
            'referensi_id' => $poli->id,
            'deskripsi' => 'Menambah poli baru: ' . $poli->nama_poli,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Poli berhasil ditambahkan.');
    }

    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'kode_poli' => 'required|unique:polis,kode_poli,' . $poli->id,
            'nama_poli' => 'required',
        ]);

        $poli->update($request->all());

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'module' => 'poli',
            'referensi_id' => $poli->id,
            'deskripsi' => 'Mengubah poli: ' . $poli->nama_poli,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Poli berhasil diperbarui.');
    }

    public function destroy(Poli $poli)
    {
        $poli->delete();
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'module' => 'poli',
            'referensi_id' => $poli->id,
            'deskripsi' => 'Menghapus poli: ' . $poli->nama_poli,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Poli berhasil dihapus.');
    }
}
