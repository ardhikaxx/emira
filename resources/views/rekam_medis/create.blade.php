@extends('layouts.master')
@section('title', 'Buat Rekam Medis - EMIRA')
@section('page_title', 'Buat Rekam Medis')
@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-title">
                    <div class="header-icon-sm gradient-green">
                        <i class="fas fa-file-medical-alt"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Rekam Medis Baru</h5>
                        <small class="text-muted">No. Kunjungan: {{ $kunjungan->no_kunjungan }}</small>
                    </div>
                </div>
            </div>
            <div class="card-body-custom">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="avatar-sm avatar-gradient-teal">
                                    <i class="fas fa-user"></i>
                                </div>
                                <h6 class="mb-0 fw-semibold">Data Pasien</h6>
                            </div>
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td class="text-muted-small py-1" width="40%">No. RM</td>
                                    <td class="py-1"><strong>{{ $kunjungan->pasien->no_rm ?? '-' }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Nama Pasien</td>
                                    <td class="py-1"><strong>{{ $kunjungan->pasien->nama_lengkap ?? '-' }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Tanggal Lahir</td>
                                    <td class="py-1">{{ $kunjungan->pasien->tanggal_lahir ? \Carbon\Carbon::parse($kunjungan->pasien->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Jenis Kelamin</td>
                                    <td class="py-1">{{ $kunjungan->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Alergi</td>
                                    <td class="py-1">
                                        @if($kunjungan->pasien->catatan_alergi)
                                            <span class="badge-custom badge-red">{{ $kunjungan->pasien->catatan_alergi }}</span>
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="avatar-sm avatar-gradient-blue">
                                    <i class="fas fa-hospital-user"></i>
                                </div>
                                <h6 class="mb-0 fw-semibold">Data Kunjungan</h6>
                            </div>
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td class="text-muted-small py-1" width="40%">No. Kunjungan</td>
                                    <td class="py-1"><strong>{{ $kunjungan->no_kunjungan }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Tanggal</td>
                                    <td class="py-1">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Dokter</td>
                                    <td class="py-1">{{ $kunjungan->dokter->nama_lengkap ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Poli</td>
                                    <td class="py-1">{{ $kunjungan->poli->nama_poli ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Pembayaran</td>
                                    <td class="py-1">
                                        <span class="badge-custom {{ $kunjungan->jenis_pembayaran == 'bpjs' ? 'badge-blue' : 'badge-green' }}">
                                            {{ strtoupper($kunjungan->jenis_pembayaran) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                @if($kunjungan->vitalSigns->count() > 0)
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="header-icon-sm gradient-red">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">Vital Sign</h6>
                    </div>
                    <div class="row g-3">
                        @foreach($kunjungan->vitalSigns as $vs)
                        <div class="col-md-2 col-6">
                            <div class="p-3 bg-light rounded-3 text-center">
                                <div class="text-muted-small mb-1">{{ $vs->jenis_vital_sign }}</div>
                                <div class="fw-bold text-primary">{{ $vs->nilai }}</div>
                                <div class="text-muted-small">{{ $vs->satuan }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <hr class="my-4">

                <form method="POST" action="{{ route('rekam_medis.store', $kunjungan->id) }}">
                    @csrf
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="header-icon-sm gradient-teal">
                                <i class="fas fa-stethoscope"></i>
                            </div>
                            <h6 class="mb-0 fw-semibold">Anamnesis & Pemeriksaan</h6>
                        </div>
                        <div class="p-4 bg-light rounded-3">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Keluhan Utama / Anamnesis <span class="text-danger">*</span></label>
                                    <textarea name="anamnesis" class="form-control" rows="3" placeholder="Tuliskan keluhan utama pasien..." required></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Riwayat Penyakit Dahulu</label>
                                    <input type="text" name="riwayat_penyakit_dahulu" class="form-control" placeholder="Contoh: Diabetes, Hipertensi">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Riwayat Penyakit Keluarga</label>
                                    <input type="text" name="riwayat_penyakit_keluarga" class="form-control" placeholder="Contoh: Jantung, Kanker">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Riwayat Alergi</label>
                                    <input type="text" name="riwayat_alergi" class="form-control" placeholder="Contoh: Penicillin, Seafood" value="{{ $kunjungan->pasien->catatan_alergi ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Riwayat Obat Rutin</label>
                                    <input type="text" name="riwayat_obat_rutin" class="form-control" placeholder="Contoh: Metformin 2x1">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Catatan Dokter</label>
                                    <input type="text" name="catatan_dokter" class="form-control" placeholder="Catatan tambahan">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="header-icon-sm gradient-orange">
                                <i class="fas fa-sticky-note"></i>
                            </div>
                            <h6 class="mb-0 fw-semibold">Diagnosa</h6>
                        </div>
                        <div class="p-4 bg-light rounded-3">
                            <div id="diagnosa-container">
                                <div class="row g-3 mb-2 diagnosa-row">
                                    <div class="col-md-5">
                                        <label class="form-label">ICD-10</label>
                                        <select name="icd10_id[]" class="form-select select2">
                                            <option value="">Pilih ICD-10...</option>
                                            @foreach($icd10s as $icd10)
                                                <option value="{{ $icd10->id }}">{{ $icd10->kode }} - {{ $icd10->nama_penyakit_indonesia }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Jenis</label>
                                        <select name="jenis_diagnosa[]" class="form-select">
                                            <option value="utama">Utama</option>
                                            <option value="sekunder">Sekunder</option>
                                            <option value="komplikasi">Komplikasi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn-action btn-action-danger w-100" onclick="this.closest('.diagnosa-row').remove()">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addDiagnosa()">
                                <i class="fas fa-plus"></i> Tambah Diagnosa
                            </button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="header-icon-sm gradient-blue">
                                <i class="fas fa-syringe"></i>
                            </div>
                            <h6 class="mb-0 fw-semibold">Tindakan Medis</h6>
                        </div>
                        <div class="p-4 bg-light rounded-3">
                            <div id="tindakan-container">
                                <div class="row g-3 mb-2 tindakan-row">
                                    <div class="col-md-4">
                                        <label class="form-label">Tindakan</label>
                                        <select name="tindakan_id[]" class="form-select select2">
                                            <option value="">Pilih Tindakan...</option>
                                            @foreach($tindakans as $tindakan)
                                                <option value="{{ $tindakan->id }}">{{ $tindakan->kode_tindakan }} - {{ $tindakan->nama_tindakan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" name="jumlah_tindakan[]" class="form-control" value="1" min="1">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Keterangan</label>
                                        <input type="text" name="keterangan_tindakan[]" class="form-control" placeholder="Keterangan">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn-action btn-action-danger w-100" onclick="this.closest('.tindakan-row').remove()">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addTindakan()">
                                <i class="fas fa-plus"></i> Tambah Tindakan
                            </button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-sm avatar-gradient-green" style="width:40px;height:40px;">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h6 class="mb-0 fw-semibold">Rencana Tindak Lanjut</h6>
                        </div>
                        <div class="p-4 bg-light rounded-3">
                            <textarea name="rencana_tindak_lanjut" class="form-control" rows="2" placeholder="Contoh: Kontrol 1 minggu lagi, Rujuk ke spesialis..."></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('antrian.index') }}" class="btn-action btn-action-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn-custom btn-custom-primary">
                            <i class="fas fa-save"></i> Simpan Rekam Medis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function addDiagnosa() {
    const container = document.getElementById('diagnosa-container');
    const row = document.createElement('div');
    row.className = 'row g-3 mb-2 diagnosa-row';
    row.innerHTML = `
        <div class="col-md-5">
            <label class="form-label">ICD-10</label>
            <select name="icd10_id[]" class="form-select select2">
                <option value="">Pilih ICD-10...</option>
                @foreach($icd10s as $icd10)
                    <option value="{{ $icd10->id }}">{{ $icd10->kode }} - {{ $icd10->nama_penyakit_indonesia }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Jenis</label>
            <select name="jenis_diagnosa[]" class="form-select">
                <option value="utama">Utama</option>
                <option value="sekunder">Sekunder</option>
                <option value="komplikasi">Komplikasi</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn-action btn-action-danger w-100" onclick="this.closest('.diagnosa-row').remove()">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </div>
    `;
    container.appendChild(row);
    $(row).find('.select2').select2({ theme: 'bootstrap-5' });
}

function addTindakan() {
    const container = document.getElementById('tindakan-container');
    const row = document.createElement('div');
    row.className = 'row g-3 mb-2 tindakan-row';
    row.innerHTML = `
        <div class="col-md-4">
            <label class="form-label">Tindakan</label>
            <select name="tindakan_id[]" class="form-select select2">
                <option value="">Pilih Tindakan...</option>
                @foreach($tindakans as $tindakan)
                    <option value="{{ $tindakan->id }}">{{ $tindakan->kode_tindakan }} - {{ $tindakan->nama_tindakan }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah_tindakan[]" class="form-control" value="1" min="1">
        </div>
        <div class="col-md-4">
            <label class="form-label">Keterangan</label>
            <input type="text" name="keterangan_tindakan[]" class="form-control" placeholder="Keterangan">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn-action btn-action-danger w-100" onclick="this.closest('.tindakan-row').remove()">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </div>
    `;
    container.appendChild(row);
    $(row).find('.select2').select2({ theme: 'bootstrap-5' });
}
</script>
@endsection
