@extends('layouts.master')
@section('title', 'Detail Pasien - EMIRA')
@section('page_title', 'Detail Pasien')
@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card-custom">
            <div class="card-body-custom text-center">
                <div class="profile-avatar mx-auto mb-3">
                    {{ substr($pasien->nama_lengkap, 0, 2) }}
                </div>
                <h5 class="mb-1">{{ $pasien->nama_lengkap }}</h5>
                <p class="text-muted mb-3">{{ $pasien->no_rm }}</p>
                <span class="badge-custom {{ $pasien->jenis_pembayaran == 'bpjs' ? 'badge-blue' : 'badge-green' }}">
                    <i class="fas {{ $pasien->jenis_pembayaran == 'bpjs' ? 'fa-id-card' : 'fa-wallet' }} me-1"></i>
                    {{ strtoupper($pasien->jenis_pembayaran) }}
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card-custom mb-4">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Data Diri</h5>
                <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn-custom btn-custom-primary btn-custom-sm">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </div>
            <div class="card-body-custom">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>NIK</label>
                            <span>{{ $pasien->nik ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>No. KK</label>
                            <span>{{ $pasien->no_kk ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Tanggal Lahir</label>
                            <span>{{ $pasien->tanggal_lahir ? \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y') : '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Jenis Kelamin</label>
                            <span>{{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Agama</label>
                            <span>{{ $pasien->agama ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Status Perkawinan</label>
                            <span>{{ $pasien->status_perkawinan ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-item">
                            <label>Alamat</label>
                            <span>{{ $pasien->alamat ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-custom">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-phone me-2"></i>Informasi Kontak</h5>
            </div>
            <div class="card-body-custom">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>No. HP</label>
                            <span>{{ $pasien->no_hp ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Email</label>
                            <span>{{ $pasien->email ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Nama Wali</label>
                            <span>{{ $pasien->nama_wali ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>No. Wali</label>
                            <span>{{ $pasien->no_wali ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-avatar {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #08C195, #0ed6a8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 700;
    color: white;
}
.info-item {
    background: #fafbfc;
    border-radius: 10px;
    padding: 1rem;
}
.info-item label {
    display: block;
    font-size: 0.75rem;
    color: #94a3b8;
    margin-bottom: 0.25rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.info-item span {
    font-weight: 500;
    color: #1e293b;
}
</style>
@endsection
