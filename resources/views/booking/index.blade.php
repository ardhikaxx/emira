@extends('layouts.app')

@section('title', 'EMIRA — Manajemen Booking Online')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-calendar-check me-2"></i>Manajemen Booking Online</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Filter -->
            <form method="GET" class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block w-100">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Booking</th>
                            <th>Pasien</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td><strong>{{ $booking->kode_booking }}</strong></td>
                            <td>
                                {{ $booking->pasien->nama_lengkap }}<br>
                                <small class="text-muted">{{ $booking->pasien->no_rm }}</small>
                            </td>
                            <td>{{ $booking->poli->nama_poli }}</td>
                            <td>
                                {{ $booking->dokter->gelar_depan }} {{ $booking->dokter->nama_lengkap }}
                                @if($booking->dokter->gelar_belakang), {{ $booking->dokter->gelar_belakang }}@endif
                            </td>
                            <td>{{ $booking->tanggal_booking->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->jam_booking)->format('H:i') }}</td>
                            <td>
                                <span class="badge {{ $booking->status_badge }}">
                                    {{ $booking->status_text }}
                                </span>
                                @if($booking->antrian)
                                    <br><small class="text-muted">Antrian: {{ $booking->antrian->no_urut }}</small>
                                @endif
                            </td>
                            <td>
                                @if($booking->status === 'pending')
                                    <button type="button" class="btn btn-sm btn-success" 
                                            onclick="confirmBooking({{ $booking->id }})"
                                            title="Konfirmasi Booking">
                                        <i class="fas fa-check"></i> Konfirmasi
                                    </button>
                                @endif
                                
                                @if(in_array($booking->status, ['pending', 'confirmed']))
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="cancelBooking({{ $booking->id }})"
                                            title="Batalkan Booking">
                                        <i class="fas fa-times"></i> Batalkan
                                    </button>
                                @endif

                                <button type="button" class="btn btn-sm btn-info" 
                                        onclick="showDetail({{ $booking->id }})"
                                        title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                Tidak ada data booking
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Cancel -->
<div class="modal fade" id="modalCancel" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formCancel" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Batalkan Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Alasan Pembatalan</label>
                        <textarea class="form-control" name="catatan_pembatalan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Batalkan Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i>Detail Booking</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="detailContent">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Memuat data...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
console.log('Booking management scripts loaded');

function confirmBooking(id) {
    console.log('Confirm booking:', id);
    
    Swal.fire({
        title: 'Konfirmasi Booking?',
        text: 'Booking akan dikonfirmasi dan antrian akan dibuat jika tanggal booking adalah hari ini.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Konfirmasi',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#0A6EBD',
        cancelButtonColor: '#6c757d'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ url("/booking") }}/' + id + '/confirm';
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    });
}

function cancelBooking(id) {
    console.log('Cancel booking:', id);
    
    const modal = new bootstrap.Modal(document.getElementById('modalCancel'));
    document.getElementById('formCancel').action = '{{ url("/booking") }}/' + id + '/cancel';
    modal.show();
}

function showDetail(id) {
    console.log('Show detail:', id);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('modalDetail'));
    modal.show();
    
    // Fetch detail via AJAX
    fetch('{{ url("/booking") }}/' + id + '/detail', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const booking = data.booking;
            
            let html = `
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Kode Booking</h5>
                                    <span class="badge bg-primary fs-6">${booking.kode_booking}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Status</span>
                                    <span class="badge ${booking.status_badge}">${booking.status_text}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3"><i class="fas fa-user me-2"></i>Data Pasien</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="120">No. RM</td>
                                <td><strong>${booking.pasien.no_rm}</strong></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td><strong>${booking.pasien.nama_lengkap}</strong></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>${booking.pasien.nik || '-'}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>${booking.pasien.no_hp || '-'}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3"><i class="fas fa-calendar-alt me-2"></i>Jadwal</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="120">Poli</td>
                                <td><strong>${booking.poli.nama_poli}</strong></td>
                            </tr>
                            <tr>
                                <td>Dokter</td>
                                <td><strong>${booking.dokter_nama}</strong></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>${booking.tanggal_booking}</td>
                            </tr>
                            <tr>
                                <td>Jam</td>
                                <td>${booking.jam_booking}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-12">
                        <h6 class="text-muted mb-3"><i class="fas fa-file-medical me-2"></i>Informasi Medis</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="150">Jenis Pembayaran</td>
                                <td>
                                    <span class="badge ${booking.jenis_pembayaran === 'bpjs' ? 'bg-success' : 'bg-info'}">
                                        ${booking.jenis_pembayaran.toUpperCase()}
                                    </span>
                                </td>
                            </tr>
                            ${booking.no_bpjs ? `
                            <tr>
                                <td>No. BPJS</td>
                                <td><strong>${booking.no_bpjs}</strong></td>
                            </tr>
                            ` : ''}
                            <tr>
                                <td>Keluhan</td>
                                <td>${booking.keluhan || '-'}</td>
                            </tr>
                        </table>
                    </div>
                    
                    ${booking.antrian ? `
                    <div class="col-12">
                        <div class="alert alert-success mb-0">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Antrian sudah dibuat:</strong> No. Antrian <strong>${booking.antrian.no_urut}</strong> 
                            (${booking.antrian.kode_antrian})
                        </div>
                    </div>
                    ` : ''}
                    
                    ${booking.catatan_pembatalan ? `
                    <div class="col-12">
                        <div class="alert alert-danger mb-0">
                            <h6 class="alert-heading"><i class="fas fa-times-circle me-2"></i>Alasan Pembatalan</h6>
                            <p class="mb-0">${booking.catatan_pembatalan}</p>
                        </div>
                    </div>
                    ` : ''}
                    
                    <div class="col-12">
                        <h6 class="text-muted mb-3"><i class="fas fa-clock me-2"></i>Timeline</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="150">Dibuat</td>
                                <td>${booking.created_at}</td>
                            </tr>
                            ${booking.confirmed_at ? `
                            <tr>
                                <td>Dikonfirmasi</td>
                                <td>${booking.confirmed_at}</td>
                            </tr>
                            ` : ''}
                            ${booking.cancelled_at ? `
                            <tr>
                                <td>Dibatalkan</td>
                                <td>${booking.cancelled_at}</td>
                            </tr>
                            ` : ''}
                        </table>
                    </div>
                </div>
            `;
            
            document.getElementById('detailContent').innerHTML = html;
        } else {
            document.getElementById('detailContent').innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Gagal memuat detail booking
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('detailContent').innerHTML = `
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                Terjadi kesalahan saat memuat data
            </div>
        `;
    });
}

// Test if functions are accessible
console.log('Functions defined:', {
    confirmBooking: typeof confirmBooking,
    cancelBooking: typeof cancelBooking,
    showDetail: typeof showDetail
});
</script>
@endsection
