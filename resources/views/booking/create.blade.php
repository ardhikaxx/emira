@extends('layouts.public')

@section('title', 'EMIRA — Booking Online')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Booking Online EMIRA</h4>
                </div>
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                        @csrf

                        <!-- Step 1: Cek Pasien -->
                        <div id="step1">
                            <h5 class="mb-3">1. Data Pasien</h5>
                            <div class="mb-3">
                                <label class="form-label">No. Rekam Medis atau NIK</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="identifier" placeholder="Masukkan No. RM atau NIK">
                                    <button type="button" class="btn btn-primary" id="btnCheckPasien">
                                        <i class="fas fa-search me-1"></i>Cek Data
                                    </button>
                                </div>
                                <small class="text-muted">Masukkan No. Rekam Medis atau NIK Anda</small>
                            </div>

                            <div id="pasienInfo" class="d-none">
                                <div class="alert alert-success">
                                    <h6 class="mb-2">Data Pasien Ditemukan:</h6>
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td width="150">No. RM</td>
                                            <td>: <strong id="info_no_rm"></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>: <strong id="info_nama"></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td>
                                            <td>: <span id="info_tgl_lahir"></span></td>
                                        </tr>
                                    </table>
                                </div>
                                <input type="hidden" name="pasien_id" id="pasien_id">
                                <button type="button" class="btn btn-success" id="btnNextStep2">
                                    Lanjut ke Pilih Jadwal <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>

                            <div id="pasienNotFound" class="d-none">
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Data pasien tidak ditemukan. Silakan daftar terlebih dahulu di loket pendaftaran.
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Pilih Jadwal -->
                        <div id="step2" class="d-none">
                            <h5 class="mb-3">2. Pilih Jadwal Dokter</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Poli <span class="text-danger">*</span></label>
                                    <select class="form-select" name="poli_id" id="poli_id" required>
                                        <option value="">-- Pilih Poli --</option>
                                        @foreach($polis as $poli)
                                            <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Kunjungan <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_booking" id="tanggal_booking" 
                                           min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>

                            <div id="jadwalList" class="mb-3"></div>

                            <input type="hidden" name="dokter_id" id="dokter_id">
                            <input type="hidden" name="jadwal_dokter_id" id="jadwal_dokter_id">

                            <button type="button" class="btn btn-secondary me-2" id="btnBackStep1">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </button>
                            <button type="button" class="btn btn-success d-none" id="btnNextStep3">
                                Lanjut ke Detail <i class="fas fa-arrow-right ms-1"></i>
                            </button>
                        </div>

                        <!-- Step 3: Detail Booking -->
                        <div id="step3" class="d-none">
                            <h5 class="mb-3">3. Detail Booking</h5>

                            <div class="mb-3">
                                <label class="form-label">Jenis Pembayaran <span class="text-danger">*</span></label>
                                <select class="form-select" name="jenis_pembayaran" id="jenis_pembayaran" required>
                                    <option value="umum">Umum</option>
                                    <option value="bpjs">BPJS</option>
                                </select>
                            </div>

                            <div class="mb-3 d-none" id="bpjsField">
                                <label class="form-label">No. BPJS <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="no_bpjs" id="no_bpjs" 
                                       placeholder="Masukkan nomor BPJS">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keluhan (Opsional)</label>
                                <textarea class="form-control" name="keluhan" rows="3" 
                                          placeholder="Jelaskan keluhan Anda (maksimal 500 karakter)" maxlength="500"></textarea>
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Catatan:</strong> Setelah booking berhasil, silakan datang 15 menit sebelum jadwal praktik dimulai.
                            </div>

                            <button type="button" class="btn btn-secondary me-2" id="btnBackStep2">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check me-1"></i>Konfirmasi Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('booking.check') }}" class="text-decoration-none">
                    <i class="fas fa-search me-1"></i>Cek Status Booking
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Check Pasien
    $('#btnCheckPasien').click(function() {
        const identifier = $('#identifier').val();
        if (!identifier) {
            alert('Masukkan No. RM atau NIK');
            return;
        }

        $.ajax({
            url: '{{ route("booking.check-pasien") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                identifier: identifier
            },
            success: function(response) {
                if (response.found) {
                    $('#pasien_id').val(response.pasien.id);
                    $('#info_no_rm').text(response.pasien.no_rm);
                    $('#info_nama').text(response.pasien.nama_lengkap);
                    $('#info_tgl_lahir').text(response.pasien.tanggal_lahir);
                    $('#pasienInfo').removeClass('d-none');
                    $('#pasienNotFound').addClass('d-none');
                } else {
                    $('#pasienInfo').addClass('d-none');
                    $('#pasienNotFound').removeClass('d-none');
                }
            }
        });
    });

    // Navigation
    $('#btnNextStep2').click(function() {
        $('#step1').addClass('d-none');
        $('#step2').removeClass('d-none');
    });

    $('#btnBackStep1').click(function() {
        $('#step2').addClass('d-none');
        $('#step1').removeClass('d-none');
    });

    $('#btnNextStep3').click(function() {
        $('#step2').addClass('d-none');
        $('#step3').removeClass('d-none');
    });

    $('#btnBackStep2').click(function() {
        $('#step3').addClass('d-none');
        $('#step2').removeClass('d-none');
    });

    // Load Jadwal
    function loadJadwal() {
        const poli_id = $('#poli_id').val();
        const tanggal = $('#tanggal_booking').val();

        if (!poli_id || !tanggal) return;

        $.ajax({
            url: '{{ route("booking.get-jadwal") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                poli_id: poli_id,
                tanggal: tanggal
            },
            success: function(jadwals) {
                let html = '';
                if (jadwals.length === 0) {
                    html = '<div class="alert alert-warning">Tidak ada jadwal dokter tersedia untuk tanggal ini.</div>';
                } else {
                    html = '<div class="list-group">';
                    jadwals.forEach(function(jadwal) {
                        html += `
                            <div class="list-group-item list-group-item-action jadwal-item" 
                                 data-jadwal-id="${jadwal.id}" data-dokter-id="${jadwal.dokter_id}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">${jadwal.dokter_nama}</h6>
                                        <small class="text-muted">${jadwal.spesialisasi}</small><br>
                                        <small><i class="fas fa-clock me-1"></i>${jadwal.jam_mulai} - ${jadwal.jam_selesai}</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-success">Sisa Kuota: ${jadwal.sisa_kuota}</span>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    html += '</div>';
                }
                $('#jadwalList').html(html);
            }
        });
    }

    $('#poli_id, #tanggal_booking').change(loadJadwal);

    // Select Jadwal
    $(document).on('click', '.jadwal-item', function() {
        $('.jadwal-item').removeClass('active');
        $(this).addClass('active');
        $('#jadwal_dokter_id').val($(this).data('jadwal-id'));
        $('#dokter_id').val($(this).data('dokter-id'));
        $('#btnNextStep3').removeClass('d-none');
    });

    // BPJS Field
    $('#jenis_pembayaran').change(function() {
        if ($(this).val() === 'bpjs') {
            $('#bpjsField').removeClass('d-none');
            $('#no_bpjs').attr('required', true);
        } else {
            $('#bpjsField').addClass('d-none');
            $('#no_bpjs').attr('required', false);
        }
    });
});
</script>
@endpush
@endsection
