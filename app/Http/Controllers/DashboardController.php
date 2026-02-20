<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\Kunjungan;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\RekamMedis;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $stats = [
            'pasien_hari_ini' => Pasien::whereDate('created_at', today())->count(),
            'antrian_hari_ini' => Antrian::whereDate('tanggal', today())->count(),
            'kunjungan_selesai' => Kunjungan::whereDate('tanggal_kunjungan', today())->where('status', 'selesai')->count(),
            'total_pasien' => Pasien::count(),
        ];

        $antrian_hari_ini = Antrian::with(['pasien', 'poli', 'dokter'])
            ->whereDate('tanggal', today())
            ->orderBy('no_urut')
            ->limit(10)
            ->get();

        $kunjugan_terbaru = Kunjungan::with(['pasien', 'dokter', 'poli'])
            ->whereDate('tanggal_kunjungan', today())
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        if ($user) {
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'view',
                'module' => 'dashboard',
                'deskripsi' => 'Mengakses dashboard',
                'created_at' => now(),
            ]);
        }

        return view('dashboard.index', compact('stats', 'antrian_hari_ini', 'kunjugan_terbaru'));
    }
}
