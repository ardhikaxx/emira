@extends('layouts.master')
@section('title', 'Tambah Jadwal - EMIRA')
@section('page_title', 'Tambah Jadwal Dokter')
@section('content')
<div class="row g-4">
    <div class="col-12 col-md-6">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-title">
                    <div class="header-icon-sm gradient-teal">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Jadwal Baru</h5>
                        <small class="text-muted">Tambah jadwal praktik dokter</small>
                    </div>
                </div>
            </div>
            <div class="card-body-custom">
                <form method="POST" action="{{ route('jadwal.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Dokter <span class="text-danger">*</span></label>
                        <select name="dokter_id" class="form-select select2" required>
                            <option value="">Pilih Dokter</option>
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Poli <span class="text-danger">*</span></label>
                        <select name="poli_id" class="form-select" required>
                            <option value="">Pilih Poli</option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Hari <span class="text-danger">*</span></label>
                        <select name="hari" class="form-select" required>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                            <option value="minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jam Mulai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_mulai" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jam Selesai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_selesai" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kuota Pasien</label>
                        <input type="number" name="kuota_pasien" class="form-control" value="20" required>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                            <label class="form-check-label fw-semibold" for="is_active">Status Aktif</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('jadwal.index') }}" class="btn-action btn-action-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn-custom btn-custom-primary">
                            <i class="fas fa-save"></i> Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
