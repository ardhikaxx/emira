@extends('layouts.master')
@section('title', 'Data Pasien - EMIRA')
@section('page_title', 'Data Pasien')
@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-teal">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <h5 class="card-title">Daftar Pasien</h5>
                <small class="text-muted">Total {{ $pasiens->total() }} pasien</small>
            </div>
        </div>
        <a href="{{ route('pasien.create') }}" class="btn-custom btn-custom-primary">
            <i class="fas fa-plus"></i> Tambah Pasien
        </a>
    </div>
    
    <div class="card-body-custom">
        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama, No. RM, NIK..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn-custom btn-custom-primary w-100">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
            </div>
        </form>
        
        @if($pasiens->count() > 0)
        <div class="table-responsive-custom">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No. RM</th>
                        <th>Nama Lengkap</th>
                        <th>JK</th>
                        <th>Tgl Lahir</th>
                        <th>No. HP</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pasiens as $pasien)
                    <tr>
                        <td>
                            <span class="badge-custom badge-primary">{{ $pasien->no_rm }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-sm avatar-gradient-teal">
                                    {{ substr($pasien->nama_lengkap, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $pasien->nama_lengkap }}</div>
                                    <small class="text-muted">{{ $pasien->nik }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge-custom {{ $pasien->jenis_kelamin == 'L' ? 'badge-blue' : 'badge-purple' }}">
                                {{ $pasien->jenis_kelamin == 'L' ? 'L' : 'P' }}
                            </span>
                        </td>
                        <td>{{ $pasien->tanggal_lahir ? \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                        <td>{{ $pasien->no_hp }}</td>
                        <td>
                            <span class="badge-custom {{ $pasien->jenis_pembayaran == 'bpjs' ? 'badge-blue' : 'badge-green' }}">
                                <i class="fas {{ $pasien->jenis_pembayaran == 'bpjs' ? 'fa-id-card' : 'fa-wallet' }} me-1"></i>
                                {{ strtoupper($pasien->jenis_pembayaran) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('pasien.show', $pasien->id) }}" class="btn-action btn-action-info" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn-action btn-action-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
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
                Menampilkan <strong>{{ $pasiens->firstItem() }}</strong> - <strong>{{ $pasiens->lastItem() }}</strong> dari <strong>{{ $pasiens->total() }}</strong> data
            </div>
            <div class="pagination-container">
                {{ $pasiens->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-users"></i></div>
            <h6>Tidak Ada Pasien</h6>
            <p>Belum ada data pasien. Silakan tambah pasien baru.</p>
            <a href="{{ route('pasien.create') }}" class="btn-custom btn-custom-primary mt-2">
                <i class="fas fa-plus me-1"></i> Tambah Pasien
            </a>
        </div>
        @endif
    </div>
</div>

<style>
.search-box { position: relative; }
.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
}
.search-box .form-control {
    padding-left: 2.5rem;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
}
.search-box .form-control:focus {
    border-color: #08C195;
    box-shadow: 0 0 0 3px rgba(8, 193, 149, 0.1);
}
</style>
@endsection
