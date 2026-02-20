@extends('layouts.master')

@section('title', 'Detail Rekam Medis - EMIRA')

@section('page_title', 'Detail Rekam Medis')

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-title">
                    <div class="header-icon-sm gradient-purple">
                        <i class="fas fa-file-medical-alt"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Rekam Medis: {{ $rekam_medis->no_rm_kunjungan }}</h5>
                        <small class="text-muted">Detail informasi rekam medis pasien</small>
                    </div>
                </div>
                <div class="page-actions">
                    <a href="{{ route('rekam_medis.index') }}" class="btn-action btn-action-secondary" title="Kembali">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <button onclick="window.print()" class="btn-action btn-action-primary" title="Cetak">
                        <i class="fas fa-print"></i>
                    </button>
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
                                    <td class="py-1"><strong>{{ $rekam_medis->pasien->no_rm ?? '-' }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Nama Pasien</td>
                                    <td class="py-1"><strong>{{ $rekam_medis->pasien->nama_lengkap ?? '-' }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Tanggal Lahir</td>
                                    <td class="py-1">{{ $rekam_medis->pasien->tanggal_lahir ? \Carbon\Carbon::parse($rekam_medis->pasien->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Jenis Kelamin</td>
                                    <td class="py-1">{{ $rekam_medis->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
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
                                    <td class="py-1"><strong>{{ $rekam_medis->kunjungan->no_kvisitasi ?? '-' }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Tanggal Periksa</td>
                                    <td class="py-1">{{ \Carbon\Carbon::parse($rekam_medis->tanggal_periksa)->format('d-m-Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Dokter</td>
                                    <td class="py-1">{{ $rekam_medis->dokter->nama_lengkap ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted-small py-1">Poli</td>
                                    <td class="py-1">{{ $rekam_medis->kunjungan->poli->nama_poli ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="header-icon-sm gradient-teal">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">Anamnesis</h6>
                    </div>
                    <div class="p-3 bg-light rounded-3">
                        <p class="mb-0">{{ $rekam_medis->anamnesis ?? '-' }}</p>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="avatar-sm avatar-gradient-orange" style="width:28px;height:28px;font-size:0.7rem;">
                                <i class="fas fa-history"></i>
                            </div>
                            <span class="fw-semibold small">Riwayat Penyakit Dahulu</span>
                        </div>
                        <div class="p-3 bg-light rounded-3">
                            <p class="mb-0 small">{{ $rekam_medis->riwayat_penyakit_dahulu ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="avatar-sm avatar-gradient-purple" style="width:28px;height:28px;font-size:0.7rem;">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="fw-semibold small">Riwayat Penyakit Keluarga</span>
                        </div>
                        <div class="p-3 bg-light rounded-3">
                            <p class="mb-0 small">{{ $rekam_medis->riwayat_penyakit_keluarga ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="avatar-sm avatar-gradient-red" style="width:28px;height:28px;font-size:0.7rem;">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <span class="fw-semibold small">Riwayat Alergi</span>
                        </div>
                        <div class="p-3 bg-light rounded-3">
                            <p class="mb-0 small">{{ $rekam_medis->riwayat_alergi ?? 'Tidak ada' }}</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="header-icon-sm gradient-orange">
                                <i class="fas fa-sticky-note"></i>
                            </div>
                            <h6 class="mb-0 fw-semibold">Diagnosa</h6>
                        </div>
                        @if($rekam_medis->diagnosas->count() > 0)
                            <div class="d-flex flex-column gap-2">
                                @foreach($rekam_medis->diagnosas as $diagnosa)
                                    <div class="p-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge-custom badge-orange">{{ $diagnosa->icd10->kode ?? '-' }}</span>
                                            <span class="ms-2">{{ $diagnosa->icd10->nama_penyakit_indonesia ?? '-' }}</span>
                                        </div>
                                        <span class="badge-custom badge-purple">{{ $diagnosa->jenis }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state py-2">
                                <p class="mb-0">-</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="header-icon-sm gradient-blue">
                                <i class="fas fa-syringe"></i>
                            </div>
                            <h6 class="mb-0 fw-semibold">Tindakan Medis</h6>
                        </div>
                        @if($rekam_medis->tindakanMedis->count() > 0)
                            <div class="d-flex flex-column gap-2">
                                @foreach($rekam_medis->tindakanMedis as $tindakan)
                                    <div class="p-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge-custom badge-blue">{{ $tindakan->masterTindakan->kode_tindakan ?? '-' }}</span>
                                            <span class="ms-2">{{ $tindakan->masterTindakan->nama_tindakan ?? '-' }}</span>
                                        </div>
                                        <span class="badge-custom badge-green">{{ $tindakan->jumlah }}x</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state py-2">
                                <p class="mb-0">-</p>
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="my-4">

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-sm avatar-gradient-green" style="width:28px;height:28px;font-size:0.7rem;">
                                <i class="fas fa-comment-medical"></i>
                            </div>
                            <span class="fw-semibold">Catatan Dokter</span>
                        </div>
                        <div class="p-3 bg-light rounded-3">
                            <p class="mb-0">{{ $rekam_medis->catatan_dokter ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-sm avatar-gradient-teal" style="width:28px;height:28px;font-size:0.7rem;">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <span class="fw-semibold">Rencana Tindak Lanjut</span>
                        </div>
                        <div class="p-3 bg-light rounded-3">
                            <p class="mb-0">{{ $rekam_medis->rencana_tindak_lanjut ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
