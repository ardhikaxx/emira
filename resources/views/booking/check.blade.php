@extends('layouts.public')

@section('title', 'EMIRA — Cek Status Booking')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-search me-2"></i>Cek Status Booking</h4>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label">Kode Booking</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="kode_booking" 
                                   placeholder="Contoh: BKG-20250222-ABC123">
                            <button type="button" class="btn btn-primary" id="btnCheckStatus">
                                <i class="fas fa-search me-1"></i>Cek Status
                            </button>
                        </div>
                        <small class="text-muted">Masukkan kode booking yang Anda terima saat mendaftar</small>
                    </div>

                    <div id="statusResult" class="d-none">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="mb-3">Status Booking</h5>
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <td width="150"><strong>Kode Booking</strong></td>
                                        <td>: <span id="result_kode"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pasien</td>
                                        <td>: <span id="result_nama"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Poli</td>
                                        <td>: <span id="result_poli"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Dokter</td>
                                        <td>: <span id="result_dokter"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>: <span id="result_tanggal"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Jam</td>
                                        <td>: <span id="result_jam"></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>: <span id="result_status"></span></td>
                                    </tr>
                                    <tr id="row_antrian" class="d-none">
                                        <td><strong>No. Antrian</strong></td>
                                        <td>: <span class="badge bg-success fs-5" id="result_antrian"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="notFound" class="d-none">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Kode booking tidak ditemukan. Pastikan Anda memasukkan kode yang benar.
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('booking.create') }}" class="text-decoration-none">
                    <i class="fas fa-calendar-plus me-1"></i>Buat Booking Baru
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#btnCheckStatus').click(function() {
        const kode_booking = $('#kode_booking').val();
        if (!kode_booking) {
            alert('Masukkan kode booking');
            return;
        }

        $.ajax({
            url: '{{ route("booking.get-status") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                kode_booking: kode_booking
            },
            success: function(response) {
                if (response.found) {
                    $('#result_kode').text(response.booking.kode_booking);
                    $('#result_nama').text(response.booking.pasien_nama);
                    $('#result_poli').text(response.booking.poli);
                    $('#result_dokter').text(response.booking.dokter);
                    $('#result_tanggal').text(response.booking.tanggal);
                    $('#result_jam').text(response.booking.jam);
                    $('#result_status').html(`<span class="badge ${response.booking.status_badge}">${response.booking.status}</span>`);
                    
                    if (response.booking.no_antrian) {
                        $('#result_antrian').text(response.booking.no_antrian);
                        $('#row_antrian').removeClass('d-none');
                    } else {
                        $('#row_antrian').addClass('d-none');
                    }

                    $('#statusResult').removeClass('d-none');
                    $('#notFound').addClass('d-none');
                } else {
                    $('#statusResult').addClass('d-none');
                    $('#notFound').removeClass('d-none');
                }
            }
        });
    });

    // Enter key
    $('#kode_booking').keypress(function(e) {
        if (e.which === 13) {
            $('#btnCheckStatus').click();
        }
    });
});
</script>
@endpush
@endsection
