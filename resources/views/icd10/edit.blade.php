@extends('layouts.master')
@section('title', 'Edit ICD-10 - EMIRA')
@section('page_title', 'Edit Kode ICD-10')
@section('content')
<div class="row g-4">
    <div class="col-12 col-md-6">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-title">
                    <div class="header-icon-sm gradient-orange">
                        <i class="fas fa-code"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Edit Kode ICD-10</h5>
                        <small class="text-muted">Perbarui kode diagnosa</small>
                    </div>
                </div>
            </div>
            <div class="card-body-custom">
                <form method="POST" action="{{ route('icd10.update', $icd10->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode <span class="text-danger">*</span></label>
                        <input type="text" name="kode" class="form-control" value="{{ $icd10->kode }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Penyakit (Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" name="nama_penyakit_indonesia" class="form-control" value="{{ $icd10->nama_penyakit_indonesia }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Penyakit (Inggris)</label>
                        <input type="text" name="nama_penyakit_inggris" class="form-control" value="{{ $icd10->nama_penyakit_inggris }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="kategori" class="form-control" value="{{ $icd10->kategori }}" required>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $icd10->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">Status Aktif</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('icd10.index') }}" class="btn-action btn-action-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn-custom btn-custom-primary">
                            <i class="fas fa-save"></i> Update Kode
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
