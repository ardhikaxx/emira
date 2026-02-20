@extends('layouts.master')
@section('title', 'Edit Ruangan - EMIRA')
@section('page_title', 'Edit Ruangan')
@section('content')
<div class="row g-4">
    <div class="col-12 col-md-6">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-title">
                    <div class="header-icon-sm gradient-orange">
                        <i class="fas fa-bed"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Edit Ruangan</h5>
                        <small class="text-muted">Perbarui data ruangan</small>
                    </div>
                </div>
            </div>
            <div class="card-body-custom">
                <form method="POST" action="{{ route('ruangan.update', $ruangan->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Ruangan <span class="text-danger">*</span></label>
                        <input type="text" name="kode_ruangan" class="form-control" value="{{ $ruangan->kode_ruangan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Ruangan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_ruangan" class="form-control" value="{{ $ruangan->nama_ruangan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis <span class="text-danger">*</span></label>
                        <select name="jenis" class="form-select" required>
                            <option value="rawat_inap" {{ $ruangan->jenis == 'rawat_inap' ? 'selected' : '' }}>Rawat Inap</option>
                            <option value="icu" {{ $ruangan->jenis == 'icu' ? 'selected' : '' }}>ICU</option>
                            <option value="ugd" {{ $ruangan->jenis == 'ugd' ? 'selected' : '' }}>UGD</option>
                            <option value="isolasi" {{ $ruangan->jenis == 'isolasi' ? 'selected' : '' }}>Isolasi</option>
                            <option value="vip" {{ $ruangan->jenis == 'vip' ? 'selected' : '' }}>VIP</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kapasitas</label>
                            <input type="number" name="kapasitas" class="form-control" value="{{ $ruangan->kapasitas }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Lantai</label>
                            <input type="text" name="lantai" class="form-control" value="{{ $ruangan->lantai }}" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $ruangan->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">Status Aktif</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('ruangan.index') }}" class="btn-action btn-action-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn-custom btn-custom-primary">
                            <i class="fas fa-save"></i> Update Ruangan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
