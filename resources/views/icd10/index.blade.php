@extends('layouts.master')
@section('title', 'Kode ICD-10 - EMIRA')
@section('page_title', 'Kode ICD-10')
@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-orange">
                <i class="fas fa-code"></i>
            </div>
            <div>
                <h5 class="card-title">Kode ICD-10</h5>
                <small class="text-muted">Master kode diagnosa ICD-10</small>
            </div>
        </div>
        <a href="{{ route('icd10.create') }}" class="btn-custom btn-custom-primary">
            <i class="fas fa-plus"></i> Tambah Kode
        </a>
    </div>
    <div class="card-body-custom">
        @if($icd10s->count() > 0)
        <div class="table-responsive-custom">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Penyakit (ID)</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($icd10s as $icd)
                    <tr>
                        <td><span class="badge-custom badge-orange">{{ $icd->kode }}</span></td>
                        <td>{{ $icd->nama_penyakit_indonesia }}</td>
                        <td>{{ $icd->kategori }}</td>
                        <td>
                            @if($icd->is_active)
                                <span class="badge-custom badge-active"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                            @else
                                <span class="badge-custom badge-inactive"><i class="fas fa-times-circle me-1"></i>Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('icd10.edit', $icd->id) }}" class="btn-action btn-action-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('icd10.destroy', $icd->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
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
                Menampilkan <strong>{{ $icd10s->firstItem() }}</strong> - <strong>{{ $icd10s->lastItem() }}</strong> dari <strong>{{ $icd10s->total() }}</strong> data
            </div>
            <div class="pagination-container">
                {{ $icd10s->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-code"></i></div>
            <h6>Tidak Ada Kode ICD-10</h6>
            <p>Belum ada data kode ICD-10.</p>
            <a href="{{ route('icd10.create') }}" class="btn-custom btn-custom-primary mt-2">
                <i class="fas fa-plus me-1"></i> Tambah Kode
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
