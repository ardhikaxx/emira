<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $query = Dokter::with(['user', 'poli']);

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nip', 'like', '%' . $request->search . '%');
            });
        }

        $dokters = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('dokter.index', compact('dokters'));
    }

    public function create()
    {
        return view('dokter.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nip' => 'required|string|max:50',
            'no_sip' => 'required|string|max:50',
            'no_str' => 'required|string|max:50',
            'gelar_depan' => 'nullable|string|max:20',
            'nama_lengkap' => 'required|string|max:100',
            'gelar_belakang' => 'nullable|string|max:30',
            'spesialisasi' => 'required|string|max:100',
            'poli_id' => 'required|exists:polis,id',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Dokter::create($validated);

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan');
    }

    public function edit(Dokter $dokter)
    {
        return view('dokter.edit', compact('dokter'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nip' => 'required|string|max:50',
            'no_sip' => 'required|string|max:50',
            'no_str' => 'required|string|max:50',
            'gelar_depan' => 'nullable|string|max:20',
            'nama_lengkap' => 'required|string|max:100',
            'gelar_belakang' => 'nullable|string|max:30',
            'spesialisasi' => 'required|string|max:100',
            'poli_id' => 'required|exists:polis,id',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $dokter->update($validated);

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil diperbarui');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil dihapus');
    }
}
