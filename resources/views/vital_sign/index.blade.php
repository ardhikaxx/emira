@extends('layouts.master')
@section('title', 'Vital Sign - EMIRA')
@section('page_title', 'Vital Sign')
@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-red">
                <i class="fas fa-heartbeat"></i>
            </div>
            <div>
                <h5 class="card-title">Data Vital Sign</h5>
                <small class="text-muted">Rekam vital sign pasien</small>
            </div>
        </div>
    </div>
    <div class="card-body-custom">
        @if($vitalSigns->count() > 0)
        <div class="table-responsive-custom">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Pasien</th>
                        <th>No. RM</th>
                        <th>TD (mmHg)</th>
                        <th>Nadi</th>
                        <th>RR</th>
                        <th>Suhu</th>
                        <th>SpO2</th>
                        <th>BB</th>
                        <th>TB</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vitalSigns as $vs)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-sm avatar-gradient-red">{{ substr($vs->pasien->nama_lengkap ?? 'P', 0, 1) }}</div>
                                <div class="fw-semibold">{{ $vs->pasien->nama_lengkap ?? '-' }}</div>
                            </div>
                        </td>
                        <td><span class="badge-custom badge-secondary">{{ $vs->pasien->no_rm ?? '-' }}</span></td>
                        <td><strong>{{ $vs->tekanan_darah_sistol }}/{{ $vs->tekanan_darah_diastol }}</strong></td>
                        <td>{{ $vs->nadi }} x/m</td>
                        <td>{{ $vs->pernapasan }} x/m</td>
                        <td>{{ $vs->suhu }}°C</td>
                        <td>{{ $vs->saturasi_oksigen ?? '-' }}%</td>
                        <td>{{ $vs->berat_badan ?? '-' }} kg</td>
                        <td>{{ $vs->tinggi_badan ?? '-' }} cm</td>
                        <td><small class="text-muted">{{ $vs->created_at->format('d/m H:i') }}</small></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan <strong>{{ $vitalSigns->firstItem() }}</strong> - <strong>{{ $vitalSigns->lastItem() }}</strong> dari <strong>{{ $vitalSigns->total() }}</strong> data
            </div>
            <div class="pagination-container">
                {{ $vitalSigns->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-heartbeat"></i></div>
            <h6>Tidak Ada Data Vital Sign</h6>
            <p>Belum ada data vital sign.</p>
        </div>
        @endif
    </div>
</div>

<style>
.avatar-gradient-red { background: linear-gradient(135deg, #ef4444, #f87171); }
</style>
@endsection
