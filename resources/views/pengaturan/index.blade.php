@extends('layouts.master')
@section('title', 'Pengaturan Sistem - EMIRA')
@section('page_title', 'Pengaturan Sistem')
@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-purple">
                <i class="fas fa-cogs"></i>
            </div>
            <div>
                <h5 class="card-title">Pengaturan EMIRA</h5>
                <small class="text-muted">Konfigurasi sistem</small>
            </div>
        </div>
        <button type="submit" form="pengaturanForm" class="btn-custom btn-custom-primary">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
    </div>
    <div class="card-body-custom">
        <form id="pengaturanForm" method="POST" action="{{ route('pengaturan.update') }}">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="settings-section">
                        <h6 class="settings-title"><i class="fas fa-hospital me-2"></i>Informasi Fasilitas</h6>
                        <div class="mb-3">
                            <label class="form-label">Nama Aplikasi</label>
                            <input type="text" name="app_name" class="form-control" value="{{ $pengaturans['umum']->firstWhere('key', 'app_name')->value ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Faskes</label>
                            <input type="text" name="nama_faskes" class="form-control" value="{{ $pengaturans['umum']->firstWhere('key', 'nama_faskes')->value ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="alamat_faskes" class="form-control" value="{{ $pengaturans['umum']->firstWhere('key', 'alamat_faskes')->value ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="no_telp_faskes" class="form-control" value="{{ $pengaturans['umum']->firstWhere('key', 'no_telp_faskes')->value ?? '' }}">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="settings-section">
                        <h6 class="settings-title"><i class="fas fa-clock me-2"></i>Jam Operasional</h6>
                        <div class="mb-3">
                            <label class="form-label">Jam Buka</label>
                            <input type="text" name="jam_buka" class="form-control" value="{{ $pengaturans['umum']->firstWhere('key', 'jam_buka')->value ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Tutup</label>
                            <input type="text" name="jam_tutup" class="form-control" value="{{ $pengaturans['umum']->firstWhere('key', 'jam_tutup')->value ?? '' }}">
                        </div>
                    </div>
                    
                    <div class="settings-section mt-4">
                        <h6 class="settings-title"><i class="fas fa-palette me-2"></i>Tampilan</h6>
                        <div class="mb-3">
                            <label class="form-label">Warna Primer</label>
                            <input type="text" name="warna_primer" class="form-control" value="{{ $pengaturans['tampilan']->firstWhere('key', 'warna_primer')->value ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
.settings-section {
    background: #fafbfc;
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid #f1f5f9;
}
.settings-title {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #e2e8f0;
}
</style>
@endsection
