@extends('layouts.master')
@section('title', 'Edit Dokter - EMIRA')
@section('page_title', 'Edit Dokter')
@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-title">
                    <div class="header-icon-sm gradient-orange">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Edit Dokter</h5>
                        <small class="text-muted">Perbarui data dokter</small>
                    </div>
                </div>
            </div>
            <div class="card-body-custom">
                <form method="POST" action="{{ route('dokter.update', $dokter->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3 h-100">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="avatar-sm avatar-gradient-teal">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <h6 class="mb-0 fw-semibold">Data Pribadi</h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">User <span class="text-danger">*</span></label>
                                    <select name="user_id" class="form-select select2" required>
                                        @foreach(\App\Models\User::whereDoesntHave('dokter')->orWhere('id', $dokter->user_id)->get() as $user)
                                            <option value="{{ $user->id }}" {{ $dokter->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Gelar Depan</label>
                                        <input type="text" name="gelar_depan" class="form-control" value="{{ $dokter->gelar_depan }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap" class="form-control" value="{{ $dokter->nama_lengkap }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Gelar Belakang</label>
                                        <input type="text" name="gelar_belakang" class="form-control" value="{{ $dokter->gelar_belakang }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Spesialisasi <span class="text-danger">*</span></label>
                                        <input type="text" name="spesialisasi" class="form-control" value="{{ $dokter->spesialisasi }}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">No. HP</label>
                                    <input type="text" name="no_hp" class="form-control" value="{{ $dokter->no_hp }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3 h-100">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="avatar-sm avatar-gradient-blue">
                                        <i class="fas fa-hospital"></i>
                                    </div>
                                    <h6 class="mb-0 fw-semibold">Data Profesi</h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Poli <span class="text-danger">*</span></label>
                                    <select name="poli_id" class="form-select" required>
                                        @foreach(\App\Models\Poli::where('is_active', 1)->get() as $poli)
                                            <option value="{{ $poli->id }}" {{ $dokter->poli_id == $poli->id ? 'selected' : '' }}>
                                                {{ $poli->nama_poli }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">NIP <span class="text-danger">*</span></label>
                                    <input type="text" name="nip" class="form-control" value="{{ $dokter->nip }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">No. SIP <span class="text-danger">*</span></label>
                                    <input type="text" name="no_sip" class="form-control" value="{{ $dokter->no_sip }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">No. STR <span class="text-danger">*</span></label>
                                    <input type="text" name="no_str" class="form-control" value="{{ $dokter->no_str }}" required>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $dokter->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="is_active">Status Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('dokter.index') }}" class="btn-action btn-action-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn-custom btn-custom-primary">
                            <i class="fas fa-save"></i> Update Dokter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
