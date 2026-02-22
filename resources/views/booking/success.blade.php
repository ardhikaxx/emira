@extends('layouts.public')

@section('title', 'EMIRA — Booking Berhasil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    </div>
                    
                    <h3 class="text-success mb-3">Booking Berhasil!</h3>
                    <p class="text-muted mb-4">Booking Anda telah berhasil dibuat dan menunggu konfirmasi dari petugas.</p>

                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5 class="mb-3">Detail Booking</h5>
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td class="text-start"><strong>Kode Booking</strong></td>
                                    <td class="text-end">
                                        <span class="badge bg-primary fs-6">{{ $booking->kode_booking }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">Nama Pasien</td>
                                    <td class="text-end">{{ $booking->pasien->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td class="text-start">No. RM</td>
                                    <td class="text-end">{{ $booking->pasien->no_rm }}</td>
                                </tr>
                                <tr>
                                    <td class="text-start">Poli</td>
                                    <td class="text-end">{{ $booking->poli->nama_poli }}</td>
                                </tr>
                                <tr>
                                    <td class="text-start">Dokter</td>
                                    <td class="text-end">
                                        {{ $booking->dokter->gelar_depan }} {{ $booking->dokter->nama_lengkap }}
                                        @if($booking->dokter->gelar_belakang), {{ $booking->dokter->gelar_belakang }}@endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">Tanggal</td>
                                    <td class="text-end">{{ $booking->tanggal_booking->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-start">Jam Praktik</td>
                                    <td class="text-end">
                                        {{ \Carbon\Carbon::parse($booking->jadwalDokter->jam_mulai)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($booking->jadwalDokter->jam_selesai)->format('H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">Pembayaran</td>
                                    <td class="text-end">
                                        <span class="badge {{ $booking->jenis_pembayaran === 'bpjs' ? 'bg-success' : 'bg-info' }}">
                                            {{ strtoupper($booking->jenis_pembayaran) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="alert alert-info text-start">
                        <h6><i class="fas fa-info-circle me-2"></i>Informasi Penting:</h6>
                        <ul class="mb-0">
                            <li>Simpan <strong>Kode Booking</strong> Anda untuk cek status</li>
                            <li>Booking akan dikonfirmasi oleh petugas dalam 1x24 jam</li>
                            <li>Datang 15 menit sebelum jadwal praktik dimulai</li>
                            <li>Bawa kartu identitas dan kartu BPJS (jika ada)</li>
                        </ul>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('booking.check') }}" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Cek Status Booking
                        </a>
                        <a href="{{ route('booking.create') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-plus me-2"></i>Booking Lagi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
