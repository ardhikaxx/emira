<?php

namespace App\Http\Controllers;

use App\Models\MasterTindakan;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    public function index(Request $request)
    {
        $query = MasterTindakan::query();

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_tindakan', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_tindakan', 'like', '%' . $request->search . '%');
            });
        }

        $tindakans = $query->orderBy('kode_tindakan')->paginate(10);
        return view('tindakan.index', compact('tindakans'));
    }

    public function create()
    {
        return view('tindakan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_tindakan' => 'required|string|unique:master_tindakans,kode_tindakan|max:20',
            'nama_tindakan' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $validated['is_active'] = $request->has('is_active');

        MasterTindakan::create($validated);

        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil ditambahkan');
    }

    public function edit(MasterTindakan $tindakan)
    {
        return view('tindakan.edit', compact('tindakan'));
    }

    public function update(Request $request, MasterTindakan $tindakan)
    {
        $validated = $request->validate([
            'kode_tindakan' => 'required|string|unique:master_tindakans,kode_tindakan,' . $tindakan->id . '|max:20',
            'nama_tindakan' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $tindakan->update($validated);

        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil diperbarui');
    }

    public function destroy(MasterTindakan $tindakan)
    {
        $tindakan->delete();
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil dihapus');
    }
}
