@extends('layouts.master')
@section('title', 'Data Poli - EMIRA')
@section('page_title', 'Kelola Poli')
@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-purple">
                <i class="fas fa-hospital"></i>
            </div>
            <div>
                <h5 class="card-title">Data Poli</h5>
                <small class="text-muted">Kelola data poli/klinik</small>
            </div>
        </div>
    </div>
    <div class="card-body-custom">
        @if($polis->count() > 0)
        <div class="row g-3">
            @foreach($polis as $poli)
            <div class="col-md-6 col-lg-4">
                <div class="poli-card">
                    <div class="poli-icon gradient-{{ $loop->index % 4 == 0 ? 'teal' : ($loop->index % 4 == 1 ? 'purple' : ($loop->index % 4 == 2 ? 'orange' : 'green')) }}">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div class="poli-info">
                        <h6>{{ $poli->nama_poli }}</h6>
                        <small class="text-muted">{{ $poli->kode_poli }}</small>
                    </div>
                    <div class="poli-status">
                        @if($poli->is_active)
                            <span class="badge-custom badge-active"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                        @else
                            <span class="badge-custom badge-inactive"><i class="fas fa-times-circle me-1"></i>Nonaktif</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan <strong>{{ $polis->firstItem() }}</strong> - <strong>{{ $polis->lastItem() }}</strong> dari <strong>{{ $polis->total() }}</strong> data
            </div>
            <div class="pagination-container">
                {{ $polis->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-hospital"></i></div>
            <h6>Tidak Ada Poli</h6>
            <p>Belum ada data poli.</p>
        </div>
        @endif
    </div>
</div>

<style>
.poli-card {
    background: #fafbfc;
    border-radius: 12px;
    padding: 1.25rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.2s;
    border: 1px solid #f1f5f9;
}
.poli-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.poli-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}
.poli-info {
    flex: 1;
}
.poli-info h6 {
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 0.25rem;
    font-size: 0.95rem;
}
.poli-info small {
    color: #94a3b8;
}
</style>
@endsection
