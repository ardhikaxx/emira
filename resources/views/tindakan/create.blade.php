@extends('layouts.master')
@section('title', 'Tambah Tindakan - EMIRA')
@section('page_title', 'Tambah Tindakan')
@section('content')
<div class="row g-4">
    <div class="col-12 col-md-6">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-title">
                    <div class="header-icon-sm gradient-purple">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Tindakan Baru</h5>
                        <small class="text-muted">Tambah tindakan medis</small>
                    </div>
                </div>
            </div>
            <div class="card-body-custom">
                <form method="POST" action="{{ route('tindakan.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Tindakan <span class="text-danger">*</span></label>
                        <input type="text" name="kode_tindakan" class="form-control" required placeholder="Contoh: T-001">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Tindakan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_tindakan" class="form-control" required placeholder="Contoh: Pemeriksaan Tekanan Darah">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Pemeriksaan Umum">Pemeriksaan Umum</option>
                            <option value="Tindakan Minor">Tindakan Minor</option>
                            <option value="Tindakan Gigi">Tindakan Gigi</option>
                            <option value="Tindakan Kebidanan">Tindakan Kebidanan</option>
                            <option value="Keperawatan">Keperawatan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan tambahan..."></textarea>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                            <label class="form-check-label fw-semibold" for="is_active">Status Aktif</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('tindakan.index') }}" class="btn-action btn-action-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn-custom btn-custom-primary">
                            <i class="fas fa-save"></i> Simpan Tindakan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
