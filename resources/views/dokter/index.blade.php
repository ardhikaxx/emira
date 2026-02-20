@extends('layouts.master')
@section('title', 'Data Dokter - EMIRA')
@section('page_title', 'Kelola Dokter')
@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-teal">
                <i class="fas fa-user-md"></i>
            </div>
            <div>
                <h5 class="card-title">Data Dokter</h5>
                <small class="text-muted">Total {{ $dokters->total() }} dokter</small>
            </div>
        </div>
        <a href="{{ route('dokter.create') }}" class="btn-custom btn-custom-primary">
            <i class="fas fa-plus"></i> Tambah Dokter
        </a>
    </div>
    <div class="card-body-custom">
        @if($dokters->count() > 0)
        <div class="table-responsive-custom">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Spesialisasi</th>
                        <th>Poli</th>
                        <th>NIP</th>
                        <th>No. SIP</th>
                        <th>No. HP</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dokters as $dokter)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-sm avatar-gradient-teal">{{ substr($dokter->nama_lengkap, 0, 1) }}</div>
                                <div>
                                    <div class="fw-semibold">{{ $dokter->gelar_depan }} {{ $dokter->nama_lengkap }}{{ $dokter->gelar_belakang ? ', ' . $dokter->gelar_belakang : '' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $dokter->spesialisasi }}</td>
                        <td><span class="badge-custom badge-purple">{{ $dokter->poli->nama_poli ?? '-' }}</span></td>
                        <td><code>{{ $dokter->nip }}</code></td>
                        <td>{{ $dokter->no_sip }}</td>
                        <td>{{ $dokter->no_hp }}</td>
                        <td>
                            @if($dokter->is_active)
                                <span class="badge-custom badge-active"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                            @else
                                <span class="badge-custom badge-inactive"><i class="fas fa-times-circle me-1"></i>Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn-action btn-action-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus dokter ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-action-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan <strong>{{ $dokters->firstItem() }}</strong> - <strong>{{ $dokters->lastItem() }}</strong> dari <strong>{{ $dokters->total() }}</strong> data
            </div>
            <div class="pagination-container">
                {{ $dokters->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-user-md"></i></div>
            <h6>Tidak Ada Dokter</h6>
            <p>Belum ada data dokter.</p>
            <a href="{{ route('dokter.create') }}" class="btn-custom btn-custom-primary mt-2">
                <i class="fas fa-plus me-1"></i> Tambah Dokter
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
