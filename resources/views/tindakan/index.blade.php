@extends('layouts.master')
@section('title', 'Master Tindakan - EMIRA')
@section('page_title', 'Master Tindakan')
@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-purple">
                <i class="fas fa-syringe"></i>
            </div>
            <div>
                <h5 class="card-title">Master Tindakan</h5>
                <small class="text-muted">Daftar tindakan medis</small>
            </div>
        </div>
        <a href="{{ route('tindakan.create') }}" class="btn-custom btn-custom-primary">
            <i class="fas fa-plus"></i> Tambah Tindakan
        </a>
    </div>
    <div class="card-body-custom">
        @if($tindakans->count() > 0)
        <div class="table-responsive-custom">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Tindakan</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tindakans as $tindakan)
                    <tr>
                        <td><code>{{ $tindakan->kode_tindakan }}</code></td>
                        <td class="fw-semibold">{{ $tindakan->nama_tindakan }}</td>
                        <td><span class="badge-custom badge-purple">{{ $tindakan->kategori }}</span></td>
                        <td>{{ $tindakan->keterangan ?? '-' }}</td>
                        <td>
                            @if($tindakan->is_active)
                                <span class="badge-custom badge-active"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                            @else
                                <span class="badge-custom badge-inactive"><i class="fas fa-times-circle me-1"></i>Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('tindakan.edit', $tindakan->id) }}" class="btn-action btn-action-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tindakan.destroy', $tindakan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
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
                Menampilkan <strong>{{ $tindakans->firstItem() }}</strong> - <strong>{{ $tindakans->lastItem() }}</strong> dari <strong>{{ $tindakans->total() }}</strong> data
            </div>
            <div class="pagination-container">
                {{ $tindakans->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-syringe"></i></div>
            <h6>Tidak Ada Tindakan</h6>
            <p>Belum ada data tindakan.</p>
            <a href="{{ route('tindakan.create') }}" class="btn-custom btn-custom-primary mt-2">
                <i class="fas fa-plus me-1"></i> Tambah Tindakan
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
