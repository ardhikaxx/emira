@extends('layouts.master')
@section('title', 'Edit Tindakan - EMIRA')
@section('page_title', 'Edit Tindakan')
@section('content')
<div class="row g-4">
    <div class="col-12 col-md-6">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-title">
                    <div class="header-icon-sm gradient-orange">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Edit Tindakan</h5>
                        <small class="text-muted">Perbarui tindakan medis</small>
                    </div>
                </div>
            </div>
            <div class="card-body-custom">
                <form method="POST" action="{{ route('tindakan.update', $tindakan->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Tindakan <span class="text-danger">*</span></label>
                        <input type="text" name="kode_tindakan" class="form-control" value="{{ $tindakan->kode_tindakan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Tindakan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_tindakan" class="form-control" value="{{ $tindakan->nama_tindakan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select" required>
                            <option value="Pemeriksaan Umum" {{ $tindakan->kategori == 'Pemeriksaan Umum' ? 'selected' : '' }}>Pemeriksaan Umum</option>
                            <option value="Tindakan Minor" {{ $tindakan->kategori == 'Tindakan Minor' ? 'selected' : '' }}>Tindakan Minor</option>
                            <option value="Tindakan Gigi" {{ $tindakan->kategori == 'Tindakan Gigi' ? 'selected' : '' }}>Tindakan Gigi</option>
                            <option value="Tindakan Kebidanan" {{ $tindakan->kategori == 'Tindakan Kebidanan' ? 'selected' : '' }}>Tindakan Kebidanan</option>
                            <option value="Keperawatan" {{ $tindakan->kategori == 'Keperawatan' ? 'selected' : '' }}>Keperawatan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ $tindakan->keterangan }}</textarea>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $tindakan->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">Status Aktif</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('tindakan.index') }}" class="btn-action btn-action-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn-custom btn-custom-primary">
                            <i class="fas fa-save"></i> Update Tindakan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
