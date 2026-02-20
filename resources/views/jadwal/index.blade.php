@extends('layouts.master')
@section('title', 'Jadwal Dokter - EMIRA')
@section('page_title', 'Jadwal Dokter')
@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-teal">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div>
                <h5 class="card-title">Jadwal Praktik Dokter</h5>
                <small class="text-muted">Kelola jadwal praktik dokter</small>
            </div>
        </div>
        <a href="{{ route('jadwal.create') }}" class="btn-custom btn-custom-primary">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </a>
    </div>
    <div class="card-body-custom">
        @if($jadwals->count() > 0)
        <div class="table-responsive-custom">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwals as $jadwal)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-sm avatar-gradient-teal">{{ substr($jadwal->dokter->nama_lengkap ?? 'D', 0, 1) }}</div>
                                <div class="fw-semibold">{{ $jadwal->dokter->nama_lengkap ?? '-' }}</div>
                            </div>
                        </td>
                        <td><span class="badge-custom badge-purple">{{ $jadwal->poli->nama_poli ?? '-' }}</span></td>
                        <td class="text-capitalize">{{ $jadwal->hari }}</td>
                        <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                        <td>{{ $jadwal->kuota_pasien }} pasien</td>
                        <td>
                            @if($jadwal->is_active)
                                <span class="badge-custom badge-active"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                            @else
                                <span class="badge-custom badge-inactive"><i class="fas fa-times-circle me-1"></i>Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn-action btn-action-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-action-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan <strong>{{ $jadwals->firstItem() }}</strong> - <strong>{{ $jadwals->lastItem() }}</strong> dari <strong>{{ $jadwals->total() }}</strong> data
            </div>
            <div class="pagination-container">
                {{ $jadwals->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-calendar-alt"></i></div>
            <h6>Tidak Ada Jadwal</h6>
            <p>Belum ada jadwal dokter.</p>
            <a href="{{ route('jadwal.create') }}" class="btn-custom btn-custom-primary mt-2">
                <i class="fas fa-plus me-1"></i> Tambah Jadwal
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
