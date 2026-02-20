@extends('layouts.master')
@section('title', 'Daftar Antrian - EMIRA')
@section('page_title', 'Daftar Antrian')
@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="header-title">
                    <div class="header-icon-sm gradient-orange">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Antrian Baru</h5>
                        <small class="text-muted">Pendaftaran antrian pasien</small>
                    </div>
                </div>
            </div>
            <div class="card-body-custom">
                <form method="POST" action="{{ route('antrian.store') }}">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3 h-100">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="avatar-sm avatar-gradient-teal">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <h6 class="mb-0 fw-semibold">Data Pasien</h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Pasien <span class="text-danger">*</span></label>
                                    <select name="pasien_id" class="form-select select2" required>
                                        <option value="">Pilih Pasien</option>
                                        @foreach($pasiens as $pasien)
                                        <option value="{{ $pasien->id }}">{{ $pasien->no_rm }} - {{ $pasien->nama_lengkap }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3 h-100">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="avatar-sm avatar-gradient-blue">
                                        <i class="fas fa-hospital"></i>
                                    </div>
                                    <h6 class="mb-0 fw-semibold">Data Kunjungan</h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Poli <span class="text-danger">*</span></label>
                                    <select name="poli_id" id="poli_id" class="form-select" required>
                                        <option value="">Pilih Poli</option>
                                        @foreach($polis as $poli)
                                        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Dokter <span class="text-danger">*</span></label>
                                    <select name="dokter_id" id="dokter_id" class="form-select" required>
                                        <option value="">Pilih Dokter</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Jenis Pembayaran</label>
                                    <select name="jenis_pembayaran" class="form-select">
                                        <option value="umum">Umum</option>
                                        <option value="bpjs">BPJS Kesehatan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('antrian.index') }}" class="btn-action btn-action-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn-custom btn-custom-primary">
                            <i class="fas fa-save"></i> Simpan Antrian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$('#poli_id').change(function() {
    var poliId = $(this).val();
    $('#dokter_id').html('<option value="">Loading...</option>');
    
    if (!poliId) {
        $('#dokter_id').html('<option value="">Pilih Dokter</option>');
        return;
    }
    
    $.get('/api/dokters-by-poli', { poli_id: poliId }, function(data) {
        if (data.length === 0) {
            $('#dokter_id').html('<option value="">Tidak ada dokter di poli ini</option>');
        } else {
            var options = '<option value="">Pilih Dokter</option>';
            data.forEach(function(d) {
                options += '<option value="' + d.id + '">' + d.nama_lengkap + '</option>';
            });
            $('#dokter_id').html(options);
        }
    });
});
</script>
@endsection
