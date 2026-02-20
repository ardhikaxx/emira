@extends('layouts.master')
@section('title', 'Tambah Pasien - EMIRA')
@section('page_title', 'Tambah Pasien')
@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-title">
                    <div class="header-icon-sm gradient-teal">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Pasien Baru</h5>
                        <small class="text-muted">Pendaftaran pasien baru</small>
                    </div>
                </div>
            </div>
            <div class="card-body-custom">
                <form method="POST" action="{{ route('pasien.store') }}">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3 h-100">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="avatar-sm avatar-gradient-teal">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                    <h6 class="mb-0 fw-semibold">Data Identitas</h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                                    <input type="text" name="nik" class="form-control" required placeholder="Masukkan NIK">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lengkap" class="form-control" required placeholder="Masukkan nama lengkap">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Panggilan</label>
                                    <input type="text" name="nama_panggilan" class="form-control" placeholder="Nama panggilan">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_lahir" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">No. KK</label>
                                    <input type="text" name="no_kk" class="form-control" placeholder="Nomor Kartu Keluarga">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3 h-100">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="avatar-sm avatar-gradient-blue">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <h6 class="mb-0 fw-semibold">Data Alamat & Kontak</h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Agama</label>
                                    <select name="agama" class="form-select">
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Status Perkawinan</label>
                                    <select name="status_perkawinan" class="form-select">
                                        <option value="">Pilih Status</option>
                                        <option value="Belum Kawin">Belum Kawin</option>
                                        <option value="Kawin">Kawin</option>
                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                        <option value="Cerai Mati">Cerai Mati</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">No. HP</label>
                                    <input type="text" name="no_hp" class="form-control" placeholder="Nomor HP">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="email@example.com">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mt-2">
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3 h-100">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="avatar-sm avatar-gradient-green">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <h6 class="mb-0 fw-semibold">Data Pembayaran</h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Jenis Pembayaran</label>
                                    <select name="jenis_pembayaran" class="form-select">
                                        <option value="umum">Umum</option>
                                        <option value="bpjs">BPJS Kesehatan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">No. BPJS</label>
                                    <input type="text" name="no_bpjs" class="form-control" placeholder="Nomor BPJS">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3 h-100">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="avatar-sm avatar-gradient-orange">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <h6 class="mb-0 fw-semibold">Catatan Medis</h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Catatan Alergi</label>
                                    <textarea name="catatan_alergi" class="form-control" rows="3" placeholder="Contoh: Alergi obat penicillin, seafood"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('pasien.index') }}" class="btn-action btn-action-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn-custom btn-custom-primary">
                            <i class="fas fa-save"></i> Simpan Pasien
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
