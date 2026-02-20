@extends('layouts.master')
@section('title', 'Tambah Ruangan - EMIRA')
@section('page_title', 'Tambah Ruangan')
@section('content')
<div class="row g-4">
    <div class="col-12 col-md-6">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-title">
                    <div class="header-icon-sm gradient-blue">
                        <i class="fas fa-bed"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Ruangan Baru</h5>
                        <small class="text-muted">Tambah ruangan rumah sakit</small>
                    </div>
                </div>
            </div>
            <div class="card-body-custom">
                <form method="POST" action="{{ route('ruangan.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Ruangan <span class="text-danger">*</span></label>
                        <input type="text" name="kode_ruangan" class="form-control" required placeholder="Contoh: RI-001">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Ruangan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_ruangan" class="form-control" required placeholder="Contoh: Ruang Melati">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis <span class="text-danger">*</span></label>
                        <select name="jenis" class="form-select" required>
                            <option value="">Pilih Jenis</option>
                            <option value="rawat_inap">Rawat Inap</option>
                            <option value="icu">ICU</option>
                            <option value="ugd">UGD</option>
                            <option value="isolasi">Isolasi</option>
                            <option value="vip">VIP</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kapasitas</label>
                            <input type="number" name="kapasitas" class="form-control" required placeholder="Jumlah TT">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Lantai</label>
                            <input type="text" name="lantai" class="form-control" required placeholder="Contoh: Lantai 2">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                            <label class="form-check-label fw-semibold" for="is_active">Status Aktif</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('ruangan.index') }}" class="btn-action btn-action-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn-custom btn-custom-primary">
                            <i class="fas fa-save"></i> Simpan Ruangan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
