<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturans = Pengaturan::all()->groupBy('group');
        return view('pengaturan.index', compact('pengaturans'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token', '_method') as $key => $value) {
            Pengaturan::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->route('pengaturan.index')->with('success', 'Pengaturan berhasil diperbarui');
    }
}
