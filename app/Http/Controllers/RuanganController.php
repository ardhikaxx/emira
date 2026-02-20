<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Ruangan::query();

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_ruangan', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_ruangan', 'like', '%' . $request->search . '%');
            });
        }

        $ruangans = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('ruangan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_ruangan' => 'required|string|unique:ruangans,kode_ruangan|max:20',
            'nama_ruangan' => 'required|string|max:100',
            'jenis' => 'required|in:rawat_inap,icu,ugd,isolasi,vip',
            'kapasitas' => 'required|integer|min:1',
            'lantai' => 'required|string|max:10',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Ruangan::create($validated);

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $validated = $request->validate([
            'kode_ruangan' => 'required|string|unique:ruangans,kode_ruangan,' . $ruangan->id . '|max:20',
            'nama_ruangan' => 'required|string|max:100',
            'jenis' => 'required|in:rawat_inap,icu,ugd,isolasi,vip',
            'kapasitas' => 'required|integer|min:1',
            'lantai' => 'required|string|max:10',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $ruangan->update($validated);

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diperbarui');
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus');
    }
}
