<?php

namespace App\Http\Controllers;

use App\Models\Icd10Master;
use Illuminate\Http\Request;

class Icd10Controller extends Controller
{
    public function index(Request $request)
    {
        $query = Icd10Master::query();

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_penyakit_indonesia', 'like', '%' . $request->search . '%')
                  ->orWhere('kode', 'like', '%' . $request->search . '%');
            });
        }

        $icd10s = $query->orderBy('kode')->paginate(10);
        return view('icd10.index', compact('icd10s'));
    }

    public function create()
    {
        return view('icd10.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|unique:icd10_masters,kode|max:10',
            'nama_penyakit_indonesia' => 'required|string|max:255',
            'nama_penyakit_inggris' => 'nullable|string|max:255',
            'kategori' => 'required|string|max:100',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Icd10Master::create($validated);

        return redirect()->route('icd10.index')->with('success', 'Kode ICD-10 berhasil ditambahkan');
    }

    public function edit(Icd10Master $icd10)
    {
        return view('icd10.edit', compact('icd10'));
    }

    public function update(Request $request, Icd10Master $icd10)
    {
        $validated = $request->validate([
            'kode' => 'required|string|unique:icd10_masters,kode,' . $icd10->id . '|max:10',
            'nama_penyakit_indonesia' => 'required|string|max:255',
            'nama_penyakit_inggris' => 'nullable|string|max:255',
            'kategori' => 'required|string|max:100',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $icd10->update($validated);

        return redirect()->route('icd10.index')->with('success', 'Kode ICD-10 berhasil diperbarui');
    }

    public function destroy(Icd10Master $icd10)
    {
        $icd10->delete();
        return redirect()->route('icd10.index')->with('success', 'Kode ICD-10 berhasil dihapus');
    }
}
