@extends('layouts.master')
@section('title', 'Rekam Medis - EMIRA')
@section('page_title', 'Rekam Medis')
@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-green">
                <i class="fas fa-file-medical-alt"></i>
            </div>
            <div>
                <h5 class="card-title">Data Rekam Medis</h5>
                <small class="text-muted">Riwayat pemeriksaan pasien</small>
            </div>
        </div>
    </div>
    <div class="card-body-custom">
        @if($rekamMedis->count() > 0)
        <div class="table-responsive-custom">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No. RM</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Tgl Periksa</th>
                        <th>Diagnosa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekamMedis as $rm)
                    <tr>
                        <td><span class="badge-custom badge-primary">{{ $rm->no_rm_kunjungan }}</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-sm avatar-gradient-teal">{{ substr($rm->pasien->nama_lengkap ?? 'P', 0, 1) }}</div>
                                <div>
                                    <div class="fw-semibold">{{ $rm->pasien->nama_lengkap ?? '-' }}</div>
                                    <small class="text-muted">{{ $rm->pasien->no_rm ?? '-' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $rm->dokter->nama_lengkap ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($rm->tanggal_periksa)->format('d/m/Y') }}</td>
                        <td>
                            @if($rm->diagnosas->count() > 0)
                                <span class="badge-custom badge-orange">{{ $rm->diagnosas->first()->icd10->kode ?? '-' }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge-custom badge-green"><i class="fas fa-check-circle me-1"></i>Selesai</span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('rekam_medis.show', $rm->id) }}" class="btn-action btn-action-info" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan <strong>{{ $rekamMedis->firstItem() }}</strong> - <strong>{{ $rekamMedis->lastItem() }}</strong> dari <strong>{{ $rekamMedis->total() }}</strong> data
            </div>
            <div class="pagination-container">
                {{ $rekamMedis->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-file-medical-alt"></i></div>
            <h6>Tidak Ada Rekam Medis</h6>
            <p>Belum ada data rekam medis.</p>
        </div>
        @endif
    </div>
</div>
@endsection
